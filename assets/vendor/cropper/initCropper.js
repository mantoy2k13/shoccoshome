$(document).ready(function(){
    $('.canvas-img').hide();
});

window.addEventListener('DOMContentLoaded', function () {
    var image = document.getElementById('imgToCrop');
    var cropBoxData;
    var canvasData;
    var cropper;
    var button = document.getElementById('cropBtn');
    var result = document.getElementById('result');
    var minCroppedWidth = 50;
    var minCroppedHeight = 50;
    var maxCroppedWidth = 900;
    var maxCroppedHeight = 700;

    $('#showCropWindow').on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
        autoCropArea: 0.5,
        data: {
            width: (minCroppedWidth + maxCroppedWidth) / 2,
            height: (minCroppedHeight + maxCroppedHeight) / 2,
            },
    
            crop: function (event) {
            var width = event.detail.width;
            var height = event.detail.height;
    
            if (
                width < minCroppedWidth
                || height < minCroppedHeight
                || width > maxCroppedWidth
                || height > maxCroppedHeight
            ) {
                cropper.setData({
                width: Math.max(minCroppedWidth, Math.min(maxCroppedWidth, width)),
                height: Math.max(minCroppedHeight, Math.min(maxCroppedHeight, height)),
                });
            }
            },
        ready: function () {
            //Should set crop box data first here
            cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);

        }
        });
    }).on('hidden.bs.modal', function () {
        cropBoxData = cropper.getCropBoxData();
        canvasData = cropper.getCanvasData();
        cropper.destroy();
    });

        button.onclick = function () {
            result.innerHTML = '';
            result.appendChild(cropper.getCroppedCanvas());
            $("#saveBtn").removeAttr('disabled');
            $('.canvas-preview').hide();
            $('.canvas-img').show();
            $("#result-img").attr('src', cropper.getCroppedCanvas().toDataURL());
            $("#imgValue").val(cropper.getCroppedCanvas().toDataURL());
        };
    });

function saveImageCrop(){
    var imgID = $("#imgID").val()
    var imgValue = $("#imgValue").val()
    $('.u-img'+imgID).attr('src', imgValue);
    $('#imgval'+imgID).val(imgValue);
    $('#showCropWindow').modal('hide');
}