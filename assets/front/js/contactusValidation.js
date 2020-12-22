$('#contact-form').formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Enter Name'
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
                subject: {
                    validators: {
                        notEmpty: {
                            message: 'Enter subject'
                        }
                    }
                },
                  message:{
                validators: {
                        notEmpty: {
                            message: 'Please enter message'
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