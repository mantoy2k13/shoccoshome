
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

var rmimg = (e) => {
    $(e).parent().remove();
    var img_uploaded = $('.img_uploaded').length;
    if(img_uploaded == 0){
        $(".emptyImgMsg").html(''+
            '<div class="alert alert-danger f-15 m-t-10" role="alert">'+
                '<strong><i class="fa fa-check"></i> Empty!</strong> Please upload atleast 1 pet image (maximum of 4 images and less than 1 mb of size).'+
            '</div>'
        );
        $('#uploadFiles').attr('required', '');
        $(".emptyImgMsg").show();
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

var delImgPet = (pet_id, imgName, e) => {
    swal({
        title: "Delete Image?",
        text: "Are you sure you want to delete this image? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url+'pet/pet_image_remove/'+pet_id,
            type: 'post',
            data: {imgName: imgName},
            success: function(res){
                if(res==1){
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
                    
                    swal("Deleted!", "Image was successfully deleted.", 'success');
                } else{
                    swal("Failed!", "There was a problem deleting your image", 'warning');
                }
            }
        });
    });
}

$(document).on('change', '#cat_id', function(){
    var cat_id = $(this).val();
    $.ajax({
        url: base_url+'pet/get_pet_breeds/'+cat_id,
        success: function(data){
            $("#breed_id").html(data);
        }
    });
});

var delPet = (pet_id)=>{
    swal({
        title: "Delete Pet?",
        text: "Are you sure you want to delete this Pet? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    ()=>{
        $.ajax({
            url: base_url+'pet/delete_pet/'+pet_id,
            success: (res)=>{
                if(res==1){
                    $('#myPets'+pet_id).remove();
                    var cntPets = $('.myPets').length;
                    if(cntPets==0){
                        $('#emptyPets').html(''+
                            '<div class="alert alert-info f-15">'+
                                '<b><i class="fa fa-check"></i> Empty!</b> You have no pets added. Click <a href="'+base_url+'pet/add_new_pet">here</a> to add your pet.'+
                            '</div>'
                        );
                    }
                    swal("Deleted!", "Your pet was successfully deleted", 'success');
                } else{
                    swal("Failed!", "There was a problem deleting your image", 'warning');
                }
            }
        });
    });
}

