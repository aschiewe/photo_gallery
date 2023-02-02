<?php
include "../../layout/header.html";
include "../../lib/Parsedown.php";
include "../../layout/navbar.php";
include "../../helper/s3.php";
echoPageHeader(basename(__DIR__));
echo '<div class="container">';

$Parsedown = new Parsedown();
echo $Parsedown->text(file_get_contents("content.md"));

$folder_name = basename(getcwd());
$images = getAllImagesInFolder($folder_name);
?>

    <div id="myCarousel" class="carousel slide lazy" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            for($i = 0; $i < sizeof($images); $i++) {
                echo '<li data-target="#myCarousel" data-slide-to="' . $i . '"';
                if($i === 0){
                    echo ' class="active"';
                }
                echo '></li>' . PHP_EOL;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            for($i = 0; $i < sizeof($images); $i++) {
                echo '<div class="item';
                if($i === 0){
                    echo " active";
                }
                echo '"><img ';
                if ($i != 0) {
                    echo "data-";
                }
                echo 'src="' . getPublicLinkForKey($images[$i]) . '"></div>' . PHP_EOL;
            }
            ?>
        </div>
        <a href="#myCarousel" class="left carousel-control" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#myCarousel" class="right carousel-control" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php
include "../../layout/footer.html";