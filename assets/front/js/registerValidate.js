(function ($) {
    FormValidation.Validator.mobileNumber = {
        validate: function (validator, $field, options) {
            var value = $field.val();
            if (value == "") {
                return {
                    valid: false,
                    message: 'Please enter mobile number.'
                }
            }

            else if (isNaN(value) || value.indexOf(" ") != -1) {

                return {
                    valid: false,
                    message: 'Please enter numeric value.'
                }
            }

            else if (value.length > 10 || value.length < 10) {

                return {
                    valid: false,
                    message: "Please enter 10 digit number."
                }
            }
            
            else {
                return true;
            }

        }
    };
}(window.jQuery));

(function ($) {
    FormValidation.Validator.passwordss = {
        validate: function (validator, $field, options) {
            var val = $field.val();
            var ren = /[0-9]/;
            var rea = /[a-z]/;
            var reA = /[A-Z]/;
    if(val.length < 8) {
        return {
                    valid: false,
                    message: 'Password must contain at least 8 characters.'
                }
      }
     
     
      else if(!ren.test(val)) {
        return {
                    valid: false,
                    message: 'password must contain at least one number (0-9)'
                }
      }
      
      else if(!rea.test(val)) {
        return {
                    valid: false,
                    message: 'password must contain at least one letter (a-z)'
                }
      }

      else{
            return true;
        }
    }
};
}(window.jQuery));

$('#register-form').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                firstName: {
                    validators: {
                        notEmpty: {
                            message: 'Enter First Name'
                        }
                    }
                },
               lastName: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Last Name'
                        }
                    }
                },
                email: {
                    validators: {
                    notEmpty: {
                        message: 'Please enter email address.'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'The value is not a valid email address'
                    },
                    }
                },
                mob: {
                    validators: {
                       mobileNumber:{}
                    }
                },
                pass: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Password'
                        },
                        passwordss:{}
                    }
                },
                confirmpass: {
                    validators: {
                        notEmpty: {
                            message: 'Re-Enter Password'
                        },
                         identical: {
                            field: 'pass',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                rememberMe:{
                validators: {
                        notEmpty: {
                            message: 'Please agree our terms and condition'
                        }
                }
              },
            }
        }).on('err.validator.fv', function (e, data) {
        if (data.field === 'email') {
            data.element
                .data('fv.messages')
                .find('.help-block[data-fv-for="' + data.field + '"]').hide()
                .filter('[data-fv-validator="' + data.validator + '"]').show();
            }
        });