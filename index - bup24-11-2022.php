<?php

// Create Connection
$con = mysqli_connect("localhost", "root", "", "dbnskhost");

// Check connection
if(!$con) {
    die("Connection Falied" . mysqli_connect_error());
}
//echo "Connected Successfully";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Video Playlist</title>

    <!-- Custom CSS File -->
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <h3 class="heading">Video Playlist Web App</h3>
    <div class="container">

        <!-- (B) VIDEO GALLERY -->
        <!-- <div class="gallery"> -->
            <?php

                $getAllVids_query = "SELECT * FROM tbl_video";
                $query = mysqli_query($con, $getAllVids_query);
                
                // (B1) GET VIDEO FILES FROM GALLERY FOLDER
                $dir = __DIR__ . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
                $vid = glob("$dir*.{webm,mp4,ogg}", GLOB_BRACE);

                // (B2) OUTPUT VIDEOS
                if (count($vid) > 0) {
                    
                    while($row = mysqli_fetch_array($query)) {
                        $vidName = $row['name'];
                        echo $vidName;

                    }
                    
                    foreach ($vid as $v) {
                        $file = basename($v);
                        $caption = substr($file, 0, strrpos($file, "."));
                        printf("<div class='video-list'>
                                    <div class='vid'>
                                        <video src='uploads/%s'></video>
                                        <div class='title'>%s</div>
                                    </div>
                                <div>", rawurlencode($file), $caption);
                    }
                } else {
                    echo "No Video Files Found.";
                }
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

        <div class="main-video">
            <div class="video">
                <video src="uploads/vid1.mp4" controls muted autoplay></video>
                <h3 class="title">1 Video Title Goes Here</h3>
            </div>
        </div>

        
    </div>

<script>
    let listVideo = document.querySelectorAll('.video-list .vid');
    let mainVideo = document.querySelector('.main-video video');
    let title = document.querySelector('.main-video .title');

    listVideo.forEach(video => {
        video.onclick = () => {
            listVideo.forEach(vid => vid.classList.remove('active'));
            video.classList.add('active');
            if(video.classList.contains('active')) {
                let src = video.children[0].getAttribute('src');
                mainVideo.src = src;
                let text = video.children[1].innerHTML;
                title.innerHTML = text;
            };
        };
    });
</script>
</body>
</html>

