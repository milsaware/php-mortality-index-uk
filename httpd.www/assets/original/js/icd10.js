$('#icd_chapter').bind('change', function(event) {
		var div = document.createElement('div');
			div.id = 'spinner';
			div.className = 'spinner';
		container.prepend(div);

		var chapter = this.value;
			$.ajax({
			type: "POST",
			url: "/index.php?route=postRequest&action=fetch_icd_parent",
			data: {chapter: chapter},
			success: function(data) {
				document.getElementById('container').innerHTML = '';
				document.getElementById('icd_parent').innerHTML = data;
			}
		});
})

$('#icd_parent').bind('change', function(event) {
		var div = document.createElement('div');
			div.id = 'spinner';
			div.className = 'spinner';
		container.prepend(div);

		var parent_id = this.value;
			$.ajax({
			type: "POST",
			url: "/index.php?route=postRequest&action=fetch_icd_child",
			data: {parent_id: parent_id},
			success: function(data) {
				document.getElementById('container').innerHTML = '';
				document.getElementById('icd_child').innerHTML = data;
			}
		});
})
