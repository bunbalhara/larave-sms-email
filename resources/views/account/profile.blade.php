@extends('layouts.master')

@section('title', 'Profile & Security')
@section('style')
@endsection
@section('breadcrumb')
    <div class="col-md-6 text-left">
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">/</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Account</span>
                </a>
            </li>
            <li class="m-nav__separator">/</li>
            <li class="m-nav__item">
                <a href="" class="m-nav__link">
                    <span class="m-nav__link-text">Profile</span>
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="tabs-wrapper">
        <ul class="tab-nav">
            <li class="tab-item"><a class="tab-link tab-active" data-area="#profile" href="#/profile">Profile</a></li>
            <li class="tab-item"><a class="tab-link" data-area="#password" href="#/password">Password</a></li>
        </ul>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area area-active md-pt-50" id="profile_area">
        <div class="m-portlet__body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group position-relative text-center pt-5">
                            <label for="image" class="btn btn-outline-info m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air choose_btn_container">
                                <i class="la la-edit"></i>
                            </label>
                            <input type="file" accept="image/*" class="form-control m-input--square d-none" id="image" >
                            <img id="avatar" class="image_upload_output width-300" src="{{auth()->user()->avatar()}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="" id="profileForm">
                            @csrf
                            <div class="form-group pt-3 pb-3">
                                <label for="name">
                                    Name
                                    <i class="fa fa-info-circle tooltip_1" title="Name"></i>
                                </label>
                                <input type="text" class="form-control m-input m-input--square" name="name" id="name" placeholder="Name" value="{{user()->name}}">
                                <div class="form-control-feedback error-name"></div>
                            </div>
                            <div class="form-group pt-3 pb-3">
                                <label for="email">
                                    Email address
                                    <i class="fa fa-info-circle tooltip_1" title="Email Address"></i>
                                </label>
                                <input type="email" class="form-control m-input m-input--square" name="email" id="email" placeholder="Email Address" value="{{user()->email}}">
                                <div class="form-control-feedback error-email"></div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn m-btn--square  btn-outline-info m-btn m-btn--custom smtBtn" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile tab_area md-pt-50" id="password_area">
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="" id="passwordForm">
                        @csrf
                        <div class="form-group m-form__group">
                            <label for="old_password">Old Password:</label>
                            <input type="password" class="form-control m-input--square" name="old_password" id="old_password" placeholder="Old Password">
                            <div class="form-control-feedback error-old_password"></div>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="new_password">New Password:</label>
                            <input type="password" class="form-control m-input--square" name="new_password" id="new_password" placeholder="New Password">
                            <div class="form-control-feedback error-new_password"></div>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control m-input--square" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                            <div class="form-control-feedback error-confirm_password"></div>
                        </div>
                        <div class="mt-3 text-right">
                            <button type="submit" class="btn m-btn--square  btn-outline-info m-btn m-btn--custom pswBtn">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('assets/vendors/cropper/cropper.js')}}"></script>
    <script>
        var previewCropped = '';
        var isInitialized = false;
        var cropper = '';
        var file = '';

        $(function () {
            hashUpdate(window.location.hash);
            $(".selectpicker").selectpicker();
        });
        $("#image").change(function (event) {
            var file = this.files[0];
            if (file) {
                var img = new Image();

                img.src = window.URL.createObjectURL(file);

                img.onload = function () {
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(file);
                    window.URL.revokeObjectURL(img.src);
                    oFReader.onload = function () {
                        $("#avatar").attr('src', this.result);

                        if (isInitialized === true) {
                            cropper.destroy();
                        }

                        cropper = new Cropper(document.getElementById("avatar"), {
                            viewMode: 2,
                            dragMode: 'crop',
                            autoCropArea: 1,
                            aspectRatio: 1,
                            checkOrientation: false,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            zoomOnTouch: true,
                            zoomOnWheel: true,
                            guides: true,
                            highlight: true,
                            crop: function (event) {
                                const canvas = cropper.getCroppedCanvas();
                                previewCropped = canvas.toDataURL();
                            }
                        });
                        isInitialized = true;
                    };
                }
            }
        });
        $("#profileForm").on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            if(previewCropped!=='')
            {
                formData.append("image", previewCropped);
            }
            $(".smtBtn").html("<i class='fa fa-spinner fa-spin fa-2x fa-fw'></i>").attr("disabled", true);
            $.ajax({
                url:"{{route('profile.update')}}",
                method: 'POST',
                data: formData,
                dataType:'JSON',
                contentType:false,
                cache:false,
                processData:false,
                success: function(result)
                {
                    console.log(result);
                    $(".smtBtn").html("Submit").attr("disabled", false);
                    $(".form-control-feedback").html("");

                    if(result.status===0)
                    {
                        dispValidErrors(result.data)
                        dispErrors(result.data)
                    }else {
                        itoastr('success', 'Successfully updated!');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function(e)
                {
                    console.log(e)
                }
            });

        });
        $("#passwordForm").on('submit', function(event) {
            event.preventDefault();

            $(".pswBtn").html("<i class='fa fa-spinner fa-spin fa-2x fa-fw'></i>").attr("disabled", true);
            $.ajax({
                url:"{{route('password.update')}}",
                method: 'POST',
                data: new FormData(this),
                dataType:'JSON',
                contentType:false,
                cache:false,
                processData:false,
                success: function(result)
                {
                    console.log(result);
                    $(".pswBtn").html("Submit").attr("disabled", false);
                    $(".form-control-feedback").html("");

                    if(result.status===0)
                    {
                        dispValidErrors(result.data)
                        dispErrors(result.data)
                    }else {
                        itoastr('success', 'Successfully updated!');
                    }
                },
                error: function(e)
                {
                    console.log(e)
                }
            });

        });
    </script>
@endsection
