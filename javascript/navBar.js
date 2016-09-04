$(document).ready(function () {
    $("#logoutBtn").click(function () {
        logoutUser();
    });

    $(".mapAction").click(function () {
        alert("ok");
    });

    $("#settingsBtn").click(function () {
        $.ajax({
            url: "UserSettings",
            method: "POST",
            dataType: "json"
        }).done(function (result) {
        }).always(function (result) {
            $('#mainContent').html(result.responseText);
        });
    });

    $("#editAnimalsBtn").click(function () {
        $.ajax({
            url: "AnimalOverview",
            method: "POST",
            dataType: "json",
            data: {'isAjax' : true}
        }).done(function (result) {
        }).always(function (result) {
            $('#mainContent').html(result.responseText);
        });
    });

    $("#announcementsBtn").click(function () {
        ajaxCall('php/routingHandler.php', {'actionCode': "14"}).done(function (result) {
            $('#content').html(result);
        });
    });
});

function logoutUser () {
    $.ajax({
        url: "LogoutUser",
        method: "POST",
        dataType: "json"
    }).done(function (result) {
    }).always(function (result) {
        $('#mainContent').html(result.responseText);
    });
}