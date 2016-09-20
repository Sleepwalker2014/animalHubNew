$(document).ready(function () {
    $(".editAnimal").click(function () {
        editAnimal($(this).data('animal'));
    });

    $(".searchAnimal").click(function () {
        ajaxCall('php/routingHandler.php', {
            'actionCode': "15",
            'animalId': $(this).data('animal')
        }).done(function (result) {
            $('#content').html(result);
        });
    });

    $(".animalDonation").click(function () {
        var animalId = $(this).data('animal');
        $.ajax({
            method: "POST",
            dataType: "json",
            data: {'actionCode': 'AnimalDonation',
                   'animalId': animalId,
                   'isAjax' : true}
        }).done(function (result) {
            $('#mainContent').html(result.responseText);
        }).always(function (result) {
            $('#mainContent').html(result.responseText);
        });
    });

    $(".removeAnimal").click(function () {
        var animalId = $(this).data('animal');
        var animalBox = $(this).closest('.removable');

        $.ajax({
            method: "POST",
            dataType: "json",
            data: {'actionCode': 'RemoveAnimal',
                   'animalId': animalId,
                   'isAjax' : true}
        }).done(function () {
            removeItem(animalBox);
        }).always(function (result) {
            removeItem(animalBox);
        });
    });
});

function editAnimal(animalId) {
    $.ajax({
        method: "POST",
        dataType: "json",
        data: {'actionCode': 'EditAnimal',
               'animalId': animalId,
               'isAjax' : true}
    }).done(function (result) {
       // $('#mainContent').html(result.responseText);
    }).always(function (result) {
        $('#mainContent').html(result.responseText);
    });
}

function removeItem(item) {
    console.log(item);
    item.remove();
}