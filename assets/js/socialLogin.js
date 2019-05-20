var base_url = document.getElementById('base_url').value;
function statusChangeCallback(response) {
    if (response.status === 'connected') {
        checEmailExist();
    }
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    var mjAppID = '413901082706208';
    var darAppID = '';
    FB.init({
        appId      : mjAppID,
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v3.2' // The Graph API version to use for the call
    });

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
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

var checEmailExist = ()=>{
    FB.api('/me', { locale: 'en_US', fields: 'name,email' },
    function(response) {
        $.ajax({
            url:  base_url+'auth/loginFB/',
            type: 'POST',
            data: { email: response.email, fullname: response.name, socID: response.id },
            success: (res)=>{
                if(res==1){
                   window.location.href = base_url+"home/my_calendar";
                } else{
                    alert('There was a problem logging you in. Please try again.')
                }
            }
        });
    });
}

function onSignIn(googleUser) {
    // Useful data for your client-side scripts:
    var profile = googleUser.getBasicProfile();
    $.ajax({
        url:  base_url+'auth/loginGoogle/',
        type: 'POST',
        data: { email: profile.getEmail(), fullname: profile.getName(), imgURL: profile.getImageUrl() },
        success: (res)=>{
            if(res==1){
               window.location.href = base_url+"home/my_calendar";
            } else{
                alert('There was a problem logging you in. Please try again.')
            }
        }
    });
}