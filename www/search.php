<?php
/**
 * File: view.php
 * @author Khan Ly <khantly@yahoo.com>
 * @copyright (c) 2015 Khan Ly. All rights reserved.
 */
//$q = "INSERT INTO course_data2 (id, title, short_desc, long_desc, course_link, video_link, start_date, course_length, course_image, category, site, course_fee, language, certificate, university, time_scraped) VALUES ( " . $row['id'] . ",  " . $row['title'] . ",  " . $row['short_desc'] . ",  " . $row['long_desc'] . ",  " . $row['course_link'] . ",  " . $row['video_link'] . ",  " . $row['start_date'] . ",  " . $row['course_length'] . ",  " . $row['course_image'] . ",  " . $row['category'] . ",  " . $row['site'] . ",  " . $row['course_fee'] . ",  " . $row['language'] . ",  " . $row['certificate'] . ",  " . $row['university'] . ",  " . $row['time_scraped'] . ")";

include("header.php");
include("config.php");

include('/home2/youthcyb/public_html/sjsucs/cs160/sec4group3/vendor/rmccue/requests/library/Requests.php');

$courses_per_page = 10;
$page = $_GET['page'];
$sort = $_GET['sort'];
$scend = $_GET['scend'];
if($page == NULL) $page = 1;
if($sort == NULL) $sort = id;
if($scend == NULL) $scend = "asc";

$blank = "N/A";
$free = "Free!";
$selfpaced = "Self-Paced";
$startdate0000 = "Archived";
?>

<div class="table-responsive">
<br />
    <script type="text/javascript">
     var urldatacolumn = document.getElementById( 'datacolumn' );
     var urlascdesc = document.getElementById( 'ascdesc' );
     urldatacolumn.onchange = function() {
          window.open( this.options[ this.selectedIndex ].value, '_self');
     };
     urlascdesc.onchange = function() {
          window.open( this.options[ this.selectedIndex ].value, '_self');
     };
    </script>
  <table class="table table-striped table-hover">
<tr>
  <th class="info">Image</th>
  <th class="info">Course Name</th>
  <th class="info">Category</th>
  <th class="info">Start Date</th>
  <th class="info">Course Length<br />(weeks)</th>
  <th class="info">Professor</th>
  <th class="info">Professor Image</th>
  <th class="info">Site</th>
</tr>

<?php

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $courses_per_page; 

$q = $_GET["q"];
$column = $_GET["column"];
$order = $_GET["order"];

$price = $_GET["price"];
$pricelow = $_GET["pricelow"];
$pricehigh = $_GET["pricehigh"];

if($price == "yes" AND $pricelow != "" AND $pricehigh != ""){
   $pricesql = " AND course_fee BETWEEN {$pricelow} AND {$pricehigh}";
} else {
   $pricesql = "";
}

if($clength == "yes" AND $clengthlow != "" AND $clengthhigh != ""){
   $clengthsql = " AND course_length BETWEEN {$clengthlow} AND {$clengthhigh}";
} else {
   $clengthsql = "";
}



if ($_GET["type"] == "all"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where profname like '%$q%' or title like '%$q%' or long_desc like '%$q%'
				or category like '%$q%' or site like '%$q%' or university like '%$q%' 
				or language like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "title"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where title like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "long_desc"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where long_desc like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "profname"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where profname like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "category"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where category like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "site"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where site like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "language"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where language like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}
elseif ($_GET["type"] == "university"){
                         $sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id 
				where university like '%$q%' $clengthsql $pricesql GROUP BY title ORDER BY course_data.$column $order";
}


                //$sql = "SELECT DISTINCT *  FROM course_data INNER JOIN coursedetails ON course_data.id=coursedetails.course_id GROUP BY title ORDER BY course_data.$sort $scend LIMIT $start_from, $courses_per_page";
                $result = $conn->query($sql);
