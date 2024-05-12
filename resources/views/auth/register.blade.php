<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Register</title>
    <meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="https://www.weballures.com/image/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
	<body id="kt_body" class="auth-bg">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1" style="background-color: #e7e6dd;">
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<div class="w-lg-500px p-10">
							<form class="form w-100" novalidate="novalidate" id="sign_up_form" data-kt-redirect-url="/" method="POST" action="{{ route('register') }}">
								@csrf
								<div class="text-center mb-11">
									<img src="assets/media/images/web_allures.webp" alt="image..." class="h-40px h-lg-60px mb-5">
									<h1 class="text-dark fw-bolder mb-3"> {{__('Sign Up')}}</h1>
								</div>
                                <div class="fv-row mb-8">
									<input  type="text" id="name" name="name" placeholder="Name" :value="old('name')" required autofocus autocomplete="name" class="form-control " />
								</div>
								<div class="fv-row mb-8">
									<input type="text" id="email" placeholder="Email"  type="email" name="email" :value="old('email')" required autocomplete="username" class="form-control " />
								</div>
								<div class="fv-row mb-8">
									<input type="text" id="phone_number" placeholder="Phone Number"  type="number" name="phone_number" :value="old('phone_number')" required class="form-control " />
								</div>
								
                                <div class="fv-row mb-8">
									<input placeholder="Password"  type="password" name="password" required  class="form-control " />
								</div>
								<div class="fv-row mb-8">
									<input placeholder="Confirm Password"  type="password" name="password_confirmation" required autocomplete="new-password" class="form-control " />
								</div>
								<div class="d-grid mb-10">
									<button type="submit" id="sing_up_submit" class="btn btn-primary">
									{{__('Sign up ')}}
									</button>
								</div>
								<div class="text-gray-500 text-center fw-semibold fs-6">{{__('Already have an Account?')}}
								<a href="{{route('login')}}" class="link-primary fw-semibold">{{__('Sign in')}}</a></div>
							</form>
						</div>
					</div>
					<div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
						<div class="me-10">
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-color: #ef756c">
                    <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                        <a href="https://www.weballures.com/" target="_blank" class="mb-0 mb-lg-12">
                            <img src="/assets/media/images/web_allures.webp"  alt="image..." class="h-40px h-lg-60px mb-5">
                        </a>
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="" alt="" />
                        <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Weballures Technologies believes in developing live versions of the  client’s business vision. </h1>
                    </div>
                </div>
			</div>
		</div>
		<script>
		var hostUrl = "assets/";
	</script>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script>
		const form = document.getElementById('sign_up_form');
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
						rowSelector: '.fv-row',
						eleInvalidClass: '',
						eleValidClass: ''
					})
				}
			}
		);
		const submitButton = document.getElementById("sing_up_submit");
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
		
	</body>
</html>