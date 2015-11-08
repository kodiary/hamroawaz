function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};

// check for selected crop region
function checkForm() {
    if (parseInt($('#w').val())) return true;
    $('.error').html('Please select a crop region and then press Upload').show();
    return false;
};



// update info by cropping (onChange and onSelect events handler)
function updateInfo(e) {
    $('#x1').val(e.x);
    $('#y1').val(e.y);
    $('#x2').val(e.x2);
    $('#y2').val(e.y2);
    $('#w').val(e.w);
    $('#h').val(e.h);
};

// clear info by cropping (onRelease event handler)
function clearInfo() {
    $('.info #w').val('');
    $('.info #h').val('');
};

// Create variables (in this scope) to hold the Jcrop API and image size
var jcrop_api, boundx, boundy;

function fileSelectHandler() {

    // get selected file
    var oFile = $('#image_file')[0].files[0];

    // hide all errors
    $('.error').hide();

    // check for image type (jpg and png are allowed)
 var rFilter = /^(image\/jpeg|image\/png|image\/jpg|image\/JPGimage\/JPEG|image\/PNG)$/i;
    if (! rFilter.test(oFile.type)) {
        $('.error').html('Please select a valid image file (jpg and png are allowed)').show();
        return;
    }

    // check for file size
   /* if (oFile.size <250 * 1024) {
        $('.error').html('You have selected too big file, please select a one smaller image file').show();
        return;
    }*/

    // preview element
    var oImage = document.getElementById('preview');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        
        
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler
        
        //alert(oImage.naturalWidth);
            // display step 2
            $('.step2').fadeIn(500);
           if(oImage.naturalWidth<600 || oImage.naturalHeight<400){ 
             $('.error').html('Minimus image size should be 600px x 400px').show();
              $('.step2').hide();
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
                $('#preview').width(oImage.naturalWidth);
                $('#preview').height(oImage.naturalHeight);
            }

            setTimeout(function(){
                // initialize Jcrop
                $('#preview').Jcrop({
                    minSize: [600,400], // min crop size
                      boxWidth: 928,   //Maximum width you want for your bigger images
                     boxHeight: 522,
                     //xsize=$prevcnt.width(),
                     //ysize=$prevcnt.height(),
                    bgFade: true, // use fade effect
                    bgOpacity: .3, // fade opacity
                    onChange: updateInfo,
                    onSelect: updateInfo,
                    onRelease: clearInfo,
                    aspectRatio:3/2
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

function checkslider() {

    // get selected file
    var oFile = $('#slider')[0].files[0];

    // hide all errors
    $('.slidererr').hide();

    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        $('.slidererr').html('Please select a valid image file (jpg and png are allowed)').show();
        return;
    }

    // check for file size
    if (oFile.size > 250 * 1024) {
        $('.slidererr').html('You have selected too big file, please select a one smaller image file').show();
        return;
    }

    // preslider element
    var oImage = document.getElementById('preslider');

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        
        
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler
        
        //alert(oImage.naturalWidth);
            // display step 2
            //$('.step2').fadeIn(500);
           if(oImage.naturalWidth<300 || oImage.naturalHeight<400){ 
             $('.slidererr').html('You have selected too small file, please select bigger image file').show();
              //$('.step2').hide();
            return false;
           }
            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
         
           
            $('#filesize').val(sResultFileSize);
            $('#filetype').val(oFile.type);
            $('#sliderdimension').val(oImage.naturalWidth + ' x ' + oImage.naturalHeight);


            
        };
    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}

