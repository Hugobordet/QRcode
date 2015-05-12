captured_time = 0;
delay = 10;

function read(a)
{
    var d = new Date();
    d.setSeconds(d.getSeconds() - delay);
    if (captured_time == 0 || captured_time < d.getTime()) {
    	var time = new Date();
    	captured_time = time.getTime();
    	//data.push({'id': a, 'time': captured_time});
    	jQuery.ajax('http://qr.local/scan.php?id=' + a, {success: function(data, status, jqXHR) {     	$("#qr-value").text(data); }})
    }
}
    
qrcode.callback = read;