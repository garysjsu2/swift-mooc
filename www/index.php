<?php
/**
 * File: index.php
 * @author Khan Ly <khantly@yahoo.com>
 */
include("header.php");
include("config.php");

$blank = "N/A";
?>

<?php
function str_replace_last($string ,$search , $replace){
   if ((($string_len=strlen($string))==0) || (($search_len=strlen($search))==0)) return $string;
   $pos=strrpos($string,$search);
   if ($pos>0) return substr($string,0,$pos).$replace.substr($string,$pos+$search_len,max(0,$string_len-($pos+$search_len)));
   return $string;
}

$sql = "SELECT *  FROM user_profile WHERE userid = '{$_SESSION['id']}'";
$result = $conn->query($sql);
$interests = "";
if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
       $interests .= "title LIKE '%" . $row['interest'] . "%' OR ";
     }
}
$numInterests = $result->num_rows;
echo "<br />";
$interests = str_replace_last($interests, " OR", "");
//echo $interests;
?>


      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>

<!----
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Feature 1 - Search
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Feature 2 - Weekly Email
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Feature 3 - Trending and Sidebar
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
       </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Feature 4 - Course Resources
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
      </div>
    </div>
  </div>
</div>
--->

<?php
// sidebar
if($numInterests > 0){
   $sql = "SELECT DISTINCT *  FROM course_data WHERE $interests GROUP BY title ORDER BY RAND() LIMIT 3";
} else {
   $sql = "SELECT DISTINCT *  FROM course_data GROUP BY title ORDER BY RAND() LIMIT 3";
}
$result = $conn->query($sql);
?>
          <div class="row">

<?php
if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
?>
            <div class="col-xs-6 col-lg-4">
              <img src="<?=$row['course_image'];?>" class="img-thumbnail" width="100%" onerror="this.src='img/nophoto.png'">
              <p><b><?php echo ($row['title'] != NULL) ? $row['title'] : $blank; ?></b><br /><?php echo ($row['short_desc'] != NULL) ? implode(' ', array_slice(explode(' ', $row['short_desc']), 0, $sdCount)) . '...' : $blank; ?></p>
              <p><a class="btn btn-default" href="<?=$row['course_link'];?>" role="button">View details &raquo;</a></p>
            </div><!--/.col-xs-6.col-lg-4-->

<?php } 
}
?>
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->

<?php
// sidebar
if($numInterests > 0){
   $sql = "SELECT DISTINCT *  FROM course_data WHERE $interests GROUP BY title ORDER BY start_date LIMIT 10";
} else {
   $sql = "SELECT DISTINCT *  FROM course_data GROUP BY title ORDER BY start_date LIMIT 10";
}
$result = $conn->query($sql);
?>
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="" class="list-group-item active">Latest Courses</a>

<?php
if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
?>
            <a href="<?=$row['course_link'];?>" class="list-group-item"><?php echo ($row['title'] != NULL) ? $row['title'] : $blank; ?></a>
<?php } 
}
?>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->


<?php
include("footer.php");
?>