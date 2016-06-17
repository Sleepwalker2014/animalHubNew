$(document).ready(function() {
    $("#logoutBtn").click(function() {
        logoutUser();
    });

    $("#settingsBtn").click(function() {
        ajaxCall('php/routingHandler.php', {'actionCode': "8"}).done(function(result) {
            $('#content').html(result);
        });
    });

    $("#shoppingCart").click(function() {
        ajaxCall('php/routingHandler.php', {'actionCode': "9"}).done(function(result) {
            $('#content').html(result);
        });
    });

    $("#announcementsBtn").click(function() {
        ajaxCall('php/routingHandler.php', {'actionCode': "14"}).done(function(result) {
            $('#content').html(result);
        });
    });
});

function logoutUser () {
    ajaxCall('php/routingHandler.php', {'actionCode': "7"});
}