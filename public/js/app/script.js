$(document).ready(function(){

    $('input[id=qty]').on('keypress keyup blur', function(e) {

        var totalQty    = $('#total_qty').val();
        var inputQty    = $(this).val();
        var unitPrice       = inputQty * parseFloat($('#unit_price').val());           

        var priceHtml   = $('label[id=price_html]');
        var price       = $('input[id=price]');

        var weight      = $('input[id=weight]');
        var ogWeight    = parseFloat($('input[id=original_weight]').val());
        var weightTotal = inputQty * ogWeight;

        var addCartBtn  = $("input[id=submitbutton]");

        if (parseFloat(totalQty) < parseFloat(inputQty)) {
            priceHtml.html('you exceed quantity').css({'font-size': 12, 'color': 'red'});
            price.val('');
            
            addCartBtn.prop('disabled', true);
        } else {
            priceHtml.html('$'+unitPrice.toFixed(2)).css({'font-size':14, 'color':'#222'});
            price.val(unitPrice);
            addCartBtn.prop('disabled', false);
            weight.val(weightTotal.toFixed(2));
        }

        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

});

$(document).on('click keypress',function() {
    $('div[id=error]').fadeOut(1500);

});