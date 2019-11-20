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
        label.closest('.form-group').addClass('is-submitted');
	    return label;
	},
	showErrors: function(errorMap, errorList) {
        for(var i = 0; i < errorList.length; i++) {
            var element = $(errorList[i].element);
            element.closest('.form-group').addClass('is-submitted');
        }
		this.defaultShowErrors();
	}
});

/*$(document).ready(function() {
	$('form.validate').validate();
});*/