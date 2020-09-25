<?php $this->load->view('home/header');?>
<div class="bottomSection">
  <div class="container">
      <div class="white-bg" style="width:100%;">        
        <div class="col-md-12" style="background: #FFF;">
          <div class="col-md-8" style="height:300px;align:center;margin-left: 10%">
            <div style=" margin-top: 20px;align:center">
              <table align="center" style="width:100%;margin:15%;margin-left: 15%">
                <tbody>
                  <tr>
                    <td class="msgIcon"><img src="<?php echo get_image_aws('public/img/Warning.png') ?>"></td>
                    <td tabindex="-1" class="noticeTextType1 strongText">
                      <strong>ALERT :
                      <?php $text = base64_decode($error); echo $text; ?>
                    </strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>   
          </div>
        </div>     
    </div>
  </div>
  <!-- FOOTER -->
  <?php $this->load->view('home/footer');?>
</body>
</html>