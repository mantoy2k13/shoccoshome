$(document).ready(function(){
    var alertMsg = $('#getPetAlert').val();
    if(alertMsg!=0){
        switch(alertMsg){
            case 'Added':
                var title = "Pet Added!";
                var msg   = "New pet was successfully added!";
                var type  = 'success';
            break;
            case 'Updated':
                var title = "Pet Updated!";
                var msg   = "Your pet was successfully updated!";
                var type  = 'success';
            break;
            case 'Deleted':
                var title = "Pet Deleted!";
                var msg   = "Your pet was successfully deleted!";
                var type  = 'success';
            break;
            case 'Error':
                var title = "Error!";
                var msg   = "A problem occured. Please try again!";
                var type  = 'warning';
            break;
        }

        setPetAlert(title, msg, type);
    }
});

function setPetAlert(title, msg, type){
    swal(title, msg, type);
}

if (window.File && window.FileList && window.FileReader) {
    $("#uploadFiles").on("change", function(e) {
        var files = e.target.files,
        filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i];
            var fileReader = new FileReader();
            if(f.size < 1000000){
                fileReader.onload = (function(e) {
                    var img_uploaded = $('.img_uploaded').length;
                    if(img_uploaded > 3){
                        swal('Oops!', "Maximum image uploaded are only 4", 'warning');
                    } else {
                        var imgID = Math.floor(e.timeStamp);

                        $(".emptyImgMsg").hide();
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
                swal('Failed', "Image should less than 1 MB or 1000kb", 'warning');
            }
        }
    });
} else {
    swal('Failed', "Your browser doesn't support to File API", 'warning');
}

function rmimg(e){
    $(e).parent().remove();
    var img_uploaded = $('.img_uploaded').length;
    if(img_uploaded == 0){
        $(".emptyImgMsg").html(''+
            '<div class="alert alert-danger f-15 m-t-10" role="alert">'+
                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 1 mb of size).'+
            '</div>'
        );
        $(".emptyImgMsg").show();
    }
}

function crpImg(e,imgID){
    var imgUrl = $('.u-img'+imgID).attr('src');
    $('#imgID').val(imgID);
    $("#imgToCrop").attr('src',imgUrl);
    $('.canvas-img').hide();
    $('.canvas-preview').show();
    $("#result-img").attr('src',base_url+'assets/img/image-icon.png');
    $("#showCropWindow").modal('show');
}

function delImgPet(pet_id, pet_img, imgID, isPrimary){
    swal({
        title: "Delete Image?",
        text: "Are you sure you want to delete this image? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        var imgname = pet_img.split('/',-1);
        var imglink = imgname[imgname.length-1];
        $.ajax({
            url: base_url+'pet/pet_image_remove/'+isPrimary,
            type: 'post',
            data: {path: imglink, petid : pet_id},
            success: function(response){
                if(response){
                    $('.oldImg'+imgID).remove();
                    var img_uploaded = $('.img_uploaded').length;
                    if(img_uploaded == 0){
                        $(".emptyImgMsg").html(''+
                            '<div class="alert alert-danger f-15 m-t-10" role="alert">'+
                                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 1 mb of size).'+
                            '</div>'
                        );
                        $(".emptyImgMsg").show();
                    }
                    
                    swal("Deleted!", "Image was successfully deleted.", 'success');
                } else{
                    swal("Failed!", "There was a problem deleting your image", 'warning');
                }
            }
        });
    });
}

$(document).on('change', '#cat_id', function(){
    var categories_data = $(this).val();
    $.ajax({
        url: base_url+'pet/categories_wise_breed_data',
        type: "POST",
        data: {categories:categories_data},
        success: function(data){
            $("#breed_id").html(data);
        }
    });
});

function delPet(pet_id){
    swal({
        title: "Delete Pet?",
        text: "Are you sure you want to delete this Pet? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641"
    },
    function(){
        window.location.href = base_url+"pet/delete_pet/"+pet_id;
    });
}

function setPrimary(pet_id, img_name){
    swal({
        title: "Set Primary?",
        text: "This picture will be set as primary image.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, set it!",
        closeOnConfirm: false,
        confirmButtonColor: "#2162e7"
    },
    function(){
        $.ajax({
            url: base_url+'pet/setPrimaryImg/'+'/'+pet_id+'/'+img_name,
            success: function(response){
                if(response){
                    swal({
                        title: 'Success!',
                        text: "Image was successfully set as primary.",
                        type: 'success',
                        showConfirmButton:false,
                        confirmButtonText: ''
                    });
                    setInterval(function(){ location.reload(); }, 1500);
                } else{
                    swal("Failed!", "There was a problem deleting your image", 'warning');
                }
            }
        });
    });
}