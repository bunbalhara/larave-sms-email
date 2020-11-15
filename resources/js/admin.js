window.pAjax = function (url, data = null, successCallback, errorCallback) {
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type:'post',
        url:url,
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: (res)=>{
            console.log(res)
            if(!$.isEmptyObject(res.errors)){
                for (let key in res.errors){
                    itoastr('error', res.errors[key]);
                    let name = key.split('.')[0];
                    let order = key.split('.')[1]
                    if(order){
                        $($(`[name="${name}[]"]`)[order]).invalid()
                    }else {
                        $(`[name="${key}"]`).invalid();
                    }
                }
            }
            successCallback(res)
        },
        error: err => {
            console.log(err);
            itoastr('error', 'Something went wrong')
            if(errorCallback){
                errorCallback(err)
            }
        }
    })
}

window.fLog = function (formData){
    let data = {}
    formData.forEach((value,key) => {
        data[key] = value;
    });
    console.log(data)
}

$.fn.extend({
    loading:function (loading = true, html = null){
        if(loading){
            this.html("<i class='fa fa-spinner fa-spin fa-2x fa-fw'></i>").attr("disabled", true);
        }else {
            this.html(html || "Submit").attr("disabled", false)
        }
    },
    invalid:function (invalid = true){
        if(invalid && !this.hasClass('is-invalid')){
            this.addClass('is-invalid');
        }
        if(!invalid && this.hasClass('is-invalid')){
            this.removeClass('is-invalid');
        }
    },
    disable: function (disabled = true){
        if(disabled && !this.hasClass('disabled')){
            this.addClass('disabled')
        }

        if(!disabled && this.hasClass('disabled')){
            this.removeClass('disabled')
        }
    },
    hide:function (){
        this.each((item)=>{
            if(!$(item).hasClass('d-none'))
                this.addClass('d-none')
        })
    },
    show:function (){
        if(this.hasClass('d-none'))
        this.removeClass('d-none')
    },

    check:function(checked = true){
        this.prop('checked', checked)
    },
    formData: function(){
        let formData = new FormData();
        let jsonData = {};
        let inputs = this.find('input');
        let selects = this.find('select');
        let textAreas = this.find('textarea');
        let forms = [];
        inputs.each((index, item)=>{
            $(item).attr('name') && forms.push($(item))
        })

        selects.each((index, item)=>{
            $(item).attr('name') && forms.push($(item))
        })

        textAreas.each((index, item)=>{
            $(item).attr('name') && forms.push($(item))
        })

        for(let formItem of forms){
            formData.append(formItem.attr('name'), formItem.val())
            jsonData[formItem.attr('name')] = formItem.val();
        }

        return {formData, jsonData};
    },
    clear: function (){
      this.find('input').val('');
      this.find('input').removeClass('is-invalid');
    },
    crud:function (options){
        let crud = new CRUD({container: this, ...options})
        crud.initialize();
        return crud;
    }
})

class CRUD {

    constructor(options) {

        Object.assign(this, {
            csvImport:false,
            dataTable:true,
            dataTableOption:{},
            markIndex:true,
            addable:true,
            addFormSubmit:null,
            multiSubmitForAdd:false,
            editable:true,
            deletable:true,
            deleteUrl:null,
            editUrl:null,
            updateUrl:null,
            indexColumnNumber:0,
            apiProcessing:false,
            updating:false,
            showTableWithAddForm:false,
            tableFetchUrl:null,
            container:null,
            fnEdit: null,
            ids:[],
            rows:[],
            table:null,
            idsForUpdate:[],
            rowsForUpdate:[],
            fnFilter:null
        }, options);

    }

    init(){
        this.ids = [];
        this.rows = [];
        this.idsForUpdate = [];
        this.rowsForUpdate = [];
        this.container.find('.delete-all').disable()
        this.container.find('.edit-all').disable()
        this.container.find('.save-all').disable()
        this.container.find('.select-all').check(false);
        let $this = this;
        if(this.tableFetchUrl){
            // Fetch table data
            this.container.find('tbody').append(`<tr><td class="text-center" colspan="${this.container.find('thead>tr:last th').length}"><i class="fa fa-spinner fa-spin fa-2x fa-fw text-info" style="font-size: 70px"></i></td></tr>`);
            $.ajax({
                type:'get',
                url: $this.tableFetchUrl,
                success:res=>{
                    if(res.status){
                        if(res.view !== ""){
                            $this.container.find('tbody').html(res.view)
                        }else {
                            $this.container.find('tbody').html(`<tr><td class="text-center" colspan="${this.container.find('thead>tr:last th').length}">There is no available data</td></tr>`)
                        }
                        $this.markIndexNumbers();
                    }
                },
                error:err=>console.log(err)
            })
        }
        this.markIndexNumbers();
    }

