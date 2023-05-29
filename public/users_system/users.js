
    $(document).ready(function () {
		 $('.select2').select2()
            var url = "public/users_system/roles.json";
            $.getJSON(url, function (data) {
                $.each(data, function (index, value) {
                    // APPEND OR INSERT DATA TO SELECT ELEMENT.
                    $('#roles').append('<option value="' + value.Name + '">' + value.Name + '</option>');
                });
            });
    });

	// $("#table-search").keyup(function(event) {
	// 	if (event.keyCode === 13) {
	// 		searchtable();
	// 	}
	// });






	$(function () {
		$('#simple-datatable').DataTable()
		
	  })


	//   $.getJSON("public/users_system/roles.json", function( json ) {
	// 	$.each(json, function(key, value) {
	// 	$('#roles').append('<option value="' + value.Name + '">' + value.Name + '</option>');
	// 	});
	// });



	




	   $(document).on('click', '#reset', function(){
	   var rowid = $(this).data("id");
	   var name = $(this).data("name");
			swal({
			  title: 'Do you want to reset password ' + name + '?',
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonText: 'Yes, open it!',
			  cancelButtonText: 'Cancel'
			}).then((result) => {
			  if (result.value) {
					$.ajax({
						type : 'post',
						url : 'users', //Here you will fetch records 
						data :  'user_id='+ rowid+"&action=reset_password", //Pass $id
						success : function(data){
							$("#btn").trigger("click");
							swal("Good job!", "You clicked the button!", "success")
						// $('.fetched-data2').html(data);//Show fetched data from database
						}
					});
			  
			  } else {
				
			  }
			})
		});


		$('#users_form').submit(function(e) {
			var promptmessage = 'This form will be submitted. Are you sure you want to continue?';
			var prompttitle = 'Data submission';
		  e.preventDefault();
		  swal({
			title: prompttitle,
			text: promptmessage,
			type: 'info',
			showCancelButton: true,
			confirmButtonText: 'Yes',
			cancelButtonText: 'Cancel'
		  }).then((result) => {
			if (result.value) {
			  $.ajax({
				type: 'post',
				url: 'users',
				data: $('#users_form').serialize(),
				success: function (results) {
				  swal.close();
				  var o = jQuery.parseJSON(results);
				  console.log(o);
				  if(o.result === "success") {
					swal({title: "Submit success",
					  text: "Record has been successfully saved.",
					  type:"success"})
					.then(function () {
					  //window.location.replace('./applicant.php?page=list');
					  window.location.replace('users');
					});
				  }
				  else if(o.result === "alreadyexist") {
					swal({
					  title: "Error!",
					  text: "This applicant info is already in our database!",
					  type:"error"
					});
				  }
				  else {
					swal({
					  title: "Error!",
					  text: "Sorry! Something is wrong with the submission of data!",
					  type:"error"
					});
					console.log(results);
				  }
				},
				error: function(results) {
				  console.log(results);
				  swal("Error!", "Unexpected error occur!", "error");
				}
			  });
			  // --- end of ajax
			}
		  });
		});
