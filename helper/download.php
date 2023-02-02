<?php
function zipFiles($file_names, $archive_file_name, $file_path){
    $zip = new ZipArchive();
    if($zip->open($archive_file_name, ZIPARCHIVE::CREATE) !== true) {
        exit("cannot open <$archive_file_name>\n");
    }
    foreach ($file_names as $file) {
        #echo "Adding " . $file_path. "/" . $file . " as " . $file . PHP_EOL;
        $zip->addFile($file_path. "/" . $file, $file);
    }
    $zip->close();
}