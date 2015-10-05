<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable td { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
 
  
  </style>
  <script>
  $(function() {
    $( "#sortable tbody" ).sortable();
    $( "#sortable " ).disableSelection();
  });
  </script>
</head>
<div>
    <h1>Catagory</h1>
    <div>
       <div><button >Add Category</button></div>
       <div class="cat" style="display: none;" >
       <form action="<?php echo $this->webroot; ?>Dashboard/addcategory" method="post">
       <input type="text" placeholder="title" name="title"  />
       <input type="submit" value="submit"/>
       </form>
       </div>
       <div>
           <table id="sortable"  >
            <tr><th>Id</th><th>Title</th><th>Action</th></tr>
            <?php foreach($cat as $cat) 
            {
                ?><tr>
                <td ><?php echo $cat['Categorymanager']['id'];?>
                <td><?php echo $cat['Categorymanager']['title'];?></td>
                <td><a class="edit" href="javascript:void(0);">Edit</a>
                <div class="ed" style="display: none;">
                <form action="<?php echo $this->webroot; ?>Dashboard/addcategory/<?php echo $cat['Categorymanager']['id']; ?>" method="post">
                <input type="text" placeholder="title" name="title"  />
                <input type="submit" value="submit"/>
                </form>
                </div>
                </td>
                <td><a href="<?php echo $this->webroot; ?>Dashboard/del/<?php echo $cat['Categorymanager']['id']; ?>">Delete</a></tr>
                <?php              
            }
            ?>
       
           </table>
       </div>
    </div>   
</div>
<script>
$(function(){
    $("button").click(function(){
        $(".cat").toggle();
    });
    
    $(".edit").click(function(){
    //$(".ed").closest("tr").show();
    $(this).parent().find(".ed").toggle('slow');
    });  
    
   
});

</script>
 