var setPrimary = (pet_id, img_name)=>{
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
            url: base_url+'pet/setPrimaryImg/'+pet_id+'/'+img_name,
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

var checkPetName = ()=>{
    var petName = $('#petName').val();
    var oldName = $('#oldName').val();
    $('#chk-pname-msg').html('<span class="pname-warm"><i class="fa fa-spinner"></i> Checking pet name..</span>');
    if(petName){
        if(petName!=oldName){
            $.ajax({
                url: base_url+'pet/checkPetName',
                type: 'POST',
                data: { petName:petName },
                success: (res)=>{
                    if(res==0){
                        $('#chk-pname-msg').html('<span class="pname-suc"><i class="fa fa-check"></i> Pet name is available!</span>');
                        $('#addPetBtn').removeAttr('disabled');
                    } else{
                        $('#chk-pname-msg').html('<span class="pname-err"><i class="fa fa-times"></i> Pet name already exist.</span>');
                        $('#petName').focus();
                        $('#addPetBtn').attr('disabled', '');
                    }
                }
            });
        } else{
            $('#chk-pname-msg').html('');
            $('#addPetBtn').removeAttr('disabled');
        }
    } else{
        $('#chk-pname-msg').html('<span class="pname-err"><i class="fa fa-times"></i> Please enter pet name.</span>');
        $('#petName').focus();
        $('#addPetBtn').attr('disabled', '');
    }

}

var addRemVacInfo = (type, e) => {
    if(type == 1){
        $('<div class="col-md-12 vacc-parent">'+
            '<div class="row">'+
                '<div class="col-md-6">'+
                    '<label class="f-15 text-black">Vaccination Type</label>'+
                    '<select name="vaccination[]" class="form-control" required>'+
                        '<option value="">Select Type</option>'+
                        '<option value="Parvovirus (CPV)">Parvovirus (CPV)</option>'+
                        '<option value="Canine distemper virus (CDV)">Canine distemper virus (CDV)</option>'+
                        '<option value="Canine adenovirus (CAV)">Canine adenovirus (CAV)</option>'+
                        '<option value="Rabies">Rabies</option>'+
                        '<option value="Canine parainfluenza virus (CPiV)">Canine parainfluenza virus (CPiV)</option>'+
                        '<option value="Distemper-measles combination vaccine">Distemper-measles combination vaccine</option>'+
                        '<option value="Bordetella bronchiseptica (Kennel Cough)">Bordetella bronchiseptica (Kennel Cough)</option>'+
                        '<option value="Leptospira spp">Leptospira spp</option>'+
                        '<option value="Borrelia burgdorferi (Lyme)">Borrelia burgdorferi (Lyme)</option>'+
                        '<option value="Giardia">Giardia</option>'+
                    '</select>'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<label class="f-15 text-black">Vaccination Date</label>'+
                    '<input name="vaccination_date[]" type="date" class="form-control" placeholder="Vaccination" required>'+
                '</div>'+
            '</div>'+
            '<span onclick="addRemVacInfo(2,this)" class="vacc-btn-rem" data-toggle="tooltip" title="Remove Info"><i class="fa fa-times"></i></span>'+
        '</div>'
        ).insertAfter('.vaccTitle');
    } else{
        $(e).parent().remove();
    }
}

var remVaccInfo = (num,pet_id,vacc,vacc_date,e) => {
    swal({
        title: "Remove?",
        text: "Are you sure you want to delete this vaccination? This will not be recovered.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    function(){
        $.ajax({
            url: base_url+'pet/rem_vacc_info/'+pet_id+'/'+num,
            type: 'POST',
            cache: false,
            data: { vacc: vacc, vacc_date: vacc_date },
            success: (res)=>{
                if(res==1){
                    $(e).parent().remove();
                    swal('Done!', "1 vaccination removed successfully.", 'success');
                } else{
                    swal('Failed!', "A problem occured. Please refresh page.", 'error');
                }
            }
        });
    });
}

var addToPictures = (uid)=>{
    var cntImg = $('.selFromPics:checked').length;
    if(cntImg>0){
        $.each($(".selFromPics:checked"), function(){   
            var imgName = $(this).val();
            var unqImg = imgName.replace(/\.[^/.]+$/, "");
            $('.'+unqImg).remove();  
            var img_uploaded = $('.img_uploaded').length;
            if(img_uploaded > 3){
                swal('Oops!', "Maximum image uploaded are only 4", 'warning');
            } else {   
                $(".emptyImgMsg").hide();
                $(".uploaded-files").append('<div class="col-md-3 img_uploaded '+unqImg+'">'+
                    '<div class="u-pet-img">'+
                        '<img class="w-100" src="'+base_url+'assets/img/pictures/usr'+uid+'/'+imgName+'" alt="Pet Image">'+
                    '</div>'+
                    '<span class="cust-mod-close rmImg" title="Remove Image" onclick="rmimg(this)"><i class="fa fa-times text-white"></i></span>'+
                    '<input name="imgFromPics[]" value="'+imgName+'" hidden>'+
                '</div>'); 
                $('#uploadFiles').removeAttr('required');
            }      
        });
        $('#selPics').modal('hide');        
    } else{
        swal('Oops', "Please check atleast 1 image to continue.", 'warning');
    }
}

function addNewPet(pet_id){
    var cat_id   = $('#cat_id');
    var breed_id = $('#breed_id');
    var color_id = $('#color_id');
    var img_uploaded = $('.img_uploaded').length;
    if(!cat_id.val()){
        $('.petErrorMsg').html(setErrorMsg('Please select category name.'));
        cat_id.focus();
    } else if(!breed_id.val()){
        $('.petErrorMsg').html(setErrorMsg('Please select breed name.'));
        breed_id.focus();
    } else if(!color_id.val()){
        $('.petErrorMsg').html(setErrorMsg('Please select pet color.'));
        color_id.focus();
    } else if(img_uploaded==0){
        $('.petErrorImg').html(setErrorMsg('Please upload or select atleast 1 pet image.'));
        $(".petErrorImg").attr("tabindex",-1).focus();
    } else{
        swal({
            title: "Save this pet?",
            text: "Make sure to check all fields before saving, continue?.",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, continue!",
            closeOnConfirm: false,
            confirmButtonColor: "#e11641",
            showLoaderOnConfirm: true,
        },
        function(){
            $.ajax({
                url: base_url+'pet/add_this_pet/'+pet_id,
                type: 'POST',
                cache: false,
                data: $('#addPetForm').serialize(),
                success: (res)=>{
                    if(res==1){
                        swal({
                            title: "Pet Saved!",
                            text: "Your pet was successfully saved. Click ok to view all pets.",
                            type: "success",
                        },
                        function(){ window.location.href = base_url+'pet/my_pets'; });
                    } else{
                        swal('Oops!', 'A problem occured. Please refresh your page and try again.', 'error');
                    }   
                }
            });
        });
    }
}

function setErrorMsg(msg){
    var setMsg = '';
    setMsg += '<div class="alert alert-danger f-15 alert-dismissible m-t-10" role="alert">';
    setMsg += '<strong><i class="fa fa-times"></i> Oops!</strong> '+msg+'.';
    setMsg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    setMsg += '<span aria-hidden="true">&times;</span>';
    setMsg += '</button>';
    setMsg += '</div>';
    return setMsg;
}

function clearErrMsg(){
    $('.petErrorMsg').html('');
}