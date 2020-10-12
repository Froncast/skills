$(document).ready(function() {
	$('form').submit(function(event) {
		var json;
		event.preventDefault();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(result) {
				json = jQuery.parseJSON(result);
				if (json.url) {
					window.location.href = json.url;
				} else {
					// alert(json.status + ' - ' + json.message);
					if (json.status === 'success'){
                        $('.message').text(json.message).css('color', 'green');
                        setTimeout(function(){
                            $('.message').text('');
                        }, 5000);
					} else if(json.status === 'error') {
                        $('.message').text(json.message).css('color', 'red');
                        setTimeout(function(){
                            $('.message').text('');
                        }, 5000);
					} else{
                        alert('Что-то пошло не так, пожалуйста, попробуйте ещё раз! В случае сохранения проблемы обратитесь к разработчику!');
                    }
				}
			},
		});
	});
});