    initialize(){
        let $this = this;
        this.csvImport && this.container.find('.csv-import').click(function (){
            let tab = $(this).data('tab');
            $this.container.find('.csv-file-picker').click();
            $this.container.find('.csv-file-picker').change(function (){
                let submitUrl = $(this).data('submit-url');
                let formData = new FormData()
                formData.append('csv-file', this.files[0])
                let modal = $('#submit-csv-file-dialog');
                modal.modal('show');
                modal.on("hide.bs.modal", function () {
                    $this.container.find('.csv-file-picker').val('');
                });
                $('.csv-submit-btn').click(function (){
                    const {formData} = modal.formData();
                    let btn = $(this);
                    btn.loading();
                    formData.append('csv-file', $this.container.find('.csv-file-picker')[0].files[0])

                    fLog(formData)
                    pAjax(submitUrl, formData, (res)=>{
                        if(res.status){
                            window.location.href = '/admin/recipient?tab='+tab;
                        }
                        btn.loading(false);
                    })
                })
            });
        })

        this.addable && this.container.find('.add-new').click(function (){
            $this.container.find('.add-form-container').show();
            if(!$this.showTableWithAddForm) {
                $this.container.find('.dataTables_wrapper').hide();
                $this.container.find('.add-new').hide();
                $this.container.find('.edit-all').hide();
                $this.container.find('.delete-all').hide();
                $this.container.find('.save-all').hide();
            }
            if($this.csvImport){
                $this.container.find('.btn-cancel-add').show();
            }
        })

        $this.addable && $this.container.find('.btn-cancel-add').click(function (e){
            e.preventDefault();
            $this.container.find('.add-form-container').hide();
            $this.container.find('.add-new').show();
            $this.container.find('.edit-all').show();
            $this.container.find('.delete-all').show();
            $this.container.find('.save-all').show();
            $this.container.find('.dataTables_wrapper').show();
            if($this.csvImport){
                $this.container.find('.btn-cancel-add').hide();
            }
        })

        //make invalid fields valid when it's value is changed.
        $this.addable && $this.container.on('change keyup', 'input', function (){
            $this.container.find('.create-item').loading(false);
            $(this).invalid(false)
        })

        $this.container.on('click', '.data-table-filter', function (){
            $this.fnFilter($this, $this.table)
        })

        // add form submit
        $this.addable && $this.container.find('.add-form').submit(function (e){
            e.preventDefault();
            if($this.addFormSubmit){
                $this.addFormSubmit($this.table, this)
            }else {
                $this.container.find('.create-item').loading();
                let formData = new FormData(this);
                let form = $(this);
                $this.container.find('input').attr('disabled', true)
                $this.container.find('select').attr('disabled', true)
                $this.container.find('textarea').attr('disabled', true)
                pAjax($(this).attr('action'),formData,(res)=>{
                    $this.apiProcessing = true;
                    if(res.status){
                        $this.container.find('.create-item').loading(false);
                        if($this.multiSubmitForAdd){
                            console.log('add form response', res)
                        }else {
                            if($this.dataTable){
                                $this.table.fnAddData(res.data)
                            }else {
                                $this.container.find('tbody').append(res.view);
                            }
                        }
                        if(res.message){
                            itoastr('success', res.message)
                        }else {
                            itoastr('success','Created successfully')
                        }
                        form.clear();
                    }
                    $this.container.find('input').attr('disabled', false)
                    $this.container.find('select').attr('disabled', false)
                    $this.container.find('textarea').attr('disabled', false)
                    $this.apiProcessing = false;
                    $this.container.find('.create-item').loading(false);
                    $this.init();
                })
            }
        })

        this.container.find('.select-all').click(function (){
            let filteredRows = $this.table.$('tr', {"filter":"applied"});
            filteredRows.each((index, item)=>{
                $(item).find('.select-item').prop('checked', $(this).prop('checked'))
            })
            $this.checkSelectedItems()
        })

        $(this.container).on('change','.select-item', function (){
            $this.checkSelectedItems()
        })


        $(this.container).on('click','.delete-item', function (){
            $this.ids = [$(this).data('id')];
            $this.rows = [$(this).parents('tr')];
        });

        $(this.container).on('click', '.delete-all, .delete-item', function (){
            if(!$(this).hasClass('disabled')){
                $('#delete-confirm-modal').modal('show');
            }
        })

        $this.editable && $(document).on('click', '.edit-all', function (){
            if(!$(this).hasClass('disabled')){
                $this.renderEditRow();
            }
        })

        $this.editable && $($this.container).on('click','.edit-item', function (){
            if($this.fnEdit){
                $this.fnEdit($this, this)
            }else {
                if(!$(this).hasClass('disabled')){
                    $this.ids = [$(this).data('id')];
                    $this.rows = [$(this).parents('tr')];
                    $this.renderEditRow();
                }
            }
        })

        $($this.container).on('click', '.save-all', function (){
            if(!$(this).hasClass('disabled')){
                $this.checkSelectedItems();
                $this.submitForUpdate();
            }
        })

        $($this.container).on('click','.update-item', function (){
            if(!$(this).hasClass('disabled')){
                $this.idsForUpdate = [$(this).data('id')];
                $this.rowsForUpdate = [$(this).parents('tr')];
                $this.submitForUpdate();
            }
        })

        // submit delete
        $('.delete-confirm-btn').click(function (){
            let formData = new FormData();
            if($this.ids.length > 0){
                formData.append('ids', $this.ids.join(','));
                $('.delete-confirm-btn').loading();
                pAjax($this.deleteUrl, formData,(res)=>{
                    if(res.status){
                        for (let row of $this.rows){
                            if($this.dataTable){
                                $this.table.fnDeleteRow(row.data(row))
                            }else {
                                row.remove();
                            }
                        }

                        $('.delete-confirm-btn').loading(false);
                        $('#delete-confirm-modal').modal('hide');
                        $this.init();
                        if(res.message){
                            itoastr('success',res.message)
                        }else {
                            itoastr('success','Deleted Successfully!')
                        }
                    }
                })
            }
        })

        if ($this.dataTable){
            $this.table = $this.dataTable && $this.container.find('table').dataTable({
                order: [],
                columnDefs: [
                    {targets: 'no-sort', orderable: false,},
                    {targets: 'no-search', searchable: false,},
                ],
                drawCallback: function(  ) {
                   $this.dataTableUpdate()
                }
            })
        }

        $this.init();
    }

