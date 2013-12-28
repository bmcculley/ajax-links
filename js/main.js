jQuery(document).ready(function($){

	$('#newLink').click(function(e){
		e.preventDefault();
		$('.modal').show();
		$('.modal-background').show();
		$('#title').focus();
	});
	$('.cancel-link').click(function(e){
		e.preventDefault();
		$('.modal').hide();
		$('.modal-background').hide();
	});
	$(document).keyup(function(e){
	    if(e.keyCode === 27){
	    	$('.modal').hide();
			$('.modal-background').hide();
	    }
	});
	$('#submit').click(function(e){
		e.preventDefault();
		var title = $('#title').val();
		var url = $('#url').val();
		var ip = $('#ip').val();
		var wid = $('#wid').val();

		$.ajax({
			type : 'POST',
			url : 'post.php',
			dataType : 'json',
			data: {
				title : title,
				url   : url,
				ip    : ip,
				wid   : wid
			},
			success : function(data){
				
				$('#errorMessage').removeClass().addClass((data.error === true) ? 'error' : 'success')
					.text(data.msg).show(500);
					if (data.error === true) {
						if (data.eh === "title") {
							$('#title').removeClass().addClass('error');
						}else {
							$('#title').removeClass('error').addClass();
						}
						
						if (data.eh === "url") {
							$('#url').removeClass().addClass('error');
						}else {
							$('#url').removeClass('error').addClass();
						}
						
					}
					else {
						$('#link-list').prepend('<li><a href="'+url+'">'+title+'</a></li>');
						$('.modal').hide();
						$('.modal-background').hide();
						$(':input', '#quickpost').not(':submit').val('');
					}
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					$('#errorMessage').removeClass().addClass('error')
						.text('There was an error.').show(500);
				}
		});
		
		return false;
	});
});