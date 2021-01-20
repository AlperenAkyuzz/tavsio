// Auth Proccess
// ------------------------------
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Access-Control-Allow-Origin': '*'
        }
    });
    $("#form-login").submit(function(){
        $('#login-button').empty().append('Oturum Açılıyor...');
        var data = $(this).serialize();
        var url = "/login";
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function(result){
                if(result.status === 'userLoginSuccess') {
                    $('#login-response').empty().append(result.message);
                    setTimeout(function () {
                        window.location.href = '/hesabim';
                    },1000);
                }
            },
            error: function (xhr) {
                $('#login-button').empty().append('Oturum Aç');
                let result = xhr.responseJSON;
                let resultCnt = '';

                switch (result.status) {
                    case 'invalidArg':
                        $.each(result.message,function (index, item) {
                            resultCnt += '- ' + item[0] +'<br/>';
                        });
                        $('#login-response').empty().append(resultCnt);
                        break;
                    default:
                        $('#login-response').empty().append(result.message);
                        break;
                }
            }
        });
        return false;
    });
});
function logout(){
    $('.logoutText').empty().append('Çıkılıyor...');
    $.ajax({
        type: "POST",
        url: 'logout',
        dataType: "json",
        success: function(result){
            if(result.status === 'userLogoutSuccess') {
                setTimeout(function () {
                    window.location.reload();
                },1000);
            }
        },
        error: function (xhr) {
            $('.logoutText').empty().append('<i class="fas fa-sign-out-alt"></i> Çıkış');
        }
    });
}
