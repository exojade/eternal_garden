<script>

$(document).on("click", ".open_modal", function () {
     var id = $(this).data('id');
     console.log(id);
     $("#modal_add_client .modal-body #slot_id").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     $('#modal_add_client').modal('show');
});







$(document).ready(function() {
     var total = 0;
    //set initial state.
    $('.amount_class').change(function() {
        if(this.checked) {
          var amount = $(this).data('amount');
          total = total + amount;
          console.log(total);
          //   var returnVal = confirm("Are you sure?");
          //   $(this).prop("checked", returnVal);
        }
        else{
          var amount = $(this).data('amount');
          total = total - amount;
          console.log(total);
        }
        $('#total').val(total);        
    });
});





function createButton(text, cb) {
  return $('<button class="btn btn-primary btn-flat" style="margin: 0px 10px 0px 10px;">' + text + '</button>').on('click', cb);
}

$(document).on('click', '.SwalBtn1', function() {
        //Some code 1
     //    console.log('Button 1');
        var id = $(this).data('id');
        window.open("coffin_crypt?action=new&slot_id="+id+"&option=indigent", "_blank");
        swal.close();
    });
    $(document).on('click', '.SwalBtn2', function() {
        //Some code 2 
     //    console.log('Button 2');
        var id = $(this).data('id');
        window.open("coffin_crypt?action=new&slot_id="+id+"&option=ordinary", "_blank");
        swal.close();
    });


$('.coffin_crypt_form').submit(function(e) {
      e.preventDefault();
      var url = $(this).data('url');
      var my_id = $(this).data('my_id');
      console.log(my_id);

        var promptmessage = 'Occupy Coffin Crpyt';
        var prompttitle = 'COFFIN CRYPT';
    
        swal({
            title: prompttitle,
            text: promptmessage,
            type: 'info',
            showConfirmButton: true,
            showCancelButton: true
          //   confirmButtonText: 'Ordinary',
          //   cancelButtonText: 'Indigent'
        }).then((result) => {
            if (result.value) {
                location.replace("profile?action=client_details&slot="+my_id+"");
                swal.close();
            }
            else{

              // console.log($(this).serialize());
          //     swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
          //   $.ajax({
          //       type: 'post',
          //       url: url,
          //       data: $(this).serialize() + '&quincena=2',
          //       success: function (results) {
          //       var o = jQuery.parseJSON(results);
          //       console.log(o);
          //       if(o.result === "success") {
          //           swal.close();
                 
          //           swal({title: "Submit success",
          //           text: o.message,
          //           type:"success"})
          //           .then(function () {
          //           //window.location.replace('./applicant.php?page=list');
          //           window.location.replace(o.link);
          //           });
          //       }
          //       else {
          //           swal({
          //           title: "Error!",
          //           text: o.message,
          //           type:"error"
          //           });
          //           console.log(results);
          //       }
          //       },
          //       error: function(results) {
          //       console.log(results);
          //       swal("Error!", "Unexpected error occur!", "error");
          //       }
          //   });

            }
        });
    });


</script>