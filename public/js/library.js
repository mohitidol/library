$(document).ready(function(){
	$('#success').hide();
	$('#error').hide();
	$(".issue").click(function() {
		if( $('#book_name').val().length <= 0 ) {
			$('#error').show().html('Please enter book name');
		} else {
			$.ajax({
				type:'POST',
				url:'/book/public/book/issuebook',
				data:{Name:$('#book_name').val()},
				beforeSend: function(){
					$('#loading-image').show();
				},
				success:function(response) {
					data = JSON.parse(response);
					if( data.status == true ) {
						$('#error').hide();
						$('#success').show().html(data.message);
						$.ajax({
							url:'/book/public/book/listbook',
							success:function(response) {						
								$('#bookList').html(response);
								return false;
							}});
					} else {
						$('#success').hide();
						$('#error').show().html(data.message);
					}
				},
				complete: function(){
					$('#loading-image').hide();
				}
			});
		}
	});

	$(".return").click(function() {
		if( $('#book_name').val().length <= 0 ) {
			$('#error').show().html('Please enter book name');
		} else {
			$.ajax({
				type:'POST',
				url:'/book/public/book/returnbook',
				data:{Name:$('#book_name').val()},
				beforeSend: function(){
					$('#loading-image').show();
				},
				success:function(response) {
					data = JSON.parse(response);
					if( data.status == true ) {
						$('#error').hide();
						$('#success').show().html(data.message);
						$.ajax({
							url:'/book/public/book/listbook',
							success:function(response) {
								$('#bookList').html(response);
								return false;
							}});
					} else {
						$('#success').hide();
						$('#error').show().html(data.message);
					}
				},
				complete: function(){
					$('#loading-image').hide();
				}
			});
		}   
	});

	$(".availability").click(function() {
		if( $('#book_name').val().length <= 0 ) {
			$('#error').show().html('Please enter book name');
		} else {
			$.ajax({
				type:'POST',
				url:'/book/public/book/checkavailability',
				data:{Name:$('#book_name').val()},
				beforeSend: function(){
					$('#loading-image').show();
				},
				success:function(response) {
					data = JSON.parse(response);
					if( data.status == true ) {
						$('#error').hide();
						$('#success').show().html(data.message);
					} else {
						$('#success').hide();
						$('#error').show().html(data.message);
					}
				},
				complete: function(){
					$('#loading-image').hide();
				}
			});
		}
	});
});

