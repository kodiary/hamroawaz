<div>
    <div><h1>Slider Image</h1>
        <button >Add Slider Image</button>
    </div>
    <div style="display: none;" class="form" id='form' >
       <input id="sortpicture" type="file" name="sortpic" /><br /><strong>630*290</strong><br />
        <button id="upload">Upload</button>
    </div>
    <div class="response"></div>
</div>
<script>
$(function(){
    $('button').click(function(){
     $('.form').toggle();   
    });
});
$("#upload").on("click", function() {
    var file_data = $("#sortpicture").prop("files")[0];   
    var form_data = new FormData();                  
    form_data.append("image", file_data)                            
    $.ajax({
                url: "<?php echo $this->webroot; ?>Dashboard/sliderImage",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(a){
                  $('.response').html(a);
                }
     });
});
</script>
 


