$(document).ready(function(){
  $("#mon_dur").click(function(){    
      $('.monthsdurtr').find(".active").css('background-color', '#A01D26');
      $("#distmonthtab").css("display", "inline");
      $("#holidistmonthtab").css("display", "inline");
      $(this).parent().find('i').toggleClass('active');
      $('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
    });
    $(".monthsdur").click(function() {  
      $indexVal=$(this).attr("data-monthidex");
      $strVal=$(this).attr("data-monthyear");
      $('#mon_dur').val($strVal);
      $('#holiduration').val($indexVal);    
      $('.monthsdurtr').find("td").removeClass('active');
      $('.monthsdurtr').find("td").css('background', '#4c4c4a');
      $(this).addClass('active');
      $(this).css('background-color', '#A01D26');
      $("#distmonthtab").css("display", "none");
      $("#holidistmonthtab").css("display", "none");
      $('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').toggleClass('active');
      $('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
    });
  $("#cityName").autocomplete({
       source: siteUrl+"home/destinationsearch",
       minLength: 2,
       autoFocus: true,
          select: function( event, ui ) {
      $("input[name='cityid']").val();
      $("input[name='cityid']").val(ui.item.id);  
    }
   });
  });

  $(document).mouseup(function (e)
  {
     if (!$("#holidistmonthtab").is(e.target)
        && $("#holidistmonthtab").has(e.target).length === 0)
    {
        $("#holidistmonthtab").hide();
        $('#holiday.tab-pane.active').find('.input-icon.input-group').find('i').removeClass('active');
        $('#holiday.tab-pane.active').find('.input-icon').find('i.fa-map-marker').removeClass('active');
    }});