<?php

require('./dbconfig.php');
date_default_timezone_set("Asia/Karachi");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Video Playlist</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous" />
    
    <!-- Custom CSS File -->
    <link rel="stylesheet" href="css/style.css" />
    
    <script src="js/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
<body>
    <h3 class="heading">Video Playlist Web App</h3>

    <div class="container">

        <div class="form-inline text-center">
        <form method="POST">
            <select name="filterUser" class="form-control" id="fUser">
                    <option value="0">-- Select User--</option>
                    <?php
                        $getUserQuery = "SELECT DISTINCT user_name FROM tbl_video ORDER BY user_name ASC";
                        $getUserResult = mysqli_query($con, $getUserQuery) or die('Error: Error getting user.');

                        while($row2 = mysqli_fetch_array($getUserResult)) {
                    ?>
                        <option value="<?php echo $row2['user_name']; ?>"><?php echo $row2['user_name']; ?></option>
                    <?php } ?>
            </select>
            
            <select name="filterChoice" class="form-control" id="selDuration">
                <option value="0">-- Select TimeFrame--</option>
                <option value="1">Last 1 Hour</option>
                <option value="2">Last 2 Hour</option>
                <option value="3">This Day</option>
                <option value="4">This Week</option>
                <option value="5">Last 14 Days</option>
                <option value="6">This Month</option>
                
            </select>
            <input type="submit" name="submit" class="btn btn-primary" value="Get Data" />
        </form>
    </div>


        <div class="video-list" style="text-align: center;" id="mVidList">
           
        <!-- (B) VIDEO GALLERY -->
        <!-- <div class="gallery"> -->
            <?php

                $getAllVids_query = "SELECT * FROM tbl_video";
                //$query = mysqli_query($con, $getAllVids_query);
                global $query, $sql1;
                $query = mysqli_query($con, $getAllVids_query);
                

            ?>

                    
                    <?php

// *******************************************************

                    // The following if code loads whenever the user refresh or load the page for the first time.
                    if(!isset($_POST['filterChoice'])) {
                        //$mainQuery = "SELECT * FROM tbl_video";
                        //getData($mainQuery);
                        //getData($query);
                        //echo "<script>alert('No Data Selected')</script>";
                    //    $sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(CURDATE(), INTERVAL 1 HOUR)";
                    //    getData($sql1);
                        //getUser($getUserQuery);
                    } else {
                            switch($_POST['filterChoice']) {
                                case "1":
                                    //Last 1 hour

                                    //date_default_timezone_set("Asia/Karachi");
                                    $to_time = date("Y-m-d H-i-s");
                                    $from_time = date("Y-m-d H-i-s", strtotime('-1 hour'));

                                    $sql1 = "SELECT * FROM tbl_video WHERE (name BETWEEN '$from_time' AND '$to_time') AND user_name='$_POST[filterUser]' ";
                                    //echo $sql1;
                                    getData($sql1);
                                    break;
                                case "2":
                                    //Last 2 hours
                                    
                                    $to_time = date("Y-m-d H-i-s");
                                    $from_time = date("Y-m-d H-i-s", strtotime('-2 hour'));

                                    $sql1 = "SELECT * FROM tbl_video WHERE (name BETWEEN '$from_time' AND '$to_time') AND user_name='$_POST[filterUser]' ";
                                    //echo '<br />' .$sql1;
                                    getData($sql1);
                                    break;
                                case "3":
                                    //Last 1 day

                                    $to_time = date("Y-m-d H-i-s");
                                    $from_time = date("Y-m-d H-i-s", strtotime('-1 day'));

                                    $sql1 = "SELECT * FROM tbl_video WHERE (name BETWEEN '$from_time' AND '$to_time') AND user_name='$_POST[filterUser]' ";
                                    getData($sql1);
                                    break;
                                case "4":
                                    //Last 7 days

                                    $to_time = date("Y-m-d H-i-s");
                                    $from_time = date("Y-m-d H-i-s", strtotime('-7 day'));

                                    $sql1 = "SELECT * FROM tbl_video WHERE (name BETWEEN '$from_time' AND '$to_time') AND user_name='$_POST[filterUser]' ";
                                    getData($sql1);
                                    break;
                                case "5":
                                    //Last 14 days

                                    $to_time = date("Y-m-d H-i-s");
                                    $from_time = date("Y-m-d H-i-s", strtotime('-14 day'));

                                    $sql1 = "SELECT * FROM tbl_video WHERE (name BETWEEN '$from_time' AND '$to_time') AND user_name='$_POST[filterUser]' ";
                                    getData($sql1);
                                    break;
                                case "6":
                                    //Last 30 days

                                    $to_time = date("Y-m-d H-i-s");
                                    $from_time = date("Y-m-d H-i-s", strtotime('-1 month'));

                                    $sql1 = "SELECT * FROM tbl_video WHERE (name BETWEEN '$from_time' AND '$to_time') AND user_name='$_POST[filterUser]' ";
                                    getData($sql1);
                                    break;
                                default:
                                    // Show last 1 hour data
                                    echo "<script>alert('Please Select TimeFrame')</script>";
                                    //$sql1 = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 HOUR)";
                                    //getData($sql1);
                            }
                        }
                ?>
<?php
// *******************************************************
            function getData($sql) {

                require('./dbconfig.php');

                $data = mysqli_query($con, $sql) or die('error: ' . mysqli_error($con));
                if(mysqli_num_rows($data) > 0) {                            

// *******************************************************
                while($row = mysqli_fetch_array($data)) {
                    $vidName = basename($row['name']);
                    $caption = substr($vidName, 0, strrpos($vidName, "."));
?>

                    <!-- Load videos based on query on line 84 on page load -->
                    <div class="vid" id="vidlist"> 
                        <video src="<?php echo 'uploads/'.$row["name"]; ?>"></video>
                        <div class="title"><?php echo $caption; ?></div>
                    </div>

        <?php  } ?>

            <?php 
            } else echo "<script>alert('No Rows Found')</script>";
            
        } ?>
        </div>

        <?php

            //EXTRA CODE
            $getAllVids_query1 = "SELECT * FROM tbl_video";
            $query1 = mysqli_query($con, $getAllVids_query1);

            $row1 = mysqli_fetch_assoc($query1);
            $firstRow = $row1;
        ?>

        <div class="main-video">
            <div class="video">
                <video src="<?php echo 'uploads/' .$firstRow['name']; ?>" controls muted autoplay></video><!-- autoplay -->
                <h3 class="title"><?php echo $firstRow['name']; ?></h3>
            </div>
        </div>

        
    </div>

<script>

$(document).ready(function(){

    $(document).on("click","div.video-list .vid",function(){
        $(this).addClass('active');
        $("div.video-list .vid").not(this).removeClass("active");

        let mainVideo = document.querySelector('.main-video video');
        let listVideo = document.querySelectorAll('.video-list .vid');
        let title = document.querySelector('.main-video .title');

        listVideo.forEach(video => {
            if(video.classList.contains('active')) {
                let src = video.children[0].getAttribute('src');
                mainVideo.src = src;
                let text = video.children[1].innerHTML;
                title.innerHTML = text;
            };
        });
    });

    document.getElementById('fUser').value = "<?php echo $_POST['filterUser']; ?>";
    document.getElementById('selDuration').value = "<?php echo $_POST['filterChoice']; ?>";
    
});

</script>
</body>
</html>

