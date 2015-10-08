
// update info by cropping (onChange and onSelect events handler)
function updateInfo1(e) {
    $('#x11').val(e.x);
    $('#y11').val(e.y);
    $('#x22').val(e.x2);
    $('#y22').val(e.y2);
    $('#w1').val(e.w);
    $('#h1').val(e.h);
};

// clear info by cropping (onRelease event handler)
function clearInfo1() {
    $('.info #w1').val('');
    $('.info #h1').val('');
};

// Create variables (in this scope) to hold the Jcrop API and image size
var jcrop_api, boundx, boundy;

function fileSelectHandler1() {

    // get selected file
    var oFile = $('#slider')[0].files[0];

    // hide all errors
    $('.error1').hide();

    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        $('.error1').html('Please select a valid image file (jpg and png are allowed)').show();
        return;
    }

    // check for file size
    if (oFile.size > 250 * 1024) {
        $('.error1').html('You have selected too big file, please select a one smaller image file').show();
        return;
    }

    // previewslider element
    var oImage = document.getElementById('previewslider');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        
        
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler
        
        //alert(oImage.naturalWidth);
            // display step 2
            $('.sliderstep2').fadeIn(500);
           if(oImage.naturalWidth<400 || oImage.naturalHeight<300){ 
            alert("image is not valid to be cropped");
            $('#previewslider').attr('src','');
            $('.sliderstep2').hide();
            return false;
           }
            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            $('#filesize').val(sResultFileSize);
            $('#filetype').val(oFile.type);
            $('#filedim').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);

            // destroy Jcrop if it is existed
            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
                $('#previewslider').width(oImage.naturalWidth);
                $('#previewslider').height(oImage.naturalHeight);
            }

            setTimeout(function(){
                // initialize Jcrop
                $('#previewslider').Jcrop({
                    minSize: [32, 32], // min crop size
                    aspectRatio : 1, // keep aspect ratio 1:1
                    bgFade: true, // use fade effect
                    bgOpacity: .3, // fade opacity
                    onChange: updateInfo1,
                    onSelect: updateInfo1,
                    onRelease: clearInfo1
                }, function(){

                    // use the Jcrop API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];

                    // Store the Jcrop API in the jcrop_api variable
                    jcrop_api = this;
                });
            },3000);

        };
    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}
