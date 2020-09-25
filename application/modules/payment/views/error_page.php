<?php $this->load->view('home/header');?>

<!-- <meta http-equiv="refresh" content="10;url=<?php echo site_url() ?>" /> -->

<div class="accountCntr" style="padding: 100px 0;">
  <div class="container">
    <div class="row">
      <div class="row2 white-container">
        <div class="col-md-12">
          <div style="">
            <table align="center" style="">
              <tbody>
                <tr>
                  <td class="msgIcon"><img src="<?php echo get_image_aws('public/img/Warning.png'); ?>"></td>
                  <td tabindex="-1" class="noticeTextType1 strongText">
                    <strong>ERROR MESSAGE :
                    <?php
                    $text = base64_decode($error);
                    echo $text;
                    ?>
                  </strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-sm-12 text-center" style="line-height: 4;margin-top: 20px">This page will automatically be redirected to the home page within 10 seconds</div>
      <div class="col-sm-12 text-center">
        <a href="<?php echo site_url() ?>" class="btn btn-primary">Search Again</a>  
      </div>
    </div> -->
  </div>
</div>

<!-- FOOTER -->
<?php $this->load->view('home/footer');?>

</body>
</html>