    checkSelectedItems(){
        let disabled = true;
        let saveAllButtonDisabled = true;
        this.ids = [];
        this.rows = [];
        this.idsForUpdate = [];
        this.rowsForUpdate = [];
        let $this = this;

        $this.table && $this.table.fnGetNodes().forEach((item)=>{
            if($(item).find('.select-item').prop('checked') && !$(item).find('.select-item').prop('disabled')){
                disabled = false;
                $(item).find('.edit-item').disable();
                $(item).find('.delete-item').disable();
                $this.ids.push($(item).find('.select-item').data('id'));
                $this.rows.push($(item));
            }else {
                $(item).find('.edit-item').disable(false);
                $(item).find('.delete-item').disable(false);
            }

            if($(item).find('.update-item').length === 1){
                saveAllButtonDisabled = false;
                $this.idsForUpdate.push($(item).find('.select-item').data('id'));
                $this.rowsForUpdate.push($(item));
            }
        })

        this.container.find('.delete-all').disable(disabled)
        this.container.find('.edit-all').disable(disabled)
        this.container.find('.save-all').disable(saveAllButtonDisabled)

    }

    // mark index numbers to table.
    markIndexNumbers(){
        let $this = this;
        if($this.dataTable){
            $this.table && $this.table.fnGetNodes().forEach((item, index)=>{
                $this.updating = true;
                if($(item).find('td').length > 3){
                    $($(item).find('td')[$this.indexColumnNumber]).text(index + 1);
                }
            })
        }else {
            $this.container.find('tbody tr').each((index, item)=>{
                if($(item).find('td').length > 3){
                    $($(item).find('td')[$this.indexColumnNumber]).text(index + 1);
                }
            })
        }
    }

    renderEditRow(){
        if(this.editable){
            let formData = new FormData();
            formData.append('ids', this.ids.join(','));
            let $this = this;
            pAjax(this.editUrl, formData, res=>{
                if(res.status){
                    $this.apiProcessing = true;
                    for (let i in $this.rows){
                        let row = $this.rows[i]
                        if($this.dataTable){
                            let oldData = $this.table.fnGetData($this.table.fnGetPosition(row[0]))
                            $this.table.fnUpdate(res.data[i], $this.table.fnGetPosition(row[0]))
                            row.find('.cancel-item').click(function (){
                                $this.table.fnUpdate(oldData, $this.table.fnGetPosition(row[0]))
                            })
                        }else {
                            let oldHtml = row.html();
                            row.html(res.view[i])
                            row.find('.cancel-item').click(function (){
                                row.html(oldHtml)
                            });
                        }
                    }
                    $this.apiProcessing = false;
                    $this.init();
                }
            })
        }
    }

    dataTableUpdate() {
        if(!this.updating && !this.apiProcessing){
            this.markIndex && this.markIndexNumbers();
            this.checkSelectedItems();
        }
        this.updating = false;
    }

    submitForUpdate(){
        let formData = new FormData();
        for(let i in this.idsForUpdate){
            const {jsonData} = this.rowsForUpdate[i].formData();
            formData.append('id[]', this.idsForUpdate[i])
            for(let key in jsonData){
                formData.append(`${key}[]`, jsonData[key])
            }
        }
        let $this = this;
        pAjax(this.updateUrl, formData,(res)=>{
            $this.apiProcessing = true;
            if(res.status){
                for (let i in $this.rowsForUpdate){
                    let row = $this.rowsForUpdate[i]
                    if($this.dataTable){
                        $this.table.fnUpdate(res.data[i], $this.table.fnGetPosition(row[0]))
                    }else {
                        row.before(res.view[i]);
                        row.remove();
                    }
                }
            }
            $this.apiProcessing = false;
            $this.init();
        })
    }
}
