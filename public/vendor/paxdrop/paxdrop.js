$(document).on('click', '.btn-number', function(e){
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

$('body').on('click', '.btn-number-arr', function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    // var input = $(this).parent().parent().find("input[name='"+fieldName+"']");
    var input = $(this).parent().parent().find('.'+fieldName);
    var htmldisp = $(this).closest('.pax_drop').find("."+fieldName+"F");
    var currentVal = parseInt(input.val());
    var adultsdisp = $(this).closest('.pax_drop').find(".adultsF");

    var adultsVal = parseInt(adultsdisp.html());
    // console.log(fieldName);
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
                htmldisp.html(currentVal - 1);
                adultsdisp.html(parseInt(adultsVal) - 1);
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
                htmldisp.html(currentVal + 1);
                adultsdisp.html(parseInt(adultsVal) + 1);
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
    } else {
        input.val(0);
    }
});

$(document).on('click', '.btn-number-multi', function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    // var input = $(this).parent().parent().find("input[name='"+fieldName+"']");
    var input = $(this).parent().parent().find('.'+fieldName);
    var htmldisp = $(this).closest('.pax_drop').find("."+fieldName+"F");
    var childsdisp = $(this).closest('.pax_drop').find(".childsF");
    var currentVal = parseInt(input.val());

    var childsVal = parseInt(childsdisp.html());
    // console.log(input);
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            if(currentVal > input.attr('min')) {
                htmldisp.html(currentVal - 1);
                removeItem($(this), currentVal);
                input.val(currentVal - 1).change();
                childsdisp.html(parseInt(childsVal) - 1);
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
                htmldisp.html(currentVal + 1);
                cloneItem($(this), currentVal+1);
                input.val(currentVal + 1).change();
                childsdisp.html(parseInt(childsVal) + 1);
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
    } else {
        input.val(0);
    }
});

function cloneItem(_this,currentVal){
    var template = _this.parent().parent().clone();
    // console.log(template);
    var section = template.clone().find('.numstepper').each(function() {
        // console.log(template);
        $(this).parent().find('p').show();
        $(this).parent().find('p span').html(currentVal);
        $(this).find('p').hide();
        $(this).parent().attr('id', 'clone-'+currentVal);
        $(this).find('input').val(0);
        $(this).find('input').attr('min', 0);
        $(this).find('input').attr('max', 18);
        if(_this.hasClass('roomAge')) {
            var roomcount = $(this).parent().find('.roomsno').val();
            // console.log(roomcount);
            $(this).find('input').attr('name', 'childs_ages_room'+roomcount+'[]');
        } else{
            $(this).find('input').attr('name', 'child_ages[]');
        }
        $(this).addClass('small-btns');
        $(this).find('input').attr('data-field', 'input-array');
        $(this).find('input').attr('class', 'quantity-input input-number input-array');
        $(this).find(":button[data-type='plus']").attr('class', 'quantity-btn quantity-right-plus btn-number-arr2');
        $(this).find(":button[data-type='minus']").attr('class', 'quantity-btn quantity-left-minus btn-number-arr2');
        $(this).find(":button").attr('data-field', 'input-array');
        //update id
        // this.id = newId;
    }).end()
    .appendTo(_this.parent().parent().parent().find('.clonediv'));
}
function removeItem(_this,currentVal){
    var section = _this.parent().parent().parent().find('.clonediv').each(function() {
        $(this).find('#clone-'+currentVal).remove();
    });
}

$('.input-number').focusin(function(){
    $(this).data('oldValue', $(this).val());
});

