$(function () {
	
	$('.vanish').show();
	// $('.messageNewsletter').html('');
	// $('.messageNewsletter').hide();
	$('#submitNewsletter').click(function (event) {
		var $myForm = $('#newsletter-form');

		// check validity html5 form
		if($myForm[0].checkValidity()) {
			$('#submitNewsletter').prop('disabled', true);
			$.post(
			  'newsletter.php', {
				email: $('input[name=email]').val()
			  }, function (data) {
				  if(data === "true") {
					  // $(".messageNewsletter").html("<h5>Merci</h5>");
					  $(".pop-up").hide();
					  // $('.messageNewsletter').show();

					 
				  }
				  else {
					  $(".messageNewsletter").html(data);

				  }
			  }
			);
			$('#submitNewsletter').prop('disabled', false);
			event.preventDefault();
		  }
	});
	$('.pop-up').hide();
	$('.btn-pop').click(function(){
		$('.pop-up').toggle('slow');
	})
});