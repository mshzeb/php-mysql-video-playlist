<?php

require('./dbconfig.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Video Playlist</title>

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <h3 class="heading">Video Playlist Web App</h3>
    <div style="text-align: center;">
        <form method="POST">
            <select name="filterUser">
                    <option value="0">-- Select User--</option>
                    <?php
                        $getUserQuery = "SELECT user_name FROM tbl_video";
                        $getUserResult = mysqli_query($con, $getUserQuery) or die('Error: Error getting user.');

                        while($row2 = mysqli_fetch_array($getUserResult)) {
                    ?>
                        <option value="<?php echo $row2['user_name']; ?>"><?php echo $row2['user_name']; ?></option>
                    <?php } ?>
            </select>
            
            <select name="filterChoice" id="selDuration">
                <option value="0">-- Select TimeFrame--</option>
                <option value="1">Last 1 Hour</option>
                <option value="2">Last 2 Hour</option>
                <option value="3">This Day</option>
                <option value="4">This Week</option>
                <option value="5">Last 14 Days</option>
                <option value="6">This Month</option>
                
            </select>
            <input type="submit" name="submit" value="Get Data" />
        </form>
    </div>

    <div class="container">
        <div class="video-list" style="text-align: center;" id="mVidList">
           
        <!-- (B) VIDEO GALLERY -->
        <!-- <div class="gallery"> -->
            <?php

                $getAllVids_query = "SELECT * FROM tbl_video";
                //$query = mysqli_query($con, $getAllVids_query);
                global $query, $sql1;
                $query = mysqli_query($con, $getAllVids_query);
                
                // (B1) GET VIDEO FILES FROM GALLERY FOLDER
                //$dir = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
                //$vid = glob("$dir*.{webm,mp4,ogg}", GLOB_BRACE);

                // (B2) OUTPUT VIDEOS
            // if (count($vid) > 0) { ?>

                    
                    <?php

                    //Get the first video from the database.
                    //$row1 = mysqli_fetch_assoc($query);
                    //$firstRow = $row1;
                    //echo $firstRow['name'];

                        // Seek to First row in the database before looping through the video files
                    //mysqli_data_seek($query, 0);

                    // Important Query
                    // SELECT * FROM `tbl_video` WHERE `date_created` < date_sub(now(), INTERVAL 1 HOUR)
                    // SELECT * FROM `tbl_video` WHERE `date_created` > now() - INTERVAL 1 HOUR;
                    // SELECT * FROM `tbl_video` WHERE `date_created` > DATE_SUB(NOW(), INTERVAL 12 HOUR) ORDER BY DAY(`date_created`);
                    // Src: https://www.w3schools.com/sql/func_mysql_date_sub.asp 

// *******************************************************

// The most important link
// Developing the functionality of filter record based on dates using PHP Part 5
// By How to Make Tut's <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// Src: https://www.youtube.com/watch?v=65dZ_rlLk1c

                    if(!isset($_POST['filterChoice'])) {
                        //$mainQuery = "SELECT * FROM tbl_video";
                        //getData($mainQuery);
                        //getData($query);
                        //echo "<script>alert('No Data Selected')</script>";
                        $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(CURDATE(), INTERVAL 1 HOUR)";

                        getData($sql1);
                        //getUser($getUserQuery);
                    } else {
                        switch($_POST['filterChoice']) {
                            case "1":
                                //Last 1 hour
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 HOUR)";
                                getData($sql1);
                                break;
                            case "2":
                                //Last 2 hours
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 2 HOUR)";
                                getData($sql1);
                                break;
                            case "3":
                                //Last 1 day
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 DAY)";
                                getData($sql1);
                                break;
                            case "4":
                                //Last 7 days
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
                                getData($sql1);
                                break;
                            case "5":
                                //Last 14 days
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 2 WEEK)";
                                getData($sql1);
                                break;
                            case "6":
                                //Last 30 days
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
                                getData($sql1);
                                break;
                            default:
                                // Show last 1 hour data
                                $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 HOUR)";
                                getData($sql1);
                        }

                    }
                ?>
