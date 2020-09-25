// onclick next element focus
function focusObj(obj,ev){
  var windowWidth = $(window).width();
  // alert(windowWidth);
  if(windowWidth > 425){
    if(ev == 'show'){
      obj.show();
    } else{
      obj.focus();
    }
  }
}

$(document).ready(function () {
    //datepicker code

    var d = new Date();
    var currDate = d.getDate();
    // var currDate2 = d.getDate()+1;
    // var currDate2 = d.setDate(d.getDate() + 1);
    var nextD = new Date((new Date()).valueOf() + 1000*3600*24);
    var currDate2 = nextD.getDate();
    // console.log(d);
    // console.log(currDate2);
    var currMonth = d.getMonth()+1;
    var currMonth2 = nextD.getMonth()+1;
    var currYear = d.getFullYear();
    var currYear2 = nextD.getFullYear();

    // var dateStr = currDate + "/" + currMonth + "/" + currYear;
    // var dateStr2 = currDate2 + "/" + currMonth + "/" + currYear;
    var dateStr = ('0'+currDate).slice(-2)+'/'+('0'+currMonth).slice(-2) + '/'+currYear;
    var dateStr2 = ('0'+currDate2).slice(-2)+'/'+('0'+currMonth2).slice(-2) + '/'+currYear2;

    var dph1 = $('#dph1').val();
    if(dph1 == ''){
      $('#dph1').val(dateStr);
    }
    var dph2 = $('#dph2').val();
    if(dph2 == ''){
      $('#dph2').val(dateStr2);
    }
    var dpr1 = $('#dpr1').val();
    if(dpr1 == ''){
      $('#dpr1').val(dateStr);
    }var dpr2 = $('#dpr2').val();
    if(dpr2 == ''){
      $('#dpr2').val(dateStr2);
    }
    var dpt1 = $('#dpt1').val();
    if(dpt1 == ''){
      $('#dpt1').val(dateStr);
    }
    var dpt2 = $('#dpt2').val();
    if(dpt2 == ''){
      $('#dpt2').val(dateStr2);
    }
    var dph1 = $('#dpv1').val();
    if(dph1 == ''){
      $('#dpv1').val(dateStr);
    }
    var dph2 = $('#dpv2').val();
    if(dph2 == ''){
      $('#dpv2').val(dateStr2);
    }

    var dp = $('.dp').val();
    if(dp == ''){
      $('.dp').val(dateStr);
    }
    // $('#dph1,#dpr1,#dpt1').val(dateStr);
    // $('#dph2,#dpr2,#dpt2').val(dateStr2);

    $("input[name='tripType']").change(function(){
        $val = $(this).val();
        //alert($val);
        if($(this).val() == 'S'){
            $('#O-R-Trip').fadeIn('fast');
            $('#dpf2Cntr-dom').hide();
            $('#multicity').hide();
            $('.tripTypeVal').val('S');
        }
        if($(this).val() == 'R'){
            $('#O-R-Trip, #dpf2Cntr-dom').fadeIn('fast');
            $('#multicity').hide();
            $('.tripTypeVal').val('R');
        }
        else if($(this).val() == 'M'){
            $('#O-R-Trip').hide();
            $('#multicity').fadeIn('fast');
            $('.tripTypeVal').val('M');
        }
    });


    if ($('#back-top').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#back-top').addClass('show');
                } else {
                    $('#back-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    var options = [];
    $( '.dropdown-menu.adults-dropdown a' ).on( 'click', function( event ) {
       var $target = $( event.currentTarget ),
           val = $target.attr( 'data-value' ),
           $inp = $target.find( 'input' ),
           idx;
       if ( ( idx = options.indexOf( val ) ) > -1 ) {
          options.splice( idx, 1 );
          setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
       } else {
          options.push( val );
          setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
       }
       $( event.target ).blur();  
       // console.log( options );
       return false;
    });

    // Modal over modal
    $('.close-first').click(function(e){
        e.preventDefault();
        var target = $(this).attr('data-target');
        $(this).parents('.modal').modal('hide').on('hidden.bs.modal', function (e) {
          $(target).modal('show');
          if ($('.modal:visible').length) {
            $('body').addClass('modal-open');
            $('body').css('padding-right', '0');
            $(target).css('padding-left', '0');
          }
          $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
        });

    });

});