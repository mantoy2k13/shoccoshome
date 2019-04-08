var base_url = $('#base_url').val();
$(document).ready(function(){
    $(document).tooltip('disabled')
});
document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        $('#mLoader').html('');
    }
};

$(function () {
    $(".decimalOnly").keydown(function (event) {
        if (event.shiftKey == true) {
           event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }
        
        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
           event.preventDefault();

    });
});


window.fbAsyncInit = function() {
    FB.init({
        appId      : '413901082706208',
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v3.2' // The Graph API version to use for the call
    });
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function setBreeds(){
    var get_id = $('.selCategory').val();
    cat_id = (get_id) ? get_id : 0;
    $.ajax({ url: base_url + "pet/get_breeds/"+cat_id, 
        success: (data)=> {
            $('.selBreed').html(data);
        }
    });
}

function setBreeds2(){
    var get_id = $('.selCategory2').val();
    cat_id = (get_id) ? get_id : 0;
    $.ajax({ url: base_url + "pet/get_breeds/"+cat_id, 
        success: (data)=> {
            $('.selBreed2').html(data);
        }
    });
}

function getHostGuest(val)
{
    if(val.value == "guest"){
        $('.guest-list').fadeIn('slow');
        $('.host-list').hide();
        $('#petCat').removeAttr('required');
        $('#petList').attr('required', 'required');
    }

    if(val.value == "host"){
        $('.host-list').fadeIn('slow');
        $('.guest-list').hide();
        $('#petCat').attr('required');
        $('#petList').removeAttr('required', 'required');
    }
}

function logout(social){
    swal({
        title: "Logout?",
        text: "Are you sure you want to leave",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, logout!",
        closeOnConfirm: false,
        confirmButtonColor: "#e11641",
        showLoaderOnConfirm: true
    },
    ()=>{
        if(social=="fb"){
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    FB.logout(function(response) {
                        window.location.href = base_url+"auth/user_logout";
                    });
                } else{
                    window.location.href = base_url+"auth/user_logout";
                }
            });    
        } else if(social=="google"){
            //signOut()
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                window.location.href = base_url+"auth/user_logout";
                console.log('Sign Out')
            });
            auth2.disconnect();
            setTimeout(window.location.href = base_url+"auth/user_logout",1000);
        } else{
            window.location.href = base_url+"auth/user_logout";
        }
    });
}

// zoomable images
$('img.zoomable').css({cursor: 'pointer'}).on('click', function() {
    var img = $(this);
    var bigImg = $('<img />').css({
      'max-width': '100%',
      'height': 'auto',
      'display': 'inline'
    });
    bigImg.attr({
      src: img.attr('src'),
      alt: img.attr('alt'),
      title: img.attr('title')
    });
    var over = $('<div />').text(' ').css({
      'height': '100%',
      'width': '100%',
      'background': 'rgba(0,0,0,.82)',
      'position': 'fixed',
      'top': 0,
      'left': 0,
      'opacity': 0.0,
      'cursor': 'pointer',
      'z-index': 999999,
      'text-align': 'center',
    }).append(bigImg).bind('click', function() {
      $(this).fadeOut(300, function() {
        $(this).remove();
      });
    }).insertAfter(this).animate({
      'opacity': 1
    }, 300);
});

// Page Load execute functions
getMailNotif();
getGuestReq();
getHostApprove();

// Every 30 seconds notifications
setInterval(() => {
    getMailNotif()
    getGuestReq();
    getHostApprove();
}, 30000);

function getMailNotif(){
    $.ajax({ url: base_url + "mail/cntUnrMsg", 
        success: (cnt) => {
            if(cnt!=0){
                $('.mainCntM').html('<span class="badge bg-red">'+cnt+'</span>');
                $('.mainCnt').html('<span class="badge bg-red cust-badge">'+cnt+'</span>');
                $('.inbCnt').html('<span class="badge badge-danger cntFrndReq pull-right m-t-5">'+cnt+'</span>');
                $('.lMsgCnt').html('<span class="badge badge-danger cntFrndReq pull-right m-t-5">'+cnt+'</span>');
            } else{
                $('.mainCntM').html('');
                $('.mainCnt').html('');
                $('.inbCnt').html('');
                $('.lMsgCnt').html('');
            }
        }
    });

    $.ajax({ url: base_url + "mail/cntMsgNotfif", dataType: 'json',
        success: function(res){
            if(res){
                $.each( res, function(index, key) {
                    window.createNotification({
                        closeOnClick: false,
                        displayCloseButton: true,
                        positionClass: "nfc-bottom-right",
                        showDuration: 10000,
                        theme: "info"
                    })({
                        title: key['subject'],
                        message: "New message from "+key['fullname']+'('+key['email']+')'
                    }); 
                    var notif = document.getElementById("notif"); 
                    notif.play(); 
                    $(document).on('click', '.ncf-container p', ()=> {  window.location.href = base_url+"mail/mail" });
                    $.ajax({ url: base_url + "mail/cNotif/"+key['mail_id'],success: function(result){}});
                });
            }
        }
    });
}

