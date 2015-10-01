<div class="loading-div"><img src="loader.gif" ></div>
<div id="results"><!-- content will be loaded here --></div>


<script>
$(document).ready(function() {
    $("#results" ).load( "fetch_pages.php"); //load initial records
    
    //executes code below when user click on pagination links
    $("#results").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".loading-div").show(); //show loading element
        var page = $(this).attr("data-page"); //get page number from link
        $("#results").load("fetch_pages.php",{"page":page}, function(){ //get content from PHP page
            $(".loading-div").hide(); //once done, hide loading element
        });
        
    });
});
</script>
<?php

$db_username        = 'username'; //database username
$db_password        = 'password'; //dataabse password
$db_name            = 'test'; //database name
$db_host            = 'localhost'; //hostname or IP
$item_per_page      = 5; //item to display per page

$mysqli_conn = new mysqli($db_host, $db_username, $db_password,$db_name); //connect to MySql
//Output any connection error
if ($mysqli_conn->connect_error) {
    die('Error : ('. $mysqli_conn->connect_errno .') '. $mysqli_conn->connect_error);
}

//Get page number from Ajax
if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
    $page_number = 1; //if there's no page number, set it to 1
}

//get total number of records from database
$results = $mysqli_conn->query("SELECT COUNT(*) FROM paginate");
$get_total_rows = $results->fetch_row(); //hold total records in variable
//break records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

//Fetch part of records using SQL LIMIT clause
$results = $mysqli_conn->query("SELECT id, name, message FROM paginate ORDER BY id ASC LIMIT $page_position, $item_per_page");

//Display fetched records
echo '<ul class="contents">';
while($row = $results->fetch_assoc()) {
    echo '<li>';
    echo  $row["id"]. '. <strong>' .$row["name"].'</strong> &mdash; '.$row["message"];
    echo '</li>';
}  
echo '</ul>';

echo '<div align="center">';
// To generate links, we call the pagination function here. 
echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
echo '</div>';

?>

<?php

function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}
?>