<?php
/**
 * File: weeklyRmail.php
 * @author Khan Ly <khantly@yahoo.com>
 * @copyright (c) 2015 Khan Ly. All rights reserved.
 */
include("header.php");
include("config.php");
?>

	
<h4>Weekly Email</h4>

<?php
	$sql = "SELECT * from users";
	$result = $conn->query($sql);

        if ($result->num_rows > 0) {
           // output data of each row
           while($row = $result->fetch_assoc()) {

           if (!filter_var($row['email'], FILTER_VALIDATE_EMAIL)) continue;

                        //$row = $result->fetch_assoc();
                        $to = $row['email'];
                        $subject = "Weekly Email!";
         
                        $sql2 = "SELECT DISTINCT *  FROM course_data LEFT JOIN coursedetails ON course_data.id=coursedetails.course_id GROUP BY title ORDER BY start_date LIMIT 10";
                        $result2 = $conn->query($sql2);

                        $message .= "Hello " . $row['firstname'] . " " . $row['lastname'] . ", \r\n\r\n";

                        $message .= "Latest Courses: \r\n\r\n";
                        
                        

                        if ($result2->num_rows > 0) {
                        // output data of each row
                           while($row2 = $result2->fetch_assoc()) {
                               $message .= "\r\n --------------------- \r\n";
                               $message .= "Course Name: ";
                               $message .= ($row2['title'] != NULL) ? $row2['title'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Description: ";
                               $message .= ($row2['long_desc'] != NULL) ? $row2['long_desc'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Video Link: ";
                               $message .= ($row2['video_link'] != NULL) ? $row2['video_link'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Course Link: ";
                               $message .= ($row2['course_link'] != NULL) ? $row2['course_link'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Category: ";
                               $message .= ($row2['category'] != NULL) ? $row2['category'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Start Date: ";
                               $message .= ($row2['start_date'] != NULL) ? $row2['start_date'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Duration: ";
                               $message .= ($row2['course_length'] != NULL) ? $row2['course_length'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Instructor: ";
                               $message .= ($row2['profname'] != NULL) ? $row2['profname'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Instructor Image: ";
                               $message .= ($row2['profimage'] != NULL) ? $row2['profimage'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Course Image: ";
                               $message .= ($row2['course_image'] != NULL) ? $row2['course_image'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Site: ";
                               $message .= ($row2['site'] != NULL) ? $row2['site'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Course Fee: ";
                               $message .= ($row2['course_fee'] != NULL) ? $row2['course_fee'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "Language: ";
                               $message .= ($row2['language'] != NULL) ? $row2['language'] : 'N/A';
                               $message .= " \r\n";
                               $message .= "University: ";
                               $message .= ($row2['university'] != NULL) ? $row2['university'] : 'N/A';
                               $message .= "\r\n --------------------- \r\n";
                           }
                        }

         
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
         
                        mail($to,$subject,$message,$header);
                        $message = "";
       	   }
                        echo "Weekly Email Sent!";
        }
?>

<?php
include("footer.php");
?>		