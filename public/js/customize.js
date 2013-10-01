jQuery(document).ready(function() {
	initFields()
	jQuery("textarea,input").change(function() {
		updateField(this)
	})
})

function updateField(field) {
	$field = jQuery(field)
	var fieldValue = $field.val()
	var fieldName = field.id
	jQuery.ajax({
		url:"../controller/assync_configuration/configuration.php",
    	dataType: "json",
    	type: "POST",
    	data:{paramName:fieldName, paramValue:fieldValue},
    	success: function(data) {
    		alert(data)
    	}
	})
}

function initFields() {
	paramNames = ["paiementMode"]
	jQuery.ajax({
		url:"../controller/assync_configuration/configuration.php",
    	dataType: "json",
    	type: "get",	
    	data:{paramName:paramNames},
    	success: function(data) {
    		for(var i = 0; i < data.length; i += 1) {
    			var configurationName = data[i].paramName
    			var configurationValue = data[i].paramValue
    			jQuery("#" + configurationName).val(configurationValue)
    		}
    	}
	})
}