if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {

 if(strpos($row['profimage'], ".png")){
    $imgPos = strpos($row['profimage'], ".png") + 4;
 } elseif (strpos($row['profimage'], ".jpg")) {
    $imgPos = strpos($row['profimage'], ".jpg") + 4;
 } elseif (strpos($row['profimage'], ".gif")) {
    $imgPos = strpos($row['profimage'], ".gif") + 4;
 } elseif (strpos($row['profimage'], ".jpeg")) {
    $imgPos = strpos($row['profimage'], ".jpeg") + 5;
 } else {
    $imgPos = strlen($row['profimage']);
 }

 $row['profimage'] = substr($row['profimage'], 0, $imgPos);

 if(str_word_count($row['short_desc']) >= 6){
    $sdCount = 6;
 } elseif (str_word_count($row['short_desc']) == 5){
    $sdCount = 5;
 } elseif (str_word_count($row['short_desc']) == 4){
    $sdCount = 4;
 } elseif (str_word_count($row['short_desc']) >= 3){
    $sdCount = 3;
 } elseif (str_word_count($row['short_desc']) >= 2){
    $sdCount = 2;
 } elseif (str_word_count($row['short_desc']) >= 1){
    $sdCount = 1;
 } else {
    $sdCount = 0;
 }
 
 if (substr($row['category'], -1) == ","){
     $row['category'] = str_replace(substr($row['category'], -1), "", $row['category']);
 }
 if (substr($row['university'], -1) == ","){
     $row['university'] = str_replace(substr($row['university'], -1), "", $row['university']);
 }
?>


<tr>
  <td><a data-toggle="collapse" href="#courseDetails<?=$row['id'];?>" aria-expanded="false" aria-controls="courseDetails<?=$row['id'];?>"><img src="<?=$row['course_image'];?>" width="100" height="100" onerror="this.src='img/nophoto.png'"></a></td>
  <td><?php echo ($row['title'] != NULL) ? '<a data-toggle="collapse" href="#courseDetails' . $row['id'] . '" aria-expanded="false" aria-controls="courseDetails' . $row['id'] . '">' . $row['title'] . '</a>' : $blank; ?></td>
  <td><?php echo ($row['category'] != NULL) ? $row['category'] : $blank; ?></td>
  <td>
       <?php 
        if($row['start_date'] != NULL) {
           
           $row['start_date'] = "" . $row['start_date'];
           if ($row['start_date'] == "0000-00-00") {
              echo $startdate0000; 
           } else {
              echo $row['start_date']; 
           }
          


        } else {
           echo $blank; 
        }
       ?>
  </td>
  <td><?php echo ($row['course_length'] != 0) ? $row['course_length'] : $selfpaced; ?></td>
  <td><?php echo ($row['profname'] != NULL) ? $row['profname'] : $blank; ?></td>
  <td><a data-toggle="collapse" href="#courseDetails<?=$row['id'];?>" aria-expanded="false" aria-controls="courseDetails<?=$row['id'];?>"><img src="<?=$row['profimage'];?>" alt="<?=$row['profname'];?>" width="100" height="100" onerror="this.src='img/nophoto.png'"></a></td>
  <td><?php echo ($row['site'] != NULL) ? '<a href="' . $row['course_link'] . '">' .$row['site'] . '</a>' : $blank; ?></td>
</tr>

<tr class="collapse" id="courseDetails<?=$row['id'];?>">
  <td class="" colspan="8">
<!------>
<table class="table table-striped">
<tr>
  <td class="success" colspan="2"><img src="<?=$row['course_image'];?>" class="img-thumbnail" width="100%" onerror="this.src='img/nophoto.png'"></td>
</tr>
<tr>
  <td class="success">Course ID: </td>
  <td class="success">#<?php echo ($row['course_id'] != NULL) ? $row['course_id'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Professor Name: </td>
  <td class="success"><?php echo ($row['profname'] != NULL) ? $row['profname'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Professor Image: </td>
  <td class="success"><img src="<?=$row['profimage'];?>" alt="<?=$row['profname'];?>" class="img-circle" width="50%" onerror="this.src='img/nophoto.png'"></td>
</tr>
<tr>
  <td class="success">Title: </td>
  <td class="success"><?php echo ($row['title'] != NULL) ? $row['title'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Short Description: </td>
  <td class="success"><?php echo ($row['short_desc'] != NULL) ? implode(' ', array_slice(explode(' ', $row['short_desc']), 0, $sdCount)) . '...' : $blank; ?></td>
</tr>
<tr>
  <td class="success">Long Description: </td>
  <td class="success"><?php echo ($row['long_desc'] != NULL) ? $row['long_desc'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Course Link: </td>
  <td class="success"><?php echo ($row['course_link'] != NULL) ? '<a href="' . $row['course_link'] . '">' .$row['course_link'] . '</a>' : $blank; ?></td>
</tr>
<tr>
  <td class="success">Video Link: </td>
  <td class="success"><?php echo ($row['video_link'] != NULL) ? '<a href="' . $row['video_link'] . '">' .$row['video_link'] . '</a>' : $blank; ?></td>
</tr>
<tr>
  <td class="success">Start Date: </td>
  <td class="success">
       <?php 
        if($row['start_date'] != NULL) {
           
           $row['start_date'] = "" . $row['start_date'];
           if ($row['start_date'] == "0000-00-00") {
              echo $startdate0000; 
           } else {
              echo $row['start_date']; 
           }
          


        } else {
           echo $blank; 
        }
       ?>
  </td>
</tr>
<tr>
  <td class="success">Course Length: <br />(weeks)</td>
  <td class="success"><?php echo ($row['course_length'] != 0) ? $row['course_length'] : $selfpaced; ?></td>
</tr>
<tr>
  <td class="success">Category: </td>
  <td class="success"><?php echo ($row['category'] != NULL) ? $row['category'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Site: </td>
  <td class="success"><?php echo ($row['site'] != NULL) ? '<a href="' . $row['course_link'] . '">' .$row['site'] . '</a>' : $blank; ?></td>
</tr>
<tr>
  <td class="success">Course Fee: </td>
  <td class="success"><?php echo ($row['course_fee'] != 0) ? $row['course_fee'] : $free; ?></td>
</tr>
<tr>
  <td class="success">Language: </td>
  <td class="success"><?php echo ($row['language'] != NULL) ? $row['language'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Certificate: </td>
  <td class="success"><?php echo ($row['certificate'] != NULL) ? $row['certificate'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">University: </td>
  <td class="success"><?php echo ($row['university'] != NULL) ? $row['university'] : $blank; ?></td>
</tr>
<tr>
  <td class="success">Timestamp: </td>
  <td class="success"><?php echo ($row['time_scraped'] != NULL) ? $row['time_scraped'] : $blank; ?></td>
</tr>
<?php
  
  // Make sure Requests can load internal classes
  Requests::register_autoloader();

  $response = Requests::get('https://www.youtube.com/results?search_query='.$row['title']);

  $re = '/watch\?v=(.{11})/';
  $str = $response->body;

  preg_match_all($re, $str, $matches);

  // Get the first three results of the query
  // Each video was duplicated once so to get the next video skip an index
  $first_video = $matches[0][0]; 
  $second_video = $matches[0][4];
  $third_video = $matches[0][6];
  
  $youtube_base = 'https://www.youtube.com/';
  
  // TODO: Will need to figure out a better way to do this
  
  echo '<tr>';
  echo '<td class="success">Related videos: </td>';
  echo '<td class="success">';
  echo '<ul>';
  echo $first_video != NULL ? '<li><a href='.$youtube_base.$first_video.'>'.$youtube_base.$first_video.'</a></li>' : $blank;
  echo $second_video != NULL ? '<li><a href='.$youtube_base.$second_video.'>'.$youtube_base.$second_video.'</a></li>' : $blank;
  echo $third_video != NULL ? '<li><a href='.$youtube_base.$third_video.'>'.$youtube_base.$third_video.'</a></li>' : $blank;
  echo '</ul>';
  echo '</td>';
  echo '</tr>';
  
  //echo $first_video;
  
?>
</table>
<!------>
  </td>
</tr>

<?php
     }
}
?>  
</table>

<?php
$conn->close();
include("footer.php");
?>
