$(document).ready(function() {

    $('#form')
        // IMPORTANT: You must declare .on('init.field.bv')
        // before calling .bootstrapValidator(options)
        .on('init.field.fv', function(e, data) {
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            var $icon      = data.element.data('fv.icon'),
                options    = data.fv.getOptions(),                      // Entire options
                validators = data.fv.getOptions(data.field).validators; // The field validators

            if (validators.notEmpty && options.icon && options.icon.required) {
                // The field uses notEmpty validator
                // Add required icon
                $icon.addClass(options.icon.required).show();
            }
        })

        .formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                required: 'fa fa-asterisk',
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            },
            fields: {
                zipcode: {
                    validators: {
                        zipCode: {
                            country: 'country',
                            message: 'The value is not valid %s postal code'
                        }
                    }
                },
                date: {
                	validators: {
                    	date: {
                        	format: 'MM/DD/YYYY',
                       		message: 'The value is not a valid date'
                 	   }
                	}
            	},
                password: {
                    validators: {
                        identical: {
                            field: 'password_confirmation',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        })

        .on('status.field.fv', function(e, data) {
            // Remove the required icon when the field updates its status
            var $icon      = data.element.data('fv.icon'),
                options    = data.fv.getOptions(),                      // Entire options
                validators = data.fv.getOptions(data.field).validators; // The field validators

            if (validators.notEmpty && options.icon && options.icon.required) {
                $icon.removeClass(options.icon.required).addClass('fa');
            }
        });

        
});