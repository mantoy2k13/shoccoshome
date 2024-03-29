var navTabs = (type)=> {
    if(type==1){
        $('.nav2').removeClass('active');
        $('.nav1').addClass('active');
    } else{
        $('.nav1').removeClass('active');
        $('.nav2').addClass('active');
    }
}

var checkPass = ()=>{
    var curPass = $('#curPassword').val();
    var npass   = $('#nPassword').val();
    var cpass   = $('#cPassword').val();

    if(curPass&&npass&&cpass){
        if(npass!=cpass){
            $('#pass-err-msg').html(''+
                '<div class="alert alert-danger alert-dismissible m-t-20 f-15" role="alert">'+
                    '<strong><i class="fa fa-check"></i> Failed!</strong> New password must be equal to confirm password.'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                    '</button>'+
                '</div>'
            );
        } else{
            swal({
                title: "Change Password?",
                text: "Your password will be changed and save to database. Continue?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, continue!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#fa9737",
            },
            ()=>{
                $.ajax({
                    url: base_url+'account/change_password',
                    type: 'POST',
                    data: { npass: npass, curPass: curPass },
                    success: (res)=>{
                        if(res!=0){
                            swal("Change!", "Password change successfully.","success");
                            $('#pass-err-msg').html('');
                        } else{
                            swal("Failed!", "Please check your password.","error");
                            $('#pass-err-msg').html(''+
                                '<div class="alert alert-danger alert-dismissible m-t-20 f-15" role="alert">'+
                                    '<strong><i class="fa fa-check"></i> Oopss!</strong> Current password is incorrect.'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                    '</button>'+
                                '</div>'
                            );
                        }
                    }
                });
            });
        }
    } else{
        $('#pass-err-msg').html(''+
            '<div class="alert alert-danger alert-dismissible m-t-20 f-15" role="alert">'+
                '<strong><i class="fa fa-check"></i> Oops!</strong> Please fill out all fields below.'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'
        );
    }
}

function readURL(input) {
    var fileInput = document.getElementById('input-img');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        swal("Upload Failed", "Please select a valid image with .jpeg/.jpg/.png/.gif extensions.","warning");
        fileInput.value = '';
        return false;
    } else{
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-profile').attr('src', e.target.result);
                $('#img-profile').hide();
                $('#img-profile').fadeIn(650);
                $('.saveImgBtn').removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }   
}

function fileValidation(){
    var fileInput = document.getElementById('file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        swal("Upload Failed", "Please select a valid image with .jpeg/.jpg/.png/.gif extensions.","warning");
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img-profile').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
  
$("#input-img").change(function() {
    readURL(this);
});

var cImgChange = (type) => {
    var text = (type==1) ? 'Pictures' : 'Albums';
    swal({
        title: "Note!",
        text: "You will be redirected to "+text+" page. Do you want to continue?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, continue!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#fa9737",
    },
    ()=>{
        window.location.href = (type==1) ? base_url+"pictures/pictures" : base_url+"album/albums";
    });
}

$("#imgForm").on('submit',(function(e) {
    e.preventDefault();
    swal({
        title: "Update Image?",
        text: "Your profile image will be change.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, update!",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonColor: "#fa9737",
    },
    ()=>{
        $.ajax({
            url: base_url+"account/uploadImg",
            type: "POST",
            data: new FormData(this), 
            contentType: false,
            cache: false, 
            processData:false, 
            success: function(res){
                if(res==1){
                    swal('Saved!', 'Profile image was successfully changed.', 'success');
                    $('.saveImgBtn').addClass('d-none');
                } else{
                    swal('Failed!', 'A problem occured please try again.', 'error');
                }
            }
        });
    });
}));

function updateProfile(){
    var compAdd = $('#complete_address').val();
    var pCode   = $('#postal_code').val();
    if(!compAdd){
        $('#pass-err-msg2').html(''+
            '<div class="alert alert-danger alert-dismissible m-t-20 f-15" role="alert">'+
                '<strong><i class="fa fa-check"></i> Failed!</strong> Please enter your address.'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'
        );
        $('#complete_address').focus();
    }
    if(!pCode){
        $('#pass-err-msg2').html(''+
            '<div class="alert alert-danger alert-dismissible m-t-20 f-15" role="alert">'+
                '<strong><i class="fa fa-check"></i> Failed!</strong> Please enter your zip code.'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                    '<span aria-hidden="true">&times;</span>'+
                '</button>'+
            '</div>'
        );
        $('#postal_code').focus();
    }

    if(compAdd&&pCode){
        swal({
            title: "Save Changes?",
            text: "All data will be saved directly.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, save!",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonColor: "#fa9737",
        },
        ()=>{
            $.ajax({
                url: base_url+'account/account_update',
                method: 'POST',
                data: $('#accForm').serialize(),
                success: (res)=>{
                    if(res==1){
                        swal('Saved!', 'Profile information was successfully saved.', 'success');
                        $('#pass-err-msg2').html('');
                    } else{
                        swal('Failed!', 'A problem occured please try again.', 'error');
                        $('#pass-err-msg2').html('');
                    }
                }
            });
        });
    }
}

var checkEmail = ()=>{
    var newEmail = $('#newEmail').val();
    var oldEmail = $('#oldEmail').val();
    $('#chk-email-msg').html('<span class="pname-warm"><i class="fa fa-spinner"></i> Checking email..</span>');
    if(newEmail){
        if(newEmail!=oldEmail){
            $.ajax({
                url: base_url+'account/check_email',
                type: 'POST',
                data: { newEmail:newEmail },
                success: (res)=>{
                    if(res==0){
                        $('#chk-email-msg').html('<span class="pname-suc"><i class="fa fa-check"></i> Email is available!</span>');
                        $('#accSaveBtn').removeAttr('disabled');
                    } else{
                        $('#chk-email-msg').html('<span class="pname-err"><i class="fa fa-times"></i> Email name already exist.</span>');
                        $('#newEmail').focus();
                        $('#accSaveBtn').attr('disabled', '');
                    }
                }
            });
        } else{
            $('#chk-email-msg').html('');
            $('#accSaveBtn').removeAttr('disabled');
        }
    } else{
        $('#chk-email-msg').html('<span class="pname-err"><i class="fa fa-times"></i> Please enter your email.</span>');
        $('#newEmail').focus();
        $('#accSaveBtn').attr('disabled', '');
    }

}

var errClear = ()=>{
    $('#pass-err-msg').html('');
    $('#pass-err-msg2').html('');
}