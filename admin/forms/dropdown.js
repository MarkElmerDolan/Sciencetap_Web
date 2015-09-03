	$('#dataType0').on("change", function(){
				console.log("change");
				if($(this).val() == 'Dropdown'){
							console.log("dd");
					$('#list0').append(
						"<br/>"+
						'<input type="text" name="list0[]" id="val' + list0len + '" class="form-control">' +
						'<button type="button" class="btn btn-primary btn-xs" onclick="addListVal()">Add Another Dropdown Value</button>'
					);
				}else{
					$('#list0').html('');
				}
	});
	
	var addListVal = function(){
		list0len++;
		var listElement = '<br><input type="text" name="list0[]" id="val' + list0len + '" class="form-control">';
		$("#list0").append(listElement);
	};