jQuery(document).ready(function() {
	initDateIntervals()
	initDateSlider()
	loadDefaultLog()
})



function initDateIntervals() {

}
function initDateSlider() {

}
function loadDefaultLog() {
	jQuery.ajax({
		url:"./assync_articles/logs.php",
    	dataType: "json",
    	type: "POST",
    	success: function(data) {
    		for(var i in data.length) {
    			showLog(data[i])
    		}
    	})
	})
}
function showLog(jsonLog) {
	var htmlLog = new EJS({url:'./templates/_log.ejs'}).render(jsonLog)
	var $htmlLog = jQuery(htmlLog)
	jQuery("#ventes").append($htmlLog)
}