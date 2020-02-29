$(document).ready(function (e) {
    console.log("JQuery linked");

    $('select#customers').on('change', function(e) {
        e.preventDefault();

        // Select waarde van aangeduide option
        var email = $('select#customers').val();
        console.log(email);

        if(email === 'None') {
            $('tr.filter').show();
        }
        else {
            // Alle customers hiden
            $('tr.filter').hide();

            // Show de customers waarvan de email overeen komt met de variabele $email
            $('tr.filter:contains('+ email +')').show();

        }
    });
});

// Vins. How to use javascript variables in jquery selectors. Geraadpleegd via
// https://stackoverflow.com/questions/5891840/how-to-use-javascript-variables-in-jquery-selectors
// Geraadpleegd op 27 december 2018

// Stackoverflow. jQuery contains() with a variable syntax. Geraadpleegd via
// https://stackoverflow.com/questions/2191419/jquery-contains-with-a-variable-syntax
// Geraadpleegd op 30 december 2018