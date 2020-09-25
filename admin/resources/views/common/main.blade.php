<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="vacaymenow icon" href="{{get_image_aws('public/assets/img/favicon.ico')}}">
    <title>Welcome - Admin</title>
    <!-- Bootstrap core CSS -->
    {!! Html::style('public/tpdassets/css/bootstrap.min.css')!!}
    {!! Html::style('public/tpdassets/css/bootstrap-reset.css')!!}
    <!--Animation css-->
    {!! Html::style('public/tpdassets/css/animate.css')!!}
    <!--Icon-fonts css-->
    {!! Html::style('public/tpdassets/assets/font-awesome/css/font-awesome.css')!!}
    {!! Html::style('public/tpdassets/assets/ionicon/css/ionicons.min.css')!!}
    {!! Html::style('public/tpdassets/assets/material-design-iconic-font/css/material-design-iconic-font.min.css')!!}

    @yield('css')
   
    @include('common/leftpanel')
    
    @include('common/toppanel')

    @yield('content')


    <!-- Footer Start -->
    <footer class="footer">
        <?php echo date('Y') ?> © Admin.
    </footer>
    <!-- Footer Ends -->
</section>
<!-- Main Content Ends -->
<!-- js placed at the end of the document so the pages load faster -->
{!! Html::script('public/tpdassets/js/jquery.js')!!}
{!! Html::script('public/tpdassets/js/jquery-ui-1.10.1.custom.min.js')!!}
{!! Html::script('public/tpdassets/js/pace.min.js')!!}
{!! Html::script('public/tpdassets/js/bootstrap.min.js')!!}
{!! Html::script('public/tpdassets/js/modernizr.min.js')!!}
{!! Html::script('public/tpdassets/js/wow.min.js')!!}
{!! Html::script('public/tpdassets/js/jquery.nicescroll.js')!!}

@yield('script')

{!! Html::script('public/tpdassets/js/jquery.app.js')!!}

<script>
    function waitForMsg() {
        $.ajax({
            type: "GET",
            url: "<?php echo url('notification/count') ?>",
            async: true,
            cache: false,
            timeout: 50000,
            dataType: 'json',
            success: function (data) {
                // console.log(data)
                if(data.total_notice > 0){
                   $('#total_note').html(data.total_notice);
                   $('.left-pulse').addClass('pulse-block');
                   $('.'+data.supplier_id).addClass('pulse-block');
                } else {
                    $('#total_note').html('');
                    $('.left-pulse').removeClass('pulse-block');
                    $('.'+data.supplier_id).removeClass('pulse-block');
                }
                $('#noticeboard').html(data.noticeboard);
                $('#topnotification').html(data.notes);
                setTimeout(waitForMsg,5000);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("error", textStatus + " (" + errorThrown + ")");
                setTimeout(waitForMsg,15000);
            }
        });
    };
    $(document).ready(function () {
        waitForMsg();
    });
</script>
</body>
</html>