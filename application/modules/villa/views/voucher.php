<?php $this->load->view('home/header'); ?>
<script type = "text/javascript" >
    function changeHashOnLoad() {
        window.location.href += "#";
        setTimeout("changeHashAgain()", "50");
    }
    function changeHashAgain() {
        window.location.href += "1";
    }
    var storedHash = window.location.hash;
    window.setInterval(function () {
        if (window.location.hash != storedHash) {
        window.location.hash = storedHash;
        }
    }, 50);
</script>

<body onload="changeHashOnLoad();">
<?php if(!empty($result)) { ?>
<section class="push-top-30" id="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box" style="background: #fff;padding: 20px;">
                    <?php $this->load->view('voucher_content'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="" class="push-top-20 push-bottom-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <a onclick="coderHakan();return false;" href="#" class="label label-info" style="color: #fff;text-decoration: none;font-size: 14px;"><i class="fa fa-print"></i> Print</a> |
                <a href="<?php echo site_url() ?>" class="label label-info" style="color: #fff;text-decoration: none;font-size: 14px;"><i class="fa fa-home"></i> Home</a>
            </div>
        </div>
    </div>
</section>
<?php }else{ ?>
<section id="" class="push-top-20 push-bottom-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <table align="center" width="100%">
                        <tr>
                            <td bgcolor="#e7e7e7" align="center">
                                <h3>Sorry, No Voucher is Availbale.. Please try for another voucher... <a href="<?php echo base_url(); ?>" title="home"><i class="fa fa-home"></i></a></h3>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php $this->load->view('home/footer'); ?>
</body>
</html>
