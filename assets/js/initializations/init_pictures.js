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

var selectAll = (type) => {
    if(type==1){
        $('.selAll').html('Deselect All').attr('onclick', 'selectAll(2)');
        $('.ai_box').prop('checked', true);
    } else{
        $('.selAll').html('Select All').attr('onclick', 'selectAll(1)');
        $('.ai_box').prop('checked', false);
    }
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

                        $("#emptyImg").hide();
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

var remFromAlbum = (id) => {
    swal({
        title: "Remove?",
        text: "This image will be removed from this album.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Remove it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    ()=>{
        $.ajax({
            url: base_url+'pictures/remove_from_album/'+id,
            success: (res)=>{
                if(res==1){
                    $('#albumImg'+id).remove();
                    var img_uploaded = $('.myAlbumImg').length;
                    if(img_uploaded == 0){
                        $("#emptyImg").html(''+
                            '<div class="alert alert-success f-15 m-t-10" role="alert">'+
                                '<strong><i class="fa fa-check"></i> Empty!</strong> You have no photos on this album.'+
                            '</div>'
                        );
                    }
                    swal('Removed', "Image was removed from this album.", 'success');
                } else{
                    swal('Failed', "There was a problem removing your image.", 'error');
                }
            }
        });
    });
}

var delImg = (id, imgName, type) => {
    swal({
        title: (type==1) ? "Delete?" : "Delete All?",
        text: "Images will be deleted permamently.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    ()=>{
        $.ajax({
            url: base_url+'pictures/delete_image/'+id+'/'+imgName+'/'+type,
            success: (res)=>{
                console.log(res)
                if(res==1){
                    if(type==1){
                        $('#albumImg'+id).remove();
                    } else{
                        $('.albumImg').remove();
                        $('#option-menu').remove();
                        $('.option-menu').remove();
                    }
                    
                    var img_uploaded = $('.myAlbumImg').length;
                    if(img_uploaded == 0){
                        $("#emptyImg").html(''+
                            '<div class="alert alert-success f-15 m-t-10" role="alert">'+
                                '<strong><i class="fa fa-check"></i> Empty!</strong> You have no photos on this album.'+
                            '</div>'
                        );
                        
                        $('#option-menu').remove();
                        $('.option-menu').remove();
                    }
                    if(type==1){
                        swal('Deleted!', "Image was successfully deleted.", 'success');
                    } else{
                        swal('Deleted!', "All images was successfully deleted.", 'success');
                    }
                    
                } else{
                    swal('Failed', "There was a problem removing your image.", 'error');
                }
            }
        });
    });
}

var delSelected = (type)=>{
    var cntImg = $('.ai_box:checked').length;
    if(cntImg>0){
        swal({
            title: (type==1) ? 'Delete' : 'Remove' +" Selected?",
            text: (type==1) ? 'All image will be deleted permamently' : 'All image will be remove from this album',
            type: "warning",
            showCancelButton: true,

            confirmButtonText: (type==1) ? 'Delete it!' : 'Remove it!',
            closeOnConfirm: false,
            confirmButtonColor: "#e11641",
            showLoaderOnConfirm: true
        },
        ()=>{
            var form = $('#formImgData');
            $.ajax({
                type: 'POST',
                cache: false,
                url: base_url+'pictures/delSelectedImages/'+type,
                data: $(form).serialize(),
                success: function(res) {
                    if(res==1){
                        $.each($(".ai_box:checked"), function(){            
                            $('#albumImg'+$(this).val()).remove();        
                        });
                        var img_uploaded = $('.myAlbumImg').length;
                        if(img_uploaded == 0){
                            $("#emptyImg").html(''+
                                '<div class="alert alert-success f-15 m-t-10" role="alert">'+
                                    '<strong><i class="fa fa-check"></i> Empty!</strong> You have no photos on this album.'+
                                '</div>'
                            );
                            
                            $('#option-menu').remove();
                            $('.option-menu').remove();
                        }
                        if(type==1){
                            swal('Deleted!', "Selected image was successfully deleted.", 'success');
                        } else{
                            swal('Removed!', "Selected image was successfully removed.", 'success');
                        }
                        
                    } else{
                        swal('Failed', "There was a problem removing your image.", 'error');
                    }
                }
            });
        });
    } else{
        swal('Oops', "Please check atleast 1 image to continue.", 'warning');
    }
}

var rmimg = (e) => {
    $(e).parent().remove();
    var img_uploaded = $('.img_uploaded').length;
    if(img_uploaded == 0){
        $("#emptyImg").html(''+
            '<div class="alert alert-danger f-15 m-t-10" role="alert">'+
                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 3 mb of size).'+
            '</div>'
        );
        $("#emptyImg").show();
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


var delpicture = (id, imgName) => {
    swal({
        title: "Delete?",
        text: "This image will be deleted permamently.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    ()=>{
        $.ajax({
            url: base_url+'pictures/delete_image/'+id+'/'+imgName,
            success: (res)=>{
                if(res==1){
                    $('#albumImg'+id).remove();
                    var img_uploaded = $('.myAlbumImg').length;
                    if(img_uploaded == 0){
                        $("#emptyImg").html(''+
                            '<div class="alert alert-success f-15 m-t-10" role="alert">'+
                                '<strong><i class="fa fa-check"></i> Empty!</strong> You have no photos on this album.'+
                            '</div>'
                        );
                        $('.img-btn-set').remove();
                    }
                    swal('Removed', "Image was removed from this album.", 'success');
                } else{
                    swal('Failed', "There was a problem removing your image.", 'error');
                }
            }
        });
    });
}

var setPriPhoto = (img_name)=>{
    swal({
        title: "Set Primary?",
        text: "This picture will be set as primary image.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, set it!",
        closeOnConfirm: false,
        confirmButtonColor: "#2162e7",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url+'account/setPhotoPrimary/'+img_name,
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

var setCoverPhoto = (img_name)=>{
   swal({
    title: "Set CoverPhoto?",
    text: "This picture will be set as CoverPhoto.",
    type: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, set it!",
    closeOnConfirm: false,
    confirmButtonColor: "#2162e7"
   },
    function(){
        $.ajax({
            url:base_url+'account/setCoverPrimary/'+img_name,
            success:function(res){
                if(res){
                    swal({
                        title: 'Success!',
                        text: "Image was successfully set as CoverPhoto.",
                        type: 'success',
                        showConfirmButton:false,
                        confirmButtonText: ''
                    });
                    setInterval(function(){ location.reload(); }, 1500);
                }
                else{
                    swal("Failed!", "There was a problem deleting your image", 'warning');
                }
            }
        }); 
    });
}