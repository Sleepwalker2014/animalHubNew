$(function () {
    $("#btn-login").click(function () {
        if ($('#login-username').val() && $('#login-password').val()) {
            $(this).prop('disabled', true);
            $('#loginSpinner').removeClass('hide');
            setTimeout(
                function () {
                    //do something special
                }, 5000);

            $.ajax({
                url: "LoginUser",
                method: "POST",
                data: {
                    'loginName': $('#login-username').val(),
                    'loginPassword': $('#login-password').val()
                },
                dataType: "json"
            }).done(function (result) {
                if (result.message) {
                    setErrorMessage(result.message);
                } else {
                    $('#mainContent').html(result.templateData);
                }
            }).always(function () {
                $('#loginSpinner').hide();
                $("#btn-login").removeProp("disabled");
            });
        } else {
            setErrorMessage('Btte geben Sie ihren Benutzernamen und ihr Passwort ein.');
        }
    });
});

function setErrorMessage(message) {
    $('#login-alert').html(message)
        .removeClass('hide');
}
