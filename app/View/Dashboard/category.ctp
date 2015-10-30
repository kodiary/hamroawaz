<head>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#sor tbody" ).sortable(
    {

    cursor: 'move',
    stop:function(i) {

        $.ajax({
            type: "post",
            url: "<?php echo $this->webroot; ?>Dashboard/order",
            data: $("#sor tbody .ids").serialize(),
                         
        });
    }
    });
    $( "#sor " ).disableSelection();
  });
  </script>
  
  
</head>
<div>
    <h1>Catagory</h1>
    <div>
       <div><button >Add Category</button></div>
       <div class="cat" style="display: none;" >
       <form action="<?php echo $this->webroot; ?>Dashboard/addcategory" method="post">
       <input type="text" placeholder="title" class="titlename" name="title"  />
       <input type="text" class="slug" name="slug" />
       <input type="submit" value="submit"/>
       </form>
       </div>
       <div >
           <table id="sor" >
            <thead><tr><th>Id</th><th>Title</th><th>Action</th></tr></thead>
            <tbody>
            <?php foreach($cat as $cat) 
            {
                ?>
                <tr>
                <td><?php echo $cat['Categorymanager']['id'];?><input class="ids" name="id[]" type="hidden" value="<?php echo $cat['Categorymanager']['id'];?>" /></td>
                <td><?php echo $cat['Categorymanager']['title'];?></td>
                <td>
                <a class="edit" href="javascript:void(0);" title="<?php echo $cat['Categorymanager']['title'];?>" id="<?php echo $cat['Categorymanager']['id'];?>">Edit</a>
                <a href="<?php echo $this->webroot; ?>Dashboard/del/<?php echo $cat['Categorymanager']['id']; ?>">Delete</a></td></tr>
                <?php              
            }
            ?>
            </tbody>
           </table>
       </div>
       <div class="ed" style="display: none;">
                    <form action="" id="form1" method="post">
                    <input type="text" placeholder="" name="title" class="titlename" id='title1' />
                    <input type="text" class="slug" name="slug" id="slug"/>
                    <input type="submit" value="submit"/>
                    </form>
                     </div>
    </div>   
</div>
<script>
$(function(){
    $("button").click(function(){
        $(".cat").toggle();
    });
    
    $(".edit").click(function(){
    var t =$(this).attr('title');
    var id =$(this).attr('id');
    $(".ed").toggle('slow');
    $('#title1').val(t);
    $('#form1').attr('action','<?php echo $this->webroot; ?>Dashboard/addcategory/'+id);
    
    
    //$(this).parent().find(".ed").toggle('slow');
    });  
    
    $('.titlename').change(function(){
   var title= $(".titlename").val();
   alert(title);
      $.ajax({
          url: "<?php echo $this->webroot; ?>Dashboard/getSlug",
            data: "title="+title,
            type: "post",
            success: function(response){
             $('.slug').val(response);
            }
                         
        });
   
})
    
   
});

</script>
 

