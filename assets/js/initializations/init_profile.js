$(document).ready(function(){
    var alertMsg = $('#getProfAlert').val();
    if(alertMsg!=0){
        switch(alertMsg){
            case 'Updated':
                var title = "Profile Updated!";
                var msg   = "Your profile was successfully updated!";
                var type  = 'success';
            break;
            case 'Exist':
                var title = "Oops!";
                var msg   = "Email already exists. Please enter a valid email address.";
                var type  = 'error';
            break;
            case 'Error':
                var title = "Error!";
                var msg   = "A problem occured while updating your profile. Please try again!";
                var type  = 'error';
            break;
            case 'ErrorImg':
                var title = "Oops!";
                var msg   = "A problem occured while updating your image. Please try again!";
                var type  = 'error';
            break;
        }

        setProfAlert(title, msg, type);
    }
});

function setProfAlert(title, msg, type){
    swal(title, msg, type);
}

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
            $.ajax({
                url: base_url+'account/change_password',
                type: 'POST',
                data: { npass: npass, curPass: curPass },
                success: (res)=>{
                    if(res!=0){
                        swal("Change!", "Password change successfully.","success");
                        $('#pass-err-msg').html('');
                    } else{
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

var errClear = ()=>{
    $('#pass-err-msg').html('');
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
                // document.getElementById('img_data').value = e.target.result;
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
}));

function updateProfile(){
    console.log($('#accForm').serialize())
}