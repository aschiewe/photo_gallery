<?php
error_reporting(-1);
ini_set('display_errors', 'On');
include 'layout/header.html';
include 'layout/navbar.php';
echoPageHeader("Home");
listFolders();
include 'layout/footer.html';

function listFolders(){
    $content_dirs = array_filter(glob('content/[^_]*'), 'is_dir');
    $number_of_dirs = sizeof($content_dirs);
    for($i = 0; $i < $number_of_dirs; $i++) {
        if (!array_key_exists($i, $content_dirs)) {
            continue;
        }
        $folder_path=$content_dirs[$i];
        $folder_name = basename($folder_path);
        include "$folder_path/metadata.php";
        checkPreviewImage($folder_name, $TITLEIMG);
        if($i % 4 == 0){
            echo '<div class="row">';
        }
            echo '<div class="col-md-3 col-xs-3 col-sm-3 col-lg-3">';
            echo '<div class="thumbnail">';
            echo '<a href="' . $content_dirs[$i] . '/index.php">';
            echo '<img src="content/_preview/' . $folder_name . '/' . $TITLEIMG . '" style="width:100%">';
            echo '<div class="caption">';
            echo '<p>' . $TITLE . '</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
        if($i % 4 == 3){
            echo '</div>';
        }
    }
}

function checkPreviewImage($folder_name, $image_name){
    if(!file_exists("content/_preview/" . $folder_name . "/" . $image_name)){
        if(!file_exists("content/_preview/" . $folder_name)){
            if(!file_exists("content/_preview")){
                mkdir("content/_preview");
            }
            mkdir("content/_preview/" . $folder_name);
        }
        copy("content/" . $folder_name . "/" . $image_name, "content/_preview/" . $folder_name . "/" . $image_name);
    }
}

function generateListEntry($folder_path){
    include "$folder_path/metadata.php";
    $folder_name = basename($folder_path);
    checkPreviewImage($folder_name, $TITLEIMG);
    echo "<li><a href='$folder_path/index.php'><img src='content/_preview/$folder_name/$TITLEIMG' width='50' height='50'/>$TITLE</a>";
}