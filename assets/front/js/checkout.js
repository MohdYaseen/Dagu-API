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


$('#checkoutform').formValidation({
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
                mob: {
                    validators: {
                       mobileNumber:{}
                    }
                },
                 fname: {
                    validators: {
                        notEmpty: {
                            message: 'Enter First Name'
                        }
                    }
                },
                 lname: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Last Name'
                        }
                    }
                },
                addr_name: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Address Name'
                        }
                    }
                },
               area: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Area Name'
                        }
                    }
                },
                block: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Block Name'
                        }
                    }
                },
                street: {
                    validators: {
                        notEmpty: {
                            message: 'Enter street Name'
                        }
                    }
                },
                zip: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Zip Code'
                        }
                    }
                }
            }
        });
        
        


$('#add-review').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                
                review_email: {
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
                review_mob: {
                    validators: {
                       mobileNumber:{}
                    }
                },
                review_name: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Your Name'
                        }
                    }
                },
               comment: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Your Comment'
                        }
                    }
                }
            }
        });
        
        
        /*$("#heart_btn").click(function(){
var del_addr = $('textarea#delivery_addr').val();
var app_addr = $('textarea#app_addr').val();

$("#appoint_addr").val(app_addr);
$("#del_addr").val(del_addr);
$('#HeartBeatModal').modal('hide');
});*/

$('#heart-add-form').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                
                delivery_addr: {
                    validators: {
                    notEmpty: {
                        message: 'Please enter delivery address.'
                    },
                    }
                },
                app_addr: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter appointment address'
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();

            var del_addr = $('textarea#delivery_addr').val();
var app_addr = $('textarea#app_addr').val();

$("#appoint_addr").val(app_addr);
$("#del_addr").val(del_addr);
$('#HeartBeatModal').modal('hide');
});


$('#password-update-form').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                password1: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Password'
                        },
                        passwordss:{}
                    }
                },
                password2: {
                    validators: {
                        notEmpty: {
                            message: 'Re-Enter Password'
                        },
                         identical: {
                            field: 'password1',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        })