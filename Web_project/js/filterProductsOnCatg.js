$(document).ready(function (e) {
    console.log("JQuery linked");

    $('select#category').on('change', function(e) {
        e.preventDefault();

        // Select waarde van aangeduide option
        var product = $('select#category').val();

        if(product === 'None') {
            $('div.filter').show();
        }
        else {
            // Alle producten hiden
            $('div.filter').hide();

            // Toon enkel de producten waarvan de categorie overeen komt met variabele product
            $('div.filter:contains('+ product +')').show();
        }
    });
});

// Vins. How to use javascript variables in jquery selectors. Geraadpleegd via
// https://stackoverflow.com/questions/5891840/how-to-use-javascript-variables-in-jquery-selectors
// Geraadpleegd op 27 december 2018

// Stackoverflow. jQuery contains() with a variable syntax. Geraadpleegd via
// https://stackoverflow.com/questions/2191419/jquery-contains-with-a-variable-syntax
// Geraadpleegd op 30 december 2018