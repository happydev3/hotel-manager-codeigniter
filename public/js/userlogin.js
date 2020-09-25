function PopupCenter(url, title, w, h) {
  var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
  var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
  width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
  height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
  var left = ((width / 2) - (w / 2)) + dualScreenLeft;
  var top = ((height / 2) - (h / 2)) + dualScreenTop;
  var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
  if (window.focus) {
    newWindow.focus();
  }
}

function checkLoginState() {
  FB.login(function(response) {
    statusChangeCallback(response);  
  }, {
    scope: 'email,user_photos', 
    return_scopes: true
  });   
}

window.fbAsyncInit = function() {
    FB.init({   
      appId       :'1755701414753512',
      cookie     : true, 
      xfbml      : true,  
      version    : 'v2.8' 
     });
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function showmodalLogin() {
    $('#modalLogin').modal('show');
}
function statusChangeCallback(response) {
  if (response.authResponse) {
    FB.api('/me?fields=id,name,email,first_name,middle_name,last_name,gender,picture', function(response) {
      $name=response.name ;
      $email=response.email;
      $first_name=response.first_name;
      $middle_name=response.middle_name;
      $last_name=response.last_name;
      $gender=response.gender;
      $picture=JSON.stringify(response.picture);
      $.post(siteUrl+'fblogin/login',
      { 
        name: ""+$name , email: ""+$email, first_name: ""+$first_name, middle_name: ""+$middle_name, last_name: ""+$last_name, gender: ""+$gender, picture: ""+$picture
      },
      function(data){
        $currenturl = location.href;
        $('.logininpval').html(data.results);       
        $('#modalLogin').modal('hide');
        $('#ischecklogin').attr('data-val','yes');
        $('#modalRegister').modal('hide');        
        $val1 = $currenturl.includes("/hotels/itinerary");      
        if($val1)
        {               
          $("#itinerary-login").css("display","none");
        }
        var seg_url =location.href;
        // $val3 = seg_url.includes("/cars/itinerary");
        // if($val3){
        //   login_open($email);
        // }
      }, 'json');
    });   
  } 
}

function gAjaxlogin() {
  $.ajax({
    url: siteUrl + 'Glogin/trigerGAjax',
    data: '',
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      $currenturl = location.href;                  
      $('.logininpval').html(data.results);       
      $('#modalLogin').modal('hide');
      $('#ischecklogin').attr('data-val','yes');      
      $('#modalRegister').modal('hide');  
      $val1 = $currenturl.includes("/hotels/itinerary");   
      if($val1)
      {               
        $("#itinerary-login").css("display","none");
      }    

      // var seg_url = window.location.pathname;
      // if(seg_url == '/cars/itinerary'){
      //  login_open(data.email);
      // }
      var seg_url =location.href;
      // $val3 = seg_url.includes("/cars/itinerary");
      // if($val3){
      //   login_open(data.email);
      // }
    }
  });
}

function userlogout_inpval() {
  $.ajax({
    url: siteUrl + 'b2c/logout',
    data: '',
    dataType: 'json',
    type: 'POST',
    success: function(data) {
      $currenturl = location.href;                 
      $val = $currenturl.includes("/b2c/"); 
      $('#ischecklogin').attr('data-val','no');
      if($val){               
        window.location.href = siteUrl;
      } else {
        $('.logininpval').html(data.results);
      }
      $val1 = $currenturl.includes("/hotels/itinerary");      
      if($val1){
        $("#itinerary-login").css("display","block");
      }
      $('.memberlink.subslink').removeAttr('onclick');
      $('.memberlink').attr('data-toggle', 'modal');
      $('.memberlink').attr('data-target', '#modalRegister');

      $('.member_href').attr('data-target','#modalLogin');
      $('.loggedin').each(function(){
        $(this).addClass('loggedout').removeClass('loggedin');
      });

      if($('.promo_href').length > 0){
        $('.promo_href').each(function() {
          priceChangeOnLogin($(this),'logout');
        });
      }

      $('.rooms.ajax-tabs.searchAjaxData').removeClass('active');
      $('.ajax-tab-content.ajax-content').hide();

      if (typeof selected_rooms !== 'undefined' && $.isFunction(selected_rooms)) {
        selected_rooms();
      }
    }
  });
}

$('#user_signup').on('click', function(e){
  e.preventDefault();
  var form = $(this).parents('form');
  // console.log(form)
  form.parsley().validate();
  if (!form.parsley().isValid()) {
    return false;
  } else{
    var _this = $(this);
    var action = form.attr('goaction');
    $.ajax({
      type: 'post',
      // url: action,
      url: siteUrl + 'b2c/user_register',
      data: form.serialize(),
      dataType: 'json',
      beforeSend: function() {
      },
      success: function(data) {
        $currenturl = location.href;  
        $('#usersignup_msg').html(data.msg);
        $('.logininpval').html(data.results); 
        if(data.stat!='false'){
          $('.memberlink').removeAttr('data-toggle');
          $('.memberlink').removeAttr('data-target');
          $('.memberlink.subslink').attr('onclick',"return alert('You have already signed up for Vacaymenow Members Club')");
          $('#modalLogin').modal('hide');
          $('#ischecklogin').attr('data-val','yes');
          $('#modalRegister').modal('hide');
          $val1 = $currenturl.includes("/hotels/itinerary");   
          if($val1) {               
             $("#itinerary-login").css("display","none");
          }
          $('.member_href').removeAttr('data-target');
          $('.loggedout').each(function(){
            $(this).addClass('loggedin').removeClass('loggedout');
          });
          if($('.promo_href').length > 0){
            $('.promo_href').each(function() {
              priceChangeOnLogin($(this));
            });
          }
          $('.rooms.ajax-tabs.searchAjaxData').removeClass('active');
          $('.ajax-tab-content.ajax-content').hide();

          if (typeof selected_rooms !== 'undefined' && $.isFunction(selected_rooms)) {
            selected_rooms();
          }
          // var seg_url = window.location.pathname;
          // var seg_url =location.href;
          // $val3 = seg_url.includes("/cars/itinerary");
          // if($val3){
          //   login_open($email);
          // }
        }
      },
      error: function(data){
        alert('Request failed');
      }
    });
  }
});


