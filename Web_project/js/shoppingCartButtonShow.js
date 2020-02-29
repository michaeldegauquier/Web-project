$(document).ready(function () {
    console.log("JQuery linked");

    $('.hideButton').hide();

    $('.card').on('mouseenter', function() {
        $(this).find('.hideButton').show();
    }).on('mouseleave', function() {
        $('.hideButton').hide();
    });

    $('.shopping-cart-btn').on('click', function(e) {
        e.preventDefault();

        var productId = $(this).attr('id');

        $.ajax({
            type: 'POST',
            url: 'database/shoppingCartDB.php',
            data: {productId: productId},
            success: function(response) {
                console.log(response);
                alert('Product Added!');
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