@extends('layouts.main')
@section('title','Account Overview')
@section('content')

<!--begin::Container-->
<div id="kt_content_container">
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="assets/media/avatars/300-1.jpg" alt="image" />
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{Auth::user()->name ?? ''}}</a>
                                <a href="#">
                                    <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                </a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{Auth::user()->name ?? ''}}</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>{{Auth::user()->address ?? ''}}</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                    <i class="ki-outline ki-sms fs-4"></i>{{Auth::user()->email ?? ''}}</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->

                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->

                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

        </div>
    </div>
    <!--end::Navbar-->
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bold m-0">Profile Details</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <button type="button" class="btn btn-sm btn-success align-self-center" onclick="editProfile()">Edit Profile</button>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->name ?? ''}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Role</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->role->role ?? ''}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Contact Phone
                    <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                        <i class="ki-outline ki-information fs-7"></i>
                    </span></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 d-flex align-items-center">
                    <span class="fw-bold fs-6 text-gray-800 me-2">{{Auth::user()->phone_number ?? ''}}</span>
                    <span class="badge badge-success">Verified</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            {{-- <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Company Site</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <a href="https://carsonlogistics.net" target="_blank" class="fw-semibold fs-6 text-gray-800 text-hover-primary">https://carsonlogistics.net</a>
                </div>
                <!--end::Col-->
            </div> --}}
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-semibold text-muted">Communication</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">Email, Phone</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Card body-->
    </div>
    <!--end::details View-->

</div>
<!--end::Container-->


{{-- Edit MOdal --}}
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="innerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">{{__('')}}</h5>
                <button type="button" class=" btn btn-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="profile_update" action="{{route('update.profile')}}" method="POST">
                    @csrf
                    <div class="mb-0 text-capitalize">
                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                        <div class="row gx-10 mb-5">
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('Name') }}
                                </label>
                                <div class="mb-5">
                                    <input type="text" class="form-control form-control-solid" name="name" value="{{Auth::user()->name}}" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('Phone Number') }}
                                </label>
                                <div class="mb-5">
                                    <input type="text" class="form-control form-control-solid" name="phone_number" value="{{Auth::user()->phone_number}}" placeholder="Phone Number" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('Email') }}
                                </label>
                                <div class="mb-5">
                                    <input type="email" class="form-control form-control-solid" name="email" value="{{Auth::user()->email}}" required>
                                </div>
                            </div>
                             <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('Password') }}
                                </label>
                                <div class="mb-5">
                                    <input placeholder="Password"  type="password" name="password" required  class="form-control form-control-solid" />
                                </div>
							</div>
                            <div class="col-lg-4">
                                <label class="form-label fs-4 fw-bold text-gray-700 mb-3  required">{{ __('Confirm Password') }}
                                </label>
                                <div class="mb-5">
                                    <input placeholder="Password"  type="password" name="password_confirmation" required  class="form-control form-control-solid" />
                                </div>
							</div>
                            
                        </div>
                    </div>
                    <div class="d-flex justify-content-end position-relative" data-kt-customer-table-toolbar="base">
                        <button type="sumbit" class="btn btn-success me-3" id="update_profile">{{ __('Update Profile') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        
        function editProfile(){
            $(`#editProfile`).modal('show');
        }

		const form = document.getElementById('profile_update');
		var validator = FormValidation.formValidation(
			form, {
				fields: {
					'name': {
						validators: {
							notEmpty: {
								message: "Name is required",
							},
						},
					},
					'email': {
						validators: {
							emailAddress: {
								message: "The value is not a valid email address",
							},
							notEmpty: {
								message: "Email address is required",
							},
						},
					},

					'phone_number': {
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
								message: "The phone number must be between 10 and 12 characters long",
							},
						},
					},
					'password': {
						validators: {
							notEmpty: {
								message: "Password is required",
							},
							stringLength: {
								min: 8,
								message:
									"The Password must not be less than 8 characters",
							},
						},
					},
					'password_confirmation': {
						validators: {
							notEmpty: {
								message: "Confirm password is required",
							},
							identical: {
								compare: function () {
									return form.querySelector('[name="password"]').value;
								},
								message: "The password and confirm password must match",
							},
						},
					},




				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
						eleInvalidClass: '',
						eleValidClass: ''
					})
				}
			}
		);
		const submitButton = document.getElementById("update_profile");
		submitButton.addEventListener("click", function (e) {
			e.preventDefault();
			if (validator) {
				validator.validate().then(function (status) {
					if (status == "Valid") {
						submitButton.disabled = false;
						$(this).on("click", function () {
							submitButton.disabled = true;
							form.submit();
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
	</script>
@endsection