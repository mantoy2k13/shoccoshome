
<!-- Modal -->  
<div class="modal fade" id="showCropWindow" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-image"></i> Crop Image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="img-container">
                            <img id="imgToCrop" alt="Result Image" src="<?=base_url();?>assets/img/image-icon.png">
                            <input type="hidden" id="imgID">
                            <input type="hidden" id="imgValue">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="crop-pet-img canvas-img">
                            <div id="result" class="canvas-responsive"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 canvas-preview">
                                <div class="crop-pet-img">
                                    <img id="result-img" alt="Result Image" src="<?=base_url();?>assets/img/image-icon.png">
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <p class="f-15 text-black">Image Preview</p>
                                <button class="btn btn-warning text-white m-t-10" id="cropBtn"><i class="fa fa-crop"></i> Crop Image</button>
                                <button class="btn btn-success m-t-10" onclick="saveImageCrop()" id="saveBtn" disabled><i class="fa fa-save"></i> Save Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>