<?php
function echoPageHeader($activeName){
    include __DIR__ . "/../categories.php";
    echo '<div class="page-header text-center"><h1>Foto Sammel Seite</h1></div>';
    $folderNames = getContentFolders();
    echo '
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/index.php">Foto Sammel Seite</a>
            </div>
            <ul class="nav navbar-nav">
    ';
    echo "<li";
    if($activeName === "Home"){
        echo ' class="active"';
    }
    echo '><a href="/index.php">Home</a></li>' . PHP_EOL;
    foreach ($categories as $category => $subfolders){
        # See if some subside is active
        $active = false;
        foreach($subfolders as $folderName){
            if($activeName == $folderName){
                $active = true;
            }
        }
        echo "<li class=\"dropdown";
        if($active){
            echo ' active';
        }
        echo '">';
        echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">' . $category . '<span class="caret"></span></a>';
        echo '<ul class="dropdown-menu">';
        foreach($subfolders as $foldername){
            include __DIR__ . "/../content/$foldername/metadata.php";
            echo "<li";
            if($activeName === $foldername){
                echo ' class="active"';
            }
            echo '><a href="/content/' . $foldername . '/index.php">' . $TITLE;
            echo '</a></li>' . PHP_EOL;
        }
        echo '</ul>';
        echo "</li>";
    }

    echo '        </ul>
        </div>
    </nav>';
}


function getContentFolders(){
    $content_dirs = array_filter(glob(__DIR__ . '/../content/[^_]*'), 'is_dir');
    $folderNames = array();
    foreach ($content_dirs as $content_dir){
        $folderNames[] = basename($content_dir);
    }
    return $folderNames;
}