(function ($) {
    FormValidation.Validator.mobileNumber = {
        validate: function (validator, $field, options) {
            var value = $field.val();
            if (value === "") {
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


$("#login_pass").keyup(function () {
    $('#change-pass-form').formValidation({
            framework: 'bootstrap',
            excluded: '',
            fields: {
                login_pass: {
                    validators: {
                        passwordss:{}
                    }
                }
            }
        }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);

    $form.formValidation('disableSubmitButtons', false);
    $('#change-pass-form').formValidation('destroy');
});
    if($("#login_pass").val()===''){
        $('#change-pass-form').formValidation('destroy');
    }
});

    $('#change-pass-form').formValidation({
            framework: 'bootstrap',
            excluded: '',
            fields: {
                mobile: {
                    validators: {
                       mobileNumber:{}
                    }
                }
          }
        }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);

    $form.formValidation('disableSubmitButtons', false);
    $('#change-pass-form').formValidation('destroy');
});

