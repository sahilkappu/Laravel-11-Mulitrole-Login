@extends('layouts.main')
@section('title', 'User List')
@section('content')
<style>
    .dt-buttons.btn-group.flex-wrap {
        display: none;
    }

    div.dataTables_wrapper div.dataTables_filter {
        display: none !important;
    }
    .siteData{
        overflow: scroll !important;
        max-height: 50px !important;
        overflow-y:scroll !important;
        padding: 0 5px !important;
    }
</style>
<div id="kt_content_container" class="kt_content_containerTable">
    <div class="card">
        <div class="card-header border-0 ">
            <div class="card-title">
                <h1 class="d-flex align-items-center text-dark fw-bold my-1 fs-3">{{__('Users List')}}</h1>
            </div>
        </div>
        <div class="card-body ">
            <table class="table align-middle table-row-dashed stripe table-striped fs-6 gy-5 " id="user_table">
                <thead class="">
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-capitalize gs-0">
                        <th class="min-w-125px ">{{ __('Sr No.') }}</th>
                        <th class="min-w-125px ">{{ __('User Name') }}</th>
                        <th class="min-w-125px ">{{ __('User Email') }}</th>
                        <th class="min-w-125px ">{{ __('User Phone Number') }}</th>
                        <th class=" min-w-70px">{{ __('Actions') }}</th>
                    </tr>
                </thead>

                <tbody class="fw-semibold text-gray-600">
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal For Edit The USer Detail --}}
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="innerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">{{__('Edit User')}}</h5>
                <button type="button" class=" btn btn-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user_form" action="{{route('update.user')}}" method="POST">
                    @csrf
                    <div class="mb-0 text-capitalize">
                        <div class="row gx-10 mb-5">
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('User Name') }}
                                </label>
                                <div class="mb-5">
                                    <input type="text" class="form-control form-control-solid" name="name" placeholder="User Name"  />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('User Email') }}
                                </label>
                                <div class="mb-5">
                                    <input type="email" class="form-control form-control-solid" name="email" placeholder="User Email" readonly />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('Phone Number') }}
                                </label>
                                <div class="mb-5">
                                    <input type="number" class="form-control form-control-solid" name="phone_number" placeholder="User Phone Number"  />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label fs-6 fw-bold text-gray-700 mb-3 required">{{ __('Password') }}</label>
                                <div class="mb-5 position-relative">
                                    <input type="password" class="form-control form-control-solid" placeholder="Password" name="password" />
                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showPasword" data-kt-password-meter-control="visibility">
                                        <i class="ki-duotone ki-eye-slash open fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                        <i class="ki-duotone ki-eye d-none close fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end position-relative" data-kt-customer-table-toolbar="base">
                        <button type="sumbit" class="btn btn-success me-3" id="update_user">{{ __('Update User') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    ///////////// serve-side DATA TABLE FOR User ////////////
    var dataTable = $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ordering: true,
        ajax: "{{ route('user.server.table') }}",

        columns: [
            {
                "data": "no"
            },
            {
                "data": "name",
            },
            {
                "data": "email",
            },
            {
                "data": "phone_number",
            },
           
            {
                "data": "action",
            },
        ],
    });
    ////////// ACTIVE INACTIVE COmpany STATUS////////////
    function changeUserStatus(id, activeStatus, url) {
        Swal.fire({
            text: "Do you want to change the status of the User?",
            icon: "question",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger",
            },
        }).then(function(result) {
            if (result.isConfirmed) {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        activeStatus: activeStatus
                    },
                    success: function(response) {
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        var checkbox = $('.toggle-class[data-id="' + id + '"]');
                        checkbox.prop('checked', activeStatus == 1);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            text: error,
                            icon: "error",
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    },
                });
            } else {
                Swal.fire({
                    text: "Action canceled",
                    icon: "info",
                    timer: 500, 
                    showConfirmButton: false,
                });
            }
        });
    }
    /// ON CLICK changeUserStatus FUNCTION CALL
    $(document).on('click', '.toggle-class', function() {
        var id = $(this).data('id');
        var activeStatus = $(this).prop('checked') == true ? 1 : 0;
        url = "/change-user-status"
        changeUserStatus(id, activeStatus, url);
        return false;
    });

    function editUser(id,name,email,phone_number){
        Swal.fire({
            text: "Do you want to Edit the User?",
            icon: "question",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger",
            },
        }).then(function(result) {
            if (result.isConfirmed) {
                $(`#editUser`).modal('show');
                $(`input[name="name"]`).val(name);
                $(`input[name="email"]`).val(email);
                $(`input[name="phone_number"]`).val(phone_number);
                $(`#user_form`).append(`<input type="hidden" name="id" value="${id}" />`);
            }
            else{
                 Swal.fire({
                    text: "Action canceled",
                    icon: "info",
                    timer: 500,
                    showConfirmButton: false,
                });
            }
        });
    }

    function deleteUser(id){
        Swal.fire({
            text: "Do you want to Delete the User?",
            icon: "question",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger",
            },
        }).then(function(result) {
            if (result.isConfirmed) {
               $.ajax({
                type: "POST",
                url: "{{route('delete.user')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function (response) {
                    console.log(response);
                    if(response.status_code == 200){
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            timer: 500,
                            showConfirmButton: false,
                        });
                        dataTable.ajax.reload();
                    }else{
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            timer: 500,
                            showConfirmButton: false,
                        });
                    }
                }
               });
            }
            else{
                 Swal.fire({
                    text: "Action canceled",
                    icon: "info",
                    timer: 500,
                    showConfirmButton: false,
                });
            }
        });
    }

    const form = document.getElementById("user_form");
    var validator = FormValidation.formValidation(form, {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "User Name is required",
                    },
                },
            },
            phone_number: {
                validators: {
                    notEmpty: {
                        message: "Phone number is required",
                    },
                    regexp: {
                        regexp: /^[0-9\s]+$/,
                        message:
                            "The phone number can only consist of numbers and spaces",
                    },
                    stringLength: {
                        min: 10,
                        max: 12,
                        message:
                            "The phone number must be between 10 and 12 characters long",
                    },
                },
            },
            email: {
                validators: {
                    emailAddress: {
                        message: "The value is not a valid email address",
                    },
                    notEmpty: {
                        message: "Email address is required",
                    },
                },
            },
        },
        plugins: {
            declarative: new FormValidation.plugins.Declarative({
                html5Input: true,
            }),
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5(),
        },
    });
    // Submit button handler
    const submitButton = document.getElementById("update_user");
    submitButton.addEventListener("click", function (e) {
        e.preventDefault();
        if (validator) {
            validator.validate().then(function (status) {
                if (status == "Valid") {
                    submitButton.disabled = true; // Disable button to prevent multiple clicks
                    var formData = new FormData(form);
                    $.ajax({
                        url: form.action, 
                        method: form.method, 
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false,
                            });
                            $(`#editUser`).modal('hide');
                            dataTable.ajax.reload();
                            form.reset();
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                            var errorMessage = '';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else {
                                errorMessage = 'Something went wrong. Please try again.';
                            }
                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                // timer: 2000,
                                showConfirmButton: true,
                            });
                        },
                        complete: function() {
                            submitButton.disabled = false; 
                        }
                    });
                } else {
                    const firstErrorField = form.querySelector(".is-invalid");
                    if (firstErrorField) {
                        firstErrorField.focus();
                    }
                }
            });
        }
    });


    $('.showPasword').on('click', function() {
        var passwordField = $(this).prev('input[name="password"]');
        var passwordIconClose = $(this).find('.open');
        var passwordIconOpen = $(this).find('.close');

        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            passwordIconClose.addClass('d-none');
            passwordIconOpen.removeClass('d-none');
        } else {
            passwordField.attr('type', 'password');
            passwordIconOpen.addClass('d-none');
            passwordIconClose.removeClass('d-none');
        }
    });

</script>

@endsection