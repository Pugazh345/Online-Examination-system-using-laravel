
$(document).ready(function(){
    // For A Delete Record Popup
    $('.addqnbtn').click(function() {

        var examid = $(this).data('examid');
        $(".modal-body #examid").val( examid );

    });

});


$(document).ready(function(){
    // For A Delete Record Popup
    $('.remove-record').click(function() {
        var id = $(this).attr('data-sub_id');
        var url = $(this).attr('data-url');
        var token =  $('meta[name="csrf-token"]').attr('content');
        $(".remove-record-model").attr("action",url);
        $('.remove-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
        $('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
        
        $('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
        

    });

    $('.edit-record').click(function() {
        var id = $(this).attr('data-sub_id');
        var url = $(this).attr('data-url');
        var token =  $('meta[name="csrf-token"]').attr('content');
        // var name = $(this).attr('data-name');
        // var email = $(this).attr('data-email');
        // var edpassword = $(this).attr('data-pass');
        // var sub = $(this).attr('data-subject');

        $(".edit-record-model").attr("action",url);
        $('.edit-record-model').append('<input name="_token" type="hidden" value="'+ token +'">');
        // $('.edit-record-model   #edname').attr("value",name);
        //$('.edit-record-model   #eduserid').attr("value",userid);
        // $('.edit-record-model   #edemail').attr("value",email);
        // $('.edit-record-model   #edpassword').attr("value",edpassword);
        //$('.edit-record-model   #edmobilenum').attr("value",mobilenum);
        // $('.edit-record-model   #edstudent_sub_idfk').val(sub);

        
        $('.edit-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
        

    });


    

    $('.remove-data-from-delete-form').click(function() {
        $('.remove-record-model').find( "input" ).remove();
    });
    $('.modal').click(function() {
        // $('body').find('.remove-record-model').find( "input" ).remove();
    });
});

