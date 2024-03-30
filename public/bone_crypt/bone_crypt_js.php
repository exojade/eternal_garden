<script>

$(document).on("click", ".open_modal", function () {
     var id = $(this).data('id');
     console.log(id);
     $("#modal_add_client .modal-body #slot_id").val( id );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     $('#modal_add_client').modal('show');
});


<?php if($_GET["action"] == "new"): ?>
$(document).ready(function() {
    var total = 0;
    var additional_cost = 0;
    $("#bone_options").change(function() {
        var val = $(this).val();
        console.log(val);
        if(val === "one_bone") {
            $(".one_bone").show();
            // $(".one_bone input").prop("disabled", false);
            $(".one_bone input").val("");
            $(".one_bone input").prop('required',true);
            $('.one_bone input').removeAttr('disabled')
            // $('.disabledCheckboxes').prop("disabled", true);
            // $('.disabledCheckboxes').removeAttr("disabled");
            $(".two_bone input").prop("disabled", true);
            $(".two_bone").hide();
            $(".two_bone input").val("");
            $('.two_bone input').removeAttr('required')

            $(".three_bone").hide();
            $(".three_bone input").prop("disabled", true);
            $(".three_bone input").val("");
            $('.three_bone input').removeAttr('required')
            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["one_bone"]); ?>;
            $('#total').val(total);  
        }

        else if(val === "two_bone"){
            $(".one_bone").hide();
            $(".one input").prop("disabled", true);
            $(".one_bone input").val("");
            $('.one_bone input').removeAttr('required')

            $(".two_bone").show();
            $('.two_bone input').removeAttr('disabled')
            $(".two_bone input").val("");
            $(".two_bone input").prop('required',true);

            $(".three_bone").hide();
            $(".three_bone input").prop("disabled", true);
            $(".three_bone input").val("");
            $('.three_bone input').removeAttr('required')
            // $(".three_bone input").prop('required',true);
            
            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["two_bone"]); ?>;
            $('#total').val(total);  
        }

        else if(val === "three_bone"){
            $(".one_bone").hide();
            $(".one input").prop("disabled", true);
            $(".one_bone input").val("");
            $('.one_bone input').removeAttr('required')
            

            $(".two_bone input").prop("disabled", true);
            $(".two_bone").hide();
            $(".two_bone input").val("");
            $('.two_bone input').removeAttr('required')

            $(".three_bone").show();
            $('.three_bone input').removeAttr('disabled')
            $(".three_bone input").val("");
            $(".three_bone input").prop('required',true);
            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["three_bone"]); ?>;
            $('#total').val(total);  
        }
  
    });


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

<?php endif; ?>




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

        var promptmessage = 'Occupy Bone Crpyt';
        var prompttitle = 'Bone CRYPT';
    
        swal({
            title: prompttitle,
            text: promptmessage,
            // html: "Some Text" +
            // "<br>" +
            // '<a href="#" data-id="'+my_id+'" class="SwalBtn1 btn-flat btn btn-primary">' + 'INDIGENT' + '</a>' +
            // '<a href="#" data-id="'+my_id+'" class="SwalBtn2 btn-flat btn btn-primary">' + 'ORDINARY' + '</a>',
            type: 'info',
            showConfirmButton: true,
      showCancelButton: true
          //   confirmButtonText: 'Ordinary',
          //   cancelButtonText: 'Indigent'
        }).then((result) => {
            if (result.value) {
                location.replace("profile?action=client_details&slot="+my_id+"");
                swal.close();
            // --- end of ajax
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