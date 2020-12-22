(function ($) {
    FormValidation.Validator.passwords = {
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
      else{
            return true;
        }
    }
};
}(window.jQuery));

$('#login-form').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
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
               pass: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Password'
                        },
                        passwords:{}
                    }
                }
            }
        })/*.on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target),
            fv = $form.data('formValidation');
            var form=$("#login");
          $.ajax({
          type:"POST",
          url: base_url+'check-user',
          dataType:"JSON",
          data: form.serialize(),
          beforeSend: function(){
            waitingDialog.show('Loading.....', {dialogSize: 'sm', progressType: 'warning'});setTimeout(function () {waitingDialog.hide();}, 3000);
           },
          success: function(result) {
          if(result == true)
          {
           setTimeout(function() {
                $('#logedin').modal();
            }, 4000);
           $('#logedin').on('hidden.bs.modal', function() {
            window.location = base_url;
          });
            }
          else{
            setTimeout(function() {
                $('#notlogedin').modal();
            }, 4000);
          }
        },
          error: function(result) {
               alert('error');
            }
         });
          return false;
        })*/.on('err.validator.fv', function (e, data) {
        if (data.field === 'email') {
            data.element
                .data('fv.messages')
                .find('.help-block[data-fv-for="' + data.field + '"]').hide()
                .filter('[data-fv-validator="' + data.validator + '"]').show();
            }
        });
        
        
        $('#forgotpass').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                forgotEmail: {
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
              }
            });
        