function getGuestReq(){
    $.ajax({ url: base_url + "booking/get_guest_req", dataType: 'json',
        success: function(res){
            if(res){
                $.each( res, function(index, key) {
                    window.createNotification({
                        closeOnClick: false,
                        displayCloseButton: true,
                        positionClass: "nfc-bottom-right",
                        showDuration: 10000,
                        theme: "info"
                    })({
                        title: 'New Guest Booking',
                        message: "You have new booking request from "+key['fullname']+'('+key['email']+')'
                    }); 
                    var notif = document.getElementById("notif"); 
                    notif.play(); 
                    $(document).on('click', '.ncf-container p', ()=> {  window.location.href = base_url+"booking/booking_list/2" });
                    $.ajax({ url: base_url + "booking/update_guest_req/"+key['book_id'],success: function(result){}});
                });
            }
        }
    });
}

function getHostApprove(){
    $.ajax({ url: base_url + "booking/get_host_approve", dataType: 'json',
        success: function(res){
            if(res){
                $.each( res, function(index, key) {
                    window.createNotification({
                        closeOnClick: false,
                        displayCloseButton: true,
                        positionClass: "nfc-bottom-right",
                        showDuration: 10000,
                        theme: "info"
                    })({
                        title: 'Booking Approve',
                        message: "Your booking was successfully approve by "+key['fullname']+'('+key['email']+')'
                    }); 
                    var notif = document.getElementById("notif"); 
                    notif.play(); 
                    $(document).on('click', '.ncf-container p', ()=> {  window.location.href = base_url+"booking/booking_list/1" });
                    $.ajax({ url: base_url + "booking/update_host_approve/"+key['book_id'],success: function(result){}});
                });
            }
        }
    });
}

function instMsg(uid, email){
    $('#instMailTo').val(uid);
    $('#instEmail').val(email);
    $('#instMsg').modal('show')
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

 
function getNearPeople(){
    $('#mLoader').html('<div class="loading"> Loading..</div>');
    navigator.geolocation.getCurrentPosition(
        function(position){ // success cb
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            $.ajax({
                url: base_url+'booking/setMyLocation',
                type: "POST",
                data: {lat: lat, lng: lng},
                success: (res)=>{
                    if(res){
                        window.location.href = base_url+res;
                    } else{
                        alert('Failed to get location')
                    }
                }
            }); 
        },
        function(){ 
            alert('Failed to get location');
        }
    );
}

// Cover Photo Repositioning
$(document).ready(function () {
    var img = $('.coverContainer img.cover-photo-custom');
    var y1 = $('.coverContainer').height();
    var y2 = img.height();
    var x1 = $('.coverContainer').width();
    var x2 = img.width();
    var desktop_start_x=0;
    var desktop_start_y=0;
    var mobile_start_x= -200;
    var mobile_start_y= -200;
    $('.savePos').click(function(event){
            event.preventDefault();
            var t = img.position().top, l = img.position().left;
            img.attr('data-top', t);
            img.attr('data-left', l);
            img.draggable({ disabled: true });
            $('.repos').removeClass('d-none');
            $('.savePos').addClass('d-none');
            $('.covertxt').addClass('d-none');
            $('.banner-btn').removeClass('d-none');

            $.ajax({
                url:base_url+'account/setCoverPos/'+t,
                success:function(res){
                    if(res){
                        swal("Save!", "Cover photo position was set.", 'success');
                    }
                    else{
                        swal("Failed!", "There was a problem deleting your image", 'warning');
                    }
                }
            }); 
    })
    $('.repos').click(function(event){
        event.preventDefault();
        $('.savePos').removeClass('d-none');
        $('.repos').addClass('d-none');
        $('.covertxt').removeClass('d-none');
        $('.banner-btn').addClass('d-none');
          img.draggable({ 
              disabled: false,
              scroll: false,
              axis: 'y, x',
              cursor : 'move',
               drag: function(event, ui) {
                if(ui.position.top >= 0)
                {
                    ui.position.top = 0;
                }
                if(ui.position.top <= y1 - y2)
                {
                    ui.position.top = y1 - y2;
                }
                if (ui.position.left >= 0) {
                ui.position.left = 0;
                };
                if(ui.position.left <= x1 - x2)
                {
                    ui.position.left = x1 - x2;
                }
             }
        });
    });
});