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
                var type  = 'success';
            break;
            case 'Error':
                var title = "Error!";
                var msg   = "A problem occured while updating your profile. Please try again!";
                var type  = 'warning';
            break;
            case 'ErrorImg':
                var title = "Oops!";
                var msg   = "A problem occured while updating your image. Please try again!";
                var type  = 'warning';
            break;
        }

        setProfAlert(title, msg, type);
    }
});

function setProfAlert(title, msg, type){
    swal(title, msg, type);
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