$('body').on('change', '.input-number', function(e){
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
        // $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled');
        $(this).parent().find("[data-type='minus']").removeAttr('disabled');
    } else {
        alert('Sorry, the minimum value was reached');
        htmldisp.html($(this).data('oldValue'));
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        // $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled');
        $(this).parent().find("[data-type='plus']").removeAttr('disabled');
    } else {
        alert('Sorry, the maximum value was reached');
        htmldisp.html($(this).data('oldValue'));
        $(this).val($(this).data('oldValue'));
    } 
});
$(".input-number").keydown(function (e) {
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

// Roooms action
$(document).on('click', '.btn-number-rooms', function(e){
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
                htmldisp.html(currentVal - 1);

                total_guest_in_rooms('adults',$(this), 'minus', currentVal);
                total_guest_in_rooms('childs',$(this), 'minus', currentVal);
                
                removeRooms($(this), currentVal);
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
        } else if(type == 'plus') {
            if(currentVal < input.attr('max')) {
                htmldisp.html(currentVal + 1);

                total_guest_in_rooms('adults',$(this), 'plus', currentVal);
                total_guest_in_rooms('childs',$(this), 'plus', currentVal);

                cloneRooms($(this), currentVal+1);
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
    } else {
        input.val(0);
    }
});


function total_guest_in_rooms($guest_type,_this, type, currentVal){
    if($guest_type == 'adults'){
        var roomsAdults = 0;
        var adultsdisp = _this.closest('.pax_drop').find(".adultsF");
        var adultsVal = parseInt(adultsdisp.html());
        if(type == 'minus') {
            roomsAdults = $('.clonediv-room').find('#clone-room-'+currentVal).find('.input-number.adults').val();
            // console.log(roomsAdults);
            adultsdisp.html(parseInt(adultsVal) - parseInt(roomsAdults));
        } else if(type == 'plus') {
            adultsdisp.html(parseInt(adultsVal)+1);
        }
    }else if($guest_type == 'childs') {
        var roomsChilds = 0;
        var childsdisp = _this.closest('.pax_drop').find(".childsF");
        var childsVal = parseInt(childsdisp.html());
        if(type == 'minus') {
            roomsChilds = $('.clonediv-room').find('#clone-room-'+currentVal).find('.input-number.childs').val();
            // console.log(roomsChilds);
            childsdisp.html(parseInt(childsVal) - parseInt(roomsChilds));
        } else if(type == 'plus') {
            childsdisp.html(parseInt(childsVal));
        }
    }
}


function cloneRooms(_this,currentVal){
    var template = _this.parents('.trip-options').find('.clone-room:first').clone();
    // console.log(template);
    var section = template.clone().find('.numstepper').each(function() {
        // console.log(template);
        $(this).addClass('small-btns');
        $(this).parent().next('.clonediv').children().remove();
        $(this).parent().parent().find('p.rooms').show();
        $(this).parent().parent().find('p.rooms span').html(currentVal);
        $(this).parent().parent().attr('id', 'clone-room-'+currentVal);
        $(this).parent().find('input[name="adults[]"]').val(1);
        $(this).parent().find('input[name="childs[]"]').val(0);
        $(this).parent().find('.roomsno').val(currentVal);
        $(this).parent().find('.quantity-btn').removeAttr('disabled');
    }).end()
    .appendTo('.clonediv-room');
}
function removeRooms(_this,currentVal){
    var section = _this.parents('.trip-options').find('.clonediv-room').each(function() {
        $(this).find('#clone-room-'+currentVal).remove();
    });
}

$('body').on('click', '.btn-number-arr2', function(e){
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    var input = $(this).parent().parent().find('.'+fieldName);
    var htmldisp = $(this).closest('.pax_drop').find("."+fieldName+"F");
    var currentVal = parseInt(input.val());
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

$( ".travellers-input" ).click(function() {
    $(this).closest('.pax_drop').find( ".travellers-input-popup" ).fadeIn( "slow", function() {
        // Animation complete.
    });
});
$( "i.fa.fa-times" ).click(function() {
    $(this).closest('.pax_drop').find( ".travellers-input-popup" ).fadeOut( "slow", function() {
        // Animation complete.
    });
});

$(".input-number").prop("readonly", true);