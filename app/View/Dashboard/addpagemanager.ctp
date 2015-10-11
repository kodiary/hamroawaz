<table class="response">
    <thead><th>Id</th><th>Title</th><th>Description</th><th>Action</th></thead>
    <?php
    foreach($q as $d)
    {
        ?>
        <tr><td><?php echo $d['Pagemanager']['id'];?></td><td><?php echo $d['Pagemanager']['title'];?></td><td><?php echo $d['Pagemanager']['description'];?></td><td><a href="javascript:void(0)" title="<?php echo $d['Pagemanager']['id'];?>" class="edit">Edit</a><a href="javascript:void(0)" title="<?php echo $d['Pagemanager']['id'];?>" class="del" >Delete</a></td></tr>
        <?php
    }
    ?>
    </table>
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
    
   