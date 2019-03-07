$(document).ready(function(){
    var alertMsg = $('#getUplAlert').val();
    if(alertMsg!=0){
        switch(alertMsg){
            case 'Added':
                var title = "Uploaded!";
                var msg   = "All images was successfully uploaded!";
                var type  = 'success';
            break;
            case 'Error':
                var title = "Error!";
                var msg   = "There was a problem uploading your images. Please try again!";
                var type  = 'error';
            break;
        }

        getUplAlert(title, msg, type);
    }
});

function getUplAlert(title, msg, type){
    swal(title, msg, type);
}

if (window.File && window.FileList && window.FileReader) {
    $("#uploadFiles").on("change", function(e) {
        var files = e.target.files,
        filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            var fileReader = new FileReader();
            if(f.size < 3000000){
                fileReader.onload = (function(e) {
                    var img_uploaded = $('.img_uploaded').length;
                    if (img_uploaded > 7){
                        swal('Oops!', "Maximum image uploaded are only 8. You can upload more after saving.", 'warning');
                    } else {
                        var imgID = Math.floor(e.timeStamp);

                        $(".emptyImgMsg").hide();
                        $("#saveImgBtn").removeAttr('disabled');
                        $(".uploaded-files").append('<div class="col-md-3 img_uploaded">'+
                            '<div class="u-pet-img">'+
                                '<img class="w-100 u-img'+imgID+'" src="'+e.target.result+'" alt="Pet Image">'+
                            '</div>'+
                            '<span class="cust-mod-close rmImg" title="Remove Image" onclick="rmimg(this)"><i class="fa fa-times text-white"></i></span>'+
                            '<span class="cust-mod-edit" onclick="crpImg(this,'+imgID+')" title="Crop Image"><i class="fa fa-pen text-white"></i></span>'+
                            '<input id="imgval'+imgID+'" name="pet_images[]" value="'+ e.target.result +'" hidden>'+
                        '</div>');
                    }
                });
                fileReader.readAsDataURL(f);
            } else{
                swal('Failed', "Image should less than 3 MB or 3000kb", 'warning');
            }
        }
    });
} else {
    swal('Failed', "Your browser doesn't support to File API", 'warning');
}

var rmimg = (e) => {
    $(e).parent().remove();
    var img_uploaded = $('.img_uploaded').length;
    if(img_uploaded == 0){
        $(".emptyImgMsg").html(''+
            '<div class="alert alert-danger f-15 m-t-10" role="alert">'+
                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 3 mb of size).'+
            '</div>'
        );
        $(".emptyImgMsg").show();
        $("#saveImgBtn").attr('disabled', true);
    }
}

var crpImg = (e,imgID) => {
    var imgUrl = $('.u-img'+imgID).attr('src');
    $('#imgID').val(imgID);
    $("#imgToCrop").attr('src',imgUrl);
    $('.canvas-img').hide();
    $('.canvas-preview').show();
    $("#result-img").attr('src',base_url+'assets/img/image-icon.png');
    $("#showCropWindow").modal('show');
}