$('#userlogin_id').click( function(){ 
    $email=$('#sign_user_email').val();
    $pass=$('#sign_user_password').val();
    // console.log($email)
    if($('#sign_user_email').val()=='')
    {
      $('#sign_user_email').attr("placeholder", "Enter Your Email Address");
    } 
    else if(!isEmail($('#sign_user_email').val()))
    {
      $('#sign_user_email').val('');
      $('#sign_user_email').attr("placeholder", "Enter Valid Email Address");
    }
    if($('#sign_user_password').val()=='')
    {
      $('#sign_user_password').attr("placeholder", "Enter Password");
    } 
    $.ajax({
      url: siteUrl + 'b2c/checklogin',
      data: '&email='+$email+'&pass='+$pass,
      dataType: 'json',
      type: 'POST',
      success: function(data) {
        $currenturl = location.href;  
        $('#userlogin_msg').html(data.msg);
        $('.logininpval').html(data.results); 
        if(data.stat!='false'){
          $('.memberlink').removeAttr('data-toggle');
          $('.memberlink').removeAttr('data-target');
          $('.memberlink.subslink').attr('onclick',"return alert('You have already signed up for Vacaymenow Members Club')");
          $('#sign_user_email').val('');
          $('#sign_user_email').attr("placeholder", "Enter The Email Address");
          $('#sign_user_password').val('');
          $('#sign_user_password').attr("placeholder", "Password");
          $('#modalLogin').modal('hide');
          $('#ischecklogin').attr('data-val','yes');
          $('#modalRegister').modal('hide');
          $val1 = $currenturl.includes("/hotels/itinerary");   
          if($val1) {               
             $("#itinerary-login").css("display","none");
          }

          if($('.promo_href').length > 0){
            $('.promo_href').each(function() {
              priceChangeOnLogin($(this));
            });
          }

          $('.rooms.ajax-tabs.searchAjaxData').removeClass('active');
          $('.ajax-tab-content.ajax-content').hide();

          if (typeof selected_rooms !== 'undefined' && $.isFunction(selected_rooms)) {
            selected_rooms();
          }
          // var seg_url = window.location.pathname;
          // var seg_url =location.href;
          // $val3 = seg_url.includes("/cars/itinerary");
          // if($val3){
          //   login_open($email);
          // }
        }
      }
    });
});

function priceChangeOnLogin(_this,$initype='') {
  var $promo_type = _this.attr('data-type');
  var $promo_night = _this.attr('promo-night');
  var $search_id = _this.attr('data-searchid');
  var _parent = _this.parents('.promo_parent_div');
  $.ajax({
      url: siteUrl + 'home/priceChangeOnLogin',
      data: 'promo_type='+$promo_type+'&search_id='+$search_id+'&promo_night='+$promo_night,
      dataType: 'json',
      type: 'POST',
      success: function(data) {
        if($promo_type=='min_promo'){
          if(data.org_cost > data.member_cost) {
            $('.pricespan').css('display','initial');
            $('.minprice').html((data.member_cost).toFixed(2));
            $('.minorgcost').html((data.org_cost).toFixed(2));
          } else {
            $('.pricespan').css('display','none');
            $('.minprice').html((data.org_cost).toFixed(2));
          }
        } else if($promo_type=='itinerary_promo'){
          $('.grand-total').html((parseFloat(data.member_cost)+parseFloat(data.taxes)).toFixed(2));
          $('.total_disc_div').html((data.total_discount).toFixed(2));

          if(data.org_cost > data.member_cost) {
            $('.total_disc_tr').css('display','table-row');
            $('.total_cost_div').html((data.member_cost).toFixed(2));
          } else {
            $('.total_disc_tr').css('display','none');
            $('.total_cost_div').html((data.org_cost).toFixed(2));
          }
        } else {
          if($promo_type == 'min_promo') {
            if(data.org_cost > data.member_cost) {
              $('.pricespan').css('display','initial');
              $('.minprice').html((data.member_cost).toFixed(2));
              $('.minorgcost').html((data.org_cost).toFixed(2));
            } else {
              $('.pricespan').css('display','none');
              $('.minprice').html((data.org_cost).toFixed(2));
            }
          }
          _this.removeAttr('data-target');
          $('.loggedout').each(function(){
            $(this).addClass('loggedin').removeClass('loggedout');
          });
          _parent.find('.badge_div').html(data.discount_badge);
          _parent.find('.org_price_div').html(data.org_price_div);
          _parent.find('.disc_cost_div').html((data.member_cost).toFixed(2));

          var total2 = 0;
          $('.rooms_loop.activeone').each(function(){
            total2 = parseFloat(total2) + parseFloat($(this).find('.price-val:visible').html().trim());
          });
          // console.log(total2);
          $('.total-section #grand-total').html(total2.toFixed(2));
        }
      }
  });
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

getminPromo();

function getminPromo($data=''){
  var mindiv = $('.rooms_loop.loop0').find('.promo_href');
  var search_id = mindiv.attr('data-searchid');
  if(mindiv.length > 0) {
    $('.min_promo').html('<a href="#" class="member_href promo_href" data-searchid="'+search_id+'" data-type="min_promo" promo-night="1"></a>');

      priceChangeOnLogin($('.min_promo .promo_href'),'min_promo');
  }
}