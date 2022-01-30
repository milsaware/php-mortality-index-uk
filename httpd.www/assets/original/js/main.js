$('#timeline').bind('change', function(event) {
	var div = document.createElement('div');
		div.id = 'spinner';
		div.className = 'spinner';
	container.prepend(div);

	var yid = this.value;
		$.ajax({
		type: "POST",
		url: "/index.php?route=postRequest&action=fetch_desc",
		data: {yid: yid},
		success: function(data) {
			console.log(data);
			document.getElementById('container').innerHTML = '';
			document.getElementById('cod').innerHTML = data;
		}
	});
})

$('#cod').bind('change', function(event) {
	var div = document.createElement('div');
		div.id = 'spinner';
		div.className = 'spinner';
	container.prepend(div);

	var val = this.value;
	var yid = document.getElementById('timeline').value;
		$.ajax({
		type: "POST",
		url: "/index.php?route=postRequest&action=fetch_list",
		data: {val: val, yid: yid},
		success: function(data) {
			document.getElementById('container').innerHTML = data;
		}
	});
})

$('#side_nav_open').bind('click', function(event) {
	document.getElementById('side_nav').style.cssText = 'right:0;';
})

$('#side_nav_close').bind('click', function(event) {
	document.getElementById('side_nav').style.cssText = 'right:-315px;';
})
