<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/custom.css">
<script src="<?php echo base_url(); ?>public/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<style>
ul.gallery {
    clear: both;
    float: left;
    width: 100%;
    margin-bottom: -10px;
    padding-left: 3px;
}
ul.gallery li.item {
    width: 25%;
    height: 215px;
    display: block;
    float: left;
    margin: 0px 15px 15px 0px;
    font-size: 12px;
    font-weight: normal;
    background-color: d3d3d3;
    padding: 10px;
    box-shadow: 10px 10px 5px #888888;
}

.item img{width: 100%; height: 184px;}

.item p {
    color: #6c6c6c;
    letter-spacing: 1px;
    text-align: center;
    position: relative;
    margin: 5px 0px 0px 0px;
}
</style>
<section id="content">
    <div class="page page-forms-wizard">
        <div class="row">
            <div class="col-md-12">
                <div class="pageheader">
                    <h2>Add Packages <span></span></h2>
                    <div class="page-bar  br-5">
                        <div class="form-group">
                            <a href="<?php echo site_url() ?>holiday/quick_add" class="btn btn-success" type="button"><i class="fa fa-list m-right-xs"></i> Add Your Property</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagecontent">
            <div class="row">
                <div class="col-md-12">
                    <section class="boxs">
                        <div class="col-lg-12">
                            <div class="col-lg-12">
                                <p><?php echo $this->session->flashdata('statusMsg'); ?></p>
                            </div>
                            <form enctype="multipart/form-data" action="" method="post">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Choose Files</label>
                                    <input type="file" class="form-control" name="userFiles[]" multiple/>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="submit" name="fileSubmit" value="UPLOAD"/>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <ul class="gallery">
                                    <?php if(!empty($files)): foreach($files as $file): ?>
                                    <li class="item">
                                        <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="" >
                                        <p>Uploaded On <?php echo date("j M Y",strtotime($file['created'])); ?></p>
                                    </li>
                                    <?php endforeach; else: ?>
                                    <p>File(s) not found.....</p>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/main.js"></script>