var base_url = $('#base_url').val();

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

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
    if(val.value == "Be a Guest"){
        $('.guest-list').fadeIn('slow');
        $('.host-list').hide();
    }

    if(val.value == "Be a Host"){
        $('.host-list').fadeIn('slow');
        $('.guest-list').hide();
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
                //window.location.href = base_url+"auth/user_logout";
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
      'max-height': '100%',
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
      'z-index': 9999,
      'text-align': 'center'
    }).append(bigImg).bind('click', function() {
      $(this).fadeOut(300, function() {
        $(this).remove();
      });
    }).insertAfter(this).animate({
      'opacity': 1
    }, 300);
});

getMailNotif();
setInterval(() => {
    getMailNotif()
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
                    $.ajax({ url: base_url + "mail/cNotif/"+key['mail_id'],success: function(result){}});
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

$(document).on('click', '.ncf-container p', ()=> {  window.location.href = base_url+"mail/mail" });

