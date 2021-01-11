"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'E-posta adresi gerekli'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Şifre gereklidir'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
                    var data = $("#kt_login_signin_form").serialize();
                    var url  = "/tavsiocms/loginproccess";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        dataType: "json",
                        success: function(result){
                            swal.fire({
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Tamam anladım!",
                                html: result.message,
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            }).then(function() {
                                window.location="/tavsiocms";
                            });
                        },
                        error: function (xhr) {
                            let result = xhr.responseJSON;
                            let resultCnt = '';

                            grecaptcha.ready(function() {
                                grecaptcha.execute('6LfuZcUZAAAAAFXBQLJoErpkd8UdCet8530IbZrE',{ action: 'homepage' }).then(function(token) {
                                    $('input[name=g-recaptcha-response]').remove();
                                    $('#kt_login_signin_form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
                                });
                            });

                            switch (result.status) {
                                case 'invalidArg':
                                    $.each(result.message,function (index, item) {
                                        resultCnt += '<p>'+ item[0] +'</p>';
                                    });

                                    swal.fire({
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Tamam anladım!",
                                        html: resultCnt,
                                        customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}
                                    }).then(function () {
                                        KTUtil.scrollTop()
                                    });

                                    break;
                                default:
                                    swal.fire({
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Tamam anladım!",
                                        html: result.message,
                                        customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}
                                    }).then(function () {
                                        KTUtil.scrollTop()
                                    });

                                    break;
                            }
                        }
                    });
				}
		    });
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
