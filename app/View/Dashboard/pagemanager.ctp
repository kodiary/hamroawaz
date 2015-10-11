<div><ins></ins>
    <div>
    <h1>Page Manager</h1>
    <button class="add">Add</button>
    </div>
    
    <div class="page" style="display: none;">
        <input type="hidden" value="" class="id" />        
        <input type="text" placeholder="About Us" name="title"  class="title" required=""/><br />
        <textarea name="des" class="des ckeditor" required="" id="des"></textarea><br />
        <a href="javascript:void(0)" class="submit">Submit</a>
    </div>
    <div class="response">
    <table>
    <tr><td>Id</td><td>Title</td><td>Desciption</td><td>Action</td></tr>
    <?php foreach($q as $k)
    {
       ?><tr><td><?php echo $k['Pagemanager']['id']; ?></td>
       <td><?php echo $k['Pagemanager']['title']; ?></td>
       <td><?php echo $k['Pagemanager']['description']; ?></td>
       <td><button class="edit" title="<?php echo $k['Pagemanager']['id']; ?>">Edit</button>
            <button onclick="deleteItem" class="del" title="<?php echo $k['Pagemanager']['id']; ?>">Delete</button>
       </td>
       </tr><?php 
    }
     ?>
     </table>
    </div> 
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
        var id= $('.id').val();        
        $.ajax({
            url:'<?php echo $this->webroot; ?>Dashboard/addpagemanager',
            type:'post',
            data:'title='+t+'&des='+d+'&id='+id,
            success: function(response) 
            {   
            $('.response').html(response);
            $('.title').val('');
            for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].setData('');
                }
            $('.page').hide();
            }
    });
    });   
});
</script>
 <script>
    $(function(){
        $('.edit').click(function(){
        var edit =$(this).attr("title");
             $.ajax({
        url:'<?php echo $this->webroot?>Dashboard/editpage',
        data:'id='+edit,
        type:'post',
        success:function(resp){
            var sp =resp.split('_');            
            $('.title').val(sp[0]);
            $('.id').val(sp[2]);                                    
            for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].setData(sp[1]);
                }
            $(".page").show();
            }
            });
        });
        $('.del').click(function(){
            var answer = confirm ("Are you sure you want to delete from the database?");
            if (answer)
                {
                    var del =$('.del').attr("title");                                        
                $.ajax({
                url:'<?php echo $this->webroot?>Dashboard/deletepage',
                data:'id='+del,
                type:'post',
                success: function(response) 
                    {
                        $('.response').html(response);
                }                
            });
            }
        });                   
    });
    </script>