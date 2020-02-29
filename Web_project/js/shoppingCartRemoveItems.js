$(document).ready(function () {
    console.log("JQuery linked");

    $('.removeItem').on('click', function(e) {

        var productIdRemove = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'shoppingCartDB.php',
            data: {productIdRemove: productIdRemove},
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('There is an error!');
            }
        });
    });
});

// Stackoverflow. How do I catch an Ajax query post error? Geraadpleegd via
// https://stackoverflow.com/questions/2833951/how-do-i-catch-an-ajax-query-post-error
// Geraadpleegd op 31 december 2018