$(document).on('click', '.btn-number-v', function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $(this).parent().parent().find("input[name='"+fieldName+"']");
    var htmldisp = $(this).closest('.pax_drop').find("."+fieldName+"F");
    var currentVal = parseInt(input.val());
    // console.log(input);
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
                htmldisp.html(currentVal - 1);
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
                htmldisp.html(currentVal + 1);
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
    } else {
        input.val(0);
    }
});


$('.input-number-v').focusin(function(){
    $(this).data('oldValue', $(this).val());
});

$('body').on('change', '.input-number-v', function(e){
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    fieldName = $(this).attr('data-field');
    var htmldisp = $(this).closest('.pax_drop').find("."+fieldName+"F");
    htmldisp.html(valueCurrent);

    name = $(this).attr('name');
    // console.log(valueCurrent);
    // console.log(minValue);
    // console.log(maxValue);
    if(valueCurrent >= minValue) {
        // $(".btn-number-v[data-type='minus'][data-field='"+name+"']").removeAttr('disabled');
        $(this).parent().find("[data-type='minus']").removeAttr('disabled');
    } else {
        alert('Sorry, the minimum value was reached');
        htmldisp.html($(this).data('oldValue'));
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        // $(".btn-number-v[data-type='plus'][data-field='"+name+"']").removeAttr('disabled');
        $(this).parent().find("[data-type='plus']").removeAttr('disabled');
    } else {
        alert('Sorry, the maximum value was reached');
        htmldisp.html($(this).data('oldValue'));
        $(this).val($(this).data('oldValue'));
    } 
});
$(".input-number-v").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

/*$( ".travellers-input" ).click(function() {
    $(this).closest('.pax_drop').find( ".travellers-input-popup" ).fadeIn( "slow", function() {
        // Animation complete.
    });
});
$("i.fa.fa-times").click(function(e) {
    $(this).closest('.pax_drop').find( ".travellers-input-popup" ).fadeOut( "slow", function() {
        e.preventDefault();
        // showAvailabilty();
    });
});*/

$(".input-number-v").prop("readonly", true);