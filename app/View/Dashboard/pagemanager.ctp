<div><ins></ins>
    <div>
    <h1>Page Manager</h1>
    <button class="add">Add</button>
    </div>
    <div class="page" style="display: none;">
        <input type="text" placeholder="About Us" name="title"  class="title" required=""/><br />
        <textarea name="des" class="des ckeditor" required=""></textarea><br />
        <a href="javascript:void(0)" class="submit">Submit</a>
    </div>
    <table class="response">
    <thead><th>Id</th><th>Title</th><th>Description</th></thead>
    </table>
</div>
<script>
$(function(){
    $(".add").click(function(){
    $(".page").toggle('slow'); 
    });
    $(".submit").click(function(){
         for (instance in CKEDITOR.instances) 
            {
        CKEDITOR.instances[instance].updateElement();
            }
        var t = $('.title').val();
        var d = $('.des').val();
        $.ajax({
            url:'<?php echo $this->webroot; ?>Dashboard/addpagemanager',
            type:'post',
            data:'title='+t+'&des='+d,
            success: function(response) 
            {
                var data = response;
                response.forEach(function(data) {
                $(".response tbody ").append("<li>" + data.username + ":" + data.text + "</li>");
   });
            }
    });
    $('.page').hide();
    
    });
});
</script>