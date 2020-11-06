

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
            if(!$.isEmptyObject(res.errors)){
                for (let key in res.errors){
                    console.log(key)
                    console.log(res.errors[key])
                    itoastr('error', res.errors[key]);
                    $(`[name="${key}"]`).invalid();
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
        if(!this.hasClass('d-none'))
        this.addClass('d-none')
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

        let csvImport = options && options.csvImport || false;

        let dataTable = options && options.dataTable || true;

        let dataTableOption = options && options.dataTableOption || {};

        let markIndex = options && options.markIndex || true;

        let addable = options && options.addable || true;

        let editable = options && options.editable  || true;

        let deletable = options && options.deletable  || true;

        let deleteUrl = options && options.urls.delete || '';

        let editUrl = options && options.urls.edit || '';

        let updateUrl = options && options.urls.update || '';

        let indexColumnNumber = options && options.indexColumnNumber || 0;

        let apiProcessing = false

        let updating = false;

        let that = this;
        let ids;
        let rows;
        let table;
        let idsForUpdate;
        let rowsForUpdate;

        function init(){
            ids = [];
            rows = [];
            idsForUpdate = [];
            rowsForUpdate = [];
            that.find('.delete-all').disable()
            that.find('.edit-all').disable()
            that.find('.save-all').disable()
            that.find('.select-all').check(false);
            dataTable && table && table.fnDraw();
        }


        csvImport && that.find('.csv-import').click(function (){
            that.find('.csv-file-picker').click();
            that.find('.csv-file-picker').change(function (){
                let submitUrl = $(this).data('submit-url');
                let formData = new FormData()
                formData.append('csv-file', this.files[0])
                $('#submit-csv-file-dialog').modal('show');
                let modal = $('#submit-csv-file-dialog');

                modal.find('select').change(function (){
                    let error = false;
                    let temp = -1;
                    let $this = $(this)
                })

                $('.csv-submit-btn').click(function (){
                    const {formData} = modal.formData();
                    formData.append('csv-file', that.find('.csv-file-picker')[0].files[0])
                    pAjax(submitUrl, formData, (res)=>{
                        console.log(res)
                        if(res.status){
                            window.location.reload();
                        }
                    })
                })
            });
        })


        addable && that.find('.add-new').click(function (){
            that.find('.add-form-container').show();
            that.find('.dataTables_wrapper').hide();
            that.find('.add-new').hide();
            that.find('.edit-all').hide();
            that.find('.delete-all').hide();
            that.find('.save-all').hide();
            if(csvImport){
                that.find('.btn-cancel-add').show();
            }
        })

        addable && that.find('.btn-cancel-add').click(function (e){
            e.preventDefault();
            that.find('.add-form-container').hide();
            that.find('.add-new').show();
            that.find('.edit-all').show();
            that.find('.delete-all').show();
            that.find('.save-all').show();
            that.find('.dataTables_wrapper').show();
            if(csvImport){
                that.find('.btn-cancel-add').hide();
            }
        })

        addable && that.find('.add-form').find('input').change(function (){
            that.find('.create-item').loading(false);
            $(this).invalid(false)
        })

        addable && that.find('.add-form').submit(function (e){
            e.preventDefault();
            that.find('.create-item').loading();
            let formData = new FormData(this);
            let form = $(this);
            pAjax($(this).attr('action'),formData,(res)=>{
                apiProcessing = true;
                if(res.status){
                    itoastr('success','Created successfully')
                    that.find('.create-item').loading(false);
                    if(dataTable){
                        table.fnAddData(res.data)
                    }else {
                        that.find('tbody').append(res.view);
                    }
                    form.clear();
                }
                apiProcessing = false;
                init();
            })
        })

        that.find('.select-all').click(function (){
            that.find('.select-item:enabled').prop('checked', $(this).prop('checked'))
            checkSelectedItems()
        })

        $(document).on('change','.select-item', function (){
            checkSelectedItems()
        })

        $(document).on('click','.delete-item', function (){
           ids = [$(this).data('id')];
           rows = [$(this).parents('tr')];
        });

        $(document).on('click', '.delete-all, .delete-item', function (){
            if(!$(this).hasClass('disabled')){
                $('#delete-confirm-modal').modal('show');
            }
        })

        editable && $(document).on('click', '.edit-all', function (){
            if(!$(this).hasClass('disabled')){
                renderEditRow();
            }
        })

        editable && $(document).on('click','.edit-item', function (){
            if(!$(this).hasClass('disabled')){
                ids = [$(this).data('id')];
                rows = [$(this).parents('tr')];
                renderEditRow();
            }
        })

        $(document).on('click', '.save-all', function (){
            if(!$(this).hasClass('disabled')){
                checkSelectedItems();
                submitForUpdate();
            }
        })

        $(document).on('click','.update-item', function (){
            if(!$(this).hasClass('disabled')){
                idsForUpdate = [$(this).data('id')];
                rowsForUpdate = [$(this).parents('tr')];
                submitForUpdate();
            }
        })

        $('.delete-confirm-btn').click(function (){
            let formData = new FormData();
            formData.append('ids', ids.join(','));
            pAjax(deleteUrl, formData,(res)=>{
                if(res.status){
                    for (let row of rows){
                        if(dataTable){
                            table.fnDeleteRow(row.data(row))
                        }else {
                            row.remove();
                        }
                    }
                    $('#delete-confirm-modal').modal('hide');
                    init();
                    itoastr('success','Deleted Successfully!')
                }
            })
        })

        function checkSelectedItems(){
            let disabled = true;
            let saveAllButtonDisabled = true;
            ids = [];
            rows = [];
            idsForUpdate = [];
            rowsForUpdate = [];
            that.find('.select-item').each((index, item)=>{
                if($(item).prop('checked') && !$(item).prop('disabled')){
                    disabled = false;
                    $(item).parents('tr').find('.edit-item').disable();
                    $(item).parents('tr').find('.delete-item').disable();
                    ids.push($(item).data('id'));
                    rows.push($(item).parents('tr'));
                }else {
                    $(item).parents('tr').find('.edit-item').disable(false);
                    $(item).parents('tr').find('.delete-item').disable(false);
                }
                if($(item).parents('tr').find('.update-item').length === 1){
                    saveAllButtonDisabled = false;
                    idsForUpdate.push($(item).data('id'));
                    rowsForUpdate.push($(item).parents('tr'));
                }
            })
            that.find('.delete-all').disable(disabled)
            that.find('.edit-all').disable(disabled)
            that.find('.save-all').disable(saveAllButtonDisabled)
        }


        function markIndexNumbers(){
            that.find('tbody').find('tr').each((index, item)=>{
                updating = true;
                $($(item).find('td')[indexColumnNumber]).text(index + 1);
            })
        }

        function renderEditRow(){
            if(editable){
                let formData = new FormData();
                formData.append('ids', ids.join(','));
                pAjax(editUrl, formData, res=>{
                    if(res.status){
                        apiProcessing = true;
                        for (let i in rows){
                            let row = rows[i]
                            if(dataTable){
                                let oldData = table.fnGetData(table.fnGetPosition(row[0]))
                                table.fnUpdate(res.data[i], table.fnGetPosition(row[0]))
                                row.find('.cancel-item').click(function (){
                                    table.fnUpdate(oldData, table.fnGetPosition(row[0]))
                                })
                            }else {
                                let oldHtml = row.html();
                                row.html(res.view[i])
                                row.find('.cancel-item').click(function (){
                                    row.html(oldHtml)
                                });
                            }
                        }
                        apiProcessing = false;
                        init();
                    }
                })
            }
        }

        function dataTableUpdate() {
            if(!updating && !apiProcessing){
                markIndex && markIndexNumbers();
                checkSelectedItems();
            }
            updating = false;
        }

        function submitForUpdate(){
            let formData = new FormData();
            for(let i in idsForUpdate){
               const {jsonData} = rowsForUpdate[i].formData();
                formData.append('id[]', idsForUpdate[i])
                for(let key in jsonData){
                    formData.append(`${key}[]`, jsonData[key])
                }
            }
            pAjax(updateUrl, formData,(res)=>{
                apiProcessing = true;
                if(res.status){
                    for (let i in rowsForUpdate){
                        let row = rowsForUpdate[i]
                        if(dataTable){
                            table.fnUpdate(res.data[i], table.fnGetPosition(row[0]))
                        }else {
                            row.before(res.view[i]);
                            row.remove();
                        }
                    }

                }
                apiProcessing = false;
                init();
            })
        }

        if (dataTable){
            table = dataTable && that.find('table').dataTable({
                order: [],
                columnDefs: [
                    {targets: 'no-sort', orderable: false,},
                    {targets: 'no-search', searchable: false,},
                ],
                drawCallback: function(  ) {
                    dataTableUpdate()
                }
            })
        }

        init();
    }
})
