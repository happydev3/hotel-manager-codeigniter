
                                                    <div class="form-group">
                                                        <label for="file2" class="col-sm-3 control-label"> Select Banner Image</label>
                                                        <div>
                                                            <?php if($image->image_path!=''){ ?>
                                                            <img src="<?php echo $image->image_path; ?>" width="100" height="100">
                                                            <?php }else { ?>
                                                            <img  src="<?php echo base_url(); ?>public/img/noimage.jpg" width="100" height="100" >
                                                            <?php } ?>
                                                        </div><br>
                                                        <div class="col-sm-6">
                                                            <input type="file" name="file" id="file2" class='uniform'>
                                                        </div>
                                                    


                                           

                                            
                                                <div class="form-group">
                                                    
                                                        <button class="btn btn-primary" type="submit" value="upload">Update</button>
                                                        <a href="<?php echo site_url(); ?>/cms/add_image"><button class="btn btn-danger" >Back</button></a>
<!--												<input type="reset" class='btn btn-danger' value="reset">-->
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </fieldset>
                                    </form>
                                
        </div>	
         <?php echo $this->load->view('footer'); ?>