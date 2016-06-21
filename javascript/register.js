$(function () {
    $("#btn-register").click(function () {
        if ($('#registerEmail').val() && $('#registerPassword').val() && $('#registerName')) {
            $(this).prop('disabled', true);
            $('#loginSpinner').removeClass('hide');

            $.ajax({
                url: "Register",
                method: "POST",
                data: {
                    'registerName': $('#registerName').val(),
                    'registerEmail': $('#registerEmail').val(),
                    'registerPassword': $('#registerPassword').val()
                },
                dataType: "json"
            }).done(function (result) {
                if (result.success == false) {
                    $('#registerAlert').html(result.templateData)
                        .removeClass('hide');
                }
            }).always(function () {
                $('#loginSpinner').hide();
                $("#btn-register").removeProp("disabled");
            });
        } else {
            $('#registerAlert').html('Bitte geben Sie Ihren Benutzernamen und ihr Passwort ein.')
                .removeClass('hide');
        }
    });
});