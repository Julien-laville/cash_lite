jQuery(document).ready(function() {
	initPaimentMode()
    initFinalizeListener()
})

function initPaimentMode() {
	jQuery.ajax({
		url:"../controller/assync_configuration/configuration.php",
		data:{paramName:"paiementMode"},
    	dataType: "json",
    	type: "GET",
    	success: function(data) {
    		var options = []
            var paiments = data.paramValue.split("\n")
    		for(var i = 0; i < paiments.length; i += 1) {
    			options.push("<option>" + paiments[i] + "</option>")
    		}
            jQuery("#mode").html(options.join(""))
    	}
	})
}

function initFinalizeListener() {
    jQuery("#checkout").click(function() {
        
    })
}