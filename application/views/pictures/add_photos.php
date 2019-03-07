<!DOCTYPE html>
<html lang="en">

  <!-- Header CSS -->
  <?php $this->load->view('common/css');?>

  <body id="page-top">

    <!-- Navigation -->
    <?php $this->load->view('common/main-nav');?>

    <!-- Banner -->
    <?php $this->load->view('common/banner');?>

    <!-- Portfolio Grid Section -->
    <section class="content">
      <!-- 2nd Navbar -->
      <?php $this->load->view('common/profile-nav');?>

	  <div class="row m-t-10">
          <!-- Left Navbar -->
          <?php $this->load->view('common/left-nav');?>
        
          <!-- Main Content -->
		  <div class="col-md-9 m-t-10 p-l-0">
                <div class="pic-head bg-greyish">                
                    <div class="row">
                        <input type="hidden" value="<?=(isset($_SESSION['upl_msg'])) ? $_SESSION['upl_msg'] : '0';?>" id="getUplAlert">
                        <div class="col-md-12">
                            <i class="fa fa-image f-25 text-blue"></i> Add Photos
                        </div>
                        <div class="col-md-12 m-t-10">
                            <a href="javascript:;" class="p-nav b-700 f-14 active">Add Photos</a>
                            <a href="<?=base_url();?>pictures/pictures" class="p-nav b-700 f-14">All Photos</a>
                            <a href="<?=base_url();?>album/albums" class="p-nav b-700 f-14">Albums</a>
                        </div>
                    </div>
                    <form action="<?=base_url();?>pictures/add_all_photos" method="POST" enctype="multipart/form-data">
                        <!-- Upload Pets Images -->
                        <div class="row form-group">
                            <div class="col-md-12 m-t-20">
                                <div class="card">
                                    <div class="card-body drop-images text-center">
                                        <p><i class="fa fa-cloud-download-alt fa-3x text-orange"></i></p>
                                        <p class="text-black">Drag and Drop Images here or <br>Click to Upload</p>
                                        <input type="file" class="drag-files" id="uploadFiles" multiple="multiple" name="images_file[]" accept=".gif, .png, .jpg, .jpeg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 m-t-20 my-upload-pets text-center">
                                <label for="">Uploaded Images</label>
                                <div class="card">
                                    <div class="card-body uploaded-images">
                                        <div class="row uploaded-files">
                                            <div class="col-md-12 emptyImgMsg">
                                                <div class="alert alert-danger f-15" role="alert">
                                                    <strong><i class="fa fa-check"></i> Empty!</strong> Please upload  image less than 3 mb of size.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" id="saveImgBtn" class="btn bg-orange sub-btn" disabled><i class="fa fa-save"></i> Save images</button>
                            </div>
                        </div>
                    </form>
                </div>
          </div>
          <!-- Close Main Content -->
	  </div>
    </section>

    <!-- Footer -->
    <?php $this->load->view('common/footer');?>
    <?php $this->load->view('pet/img_crop');?>
  </body>
</html>