<?php
// *******************************************************

            function getData($sql) {
                // // Create Connection
                // $con = mysqli_connect("localhost", "root", "", "dbnskhost");

                // // Check connection
                // if(!$con) {
                //     die("Connection Failed" . mysqli_connect_error());
                // }
                // //echo "Connected Successfully";

                require('./dbconfig.php');

                //$sql = "";
                //echo "SQL: "+$sql;
                $data = mysqli_query($con, $sql) or die('error');
                if(mysqli_num_rows($data) > 0) {
                                    

// *******************************************************
                //while($row = mysqli_fetch_array($query)) {
                while($row = mysqli_fetch_array($data)) {
                    $vidName = basename($row['name']);
                    $caption = substr($vidName, 0, strrpos($vidName, "."));
                    //echo $caption;
                    //echo "<script>alert('vid name'".$row[0]['name'].")</script>";
                ?>

                    <!-- Load videos based on query on line 84 on page load -->
                    <div class="vid" id="vidlist"> 
                        <!-- <div> <?php //echo 'User: '.$row["user_name"]; ?> </div> -->
                        <video src="<?php echo 'uploads/'.$row["name"]; ?>"></video>
                        <div class="title"><?php echo $caption; ?></div>
                    </div>

        <?php  } ?>

            <?php 
            } else echo "<script>alert('No Rows Found')</script>";
            
        } ?>
        </div>
                    <?php
                        /*} else {
                            echo "No Video Files Found.";
                        }*/
                    ?>


        <!-- </div> -->
        <!-- (B) VIDEO GALLERY ENDS -->


        <!--
        <div class="video-list">
            <div class="vid active">
                <video src="uploads/vid1.mp4" muted></video>
                <h3 class="title">1 Video Title Goes Here</h3>
            </div>
            <div class="vid">
                <video src="uploads/vid2.mp4" muted></video>
                <h3 class="title">2 Video Title Goes Here</h3>
            </div>
            <div class="vid">
                <video src="uploads/vid3.mp4" muted></video>
                <h3 class="title">3 Video Title Goes Here</h3>
            </div>
            <div class="vid">
                <video src="uploads/vid4.mp4" muted></video>
                <h3 class="title">4 Video Title Goes Here</h3>
            </div>
        </div>
        -->

        <?php

            $getAllVids_query1 = "SELECT * FROM tbl_video";
            $query1 = mysqli_query($con, $getAllVids_query1);

            $row1 = mysqli_fetch_assoc($query1);
            $firstRow = $row1;
            //echo $firstRow['name'];
        ?>

        <div class="main-video">
            <div class="video">
                <video src="<?php echo 'uploads/' .$firstRow['name']; ?>" controls muted></video><!-- autoplay -->
                <h3 class="title"><?php echo $firstRow['name']; ?></h3>
            </div>
        </div>

        
    </div>

<script>

    $(document).ready(function(){

        // $(".vid").click(function() {
        //     //$(this).addClass("active");
        //     $(this).classList.add("active");

        //     $(".vid").not(this).removeClass("active");
        // });

        $(document).on("click","div.video-list .vid",function(){
            $(this).addClass('active');
            $("div.video-list .vid").not(this).removeClass("active");
        });

        // let listVideo = document.querySelectorAll('.video-list .vid');
        // //let listVideo = document.querySelectorAll('.container .video-list .vid');
        // let mainVideo = document.querySelector('.main-video video');
        // let title = document.querySelector('.main-video .title');

        // //console.log(listVideo);

        // listVideo.forEach(video => {
        //     video.onclick = () => {
        //         listVideo.forEach(vid => vid.classList.remove('active'));
        //         video.classList.add('active');
        //         if(video.classList.contains('active')) {
        //             let src = video.children[0].getAttribute('src');
        //             mainVideo.src = src;
        //             let text = video.children[1].innerHTML;
        //             title.innerHTML = text;
        //         };
        //     };
        // });

        // // Get all video elements
        // var container = document.getElementById("mVidList");
        // //console.log(container);

        // // Get all video inside video-list class
        // var vid = container.getElementsByClassName("vid");

        // // Loop through the vid elements and add the active class to the current/clicked vid element
        // for(var i = 0; i < vid.length; i++) {
        //     vid[i].addEventListener("click", function(){
        //         var current = document.getElementsByClassName("active");

        //         current[0].className = current[0].className.replace(" active", "");
        //         this.className += " active";

        //         // If there is no active class
        //         // if(current.length > 0) {
        //         //     current[0].className = current[0].className.replace(" active", "");
        //         // }

        //         // Add the active class to the current/clicked button
        //         //this.className += " active";
        //     });
        // }
        
            // $.ajax({
            //     url: "fetch.php",
            //     beforeSend: function() {
            //         $(".video-list").html("<span>Working...</span>");
            //     },
            //     success: function(data) {
            //         $(".video-list").html(data);
            //     }
            //     // success: function(data) {
            //     //     console.log(data);
            //     // }
            // });
        });

</script>
</body>
</html>

