jQuery.validator.addClassRules("required", {
    required: true,
    normalizer: function(value) {
        return $.trim(value);
    }
});

jQuery.validator.setDefaults({
  	errorClass: "is-invalid",
  	validClass: "is-valid",
  	errorPlacement : function(error, element) {
  		error.insertAfter(element);
  	},
  	success: function(label) {
	    return label;
	},
	showErrors: function(errorMap, errorList) {
		this.defaultShowErrors();
	}
});

/*$(document).ready(function() {
	$('form.validate').validate();
});*/