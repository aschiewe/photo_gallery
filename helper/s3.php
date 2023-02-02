<?php
/**
 * User: Alexander Schiewe
 * Date: 23.08.18
 */
require "../../lib/composer/vendor/autoload.php";
use Aws\S3\S3Client;
$s3 = new Aws\S3\S3Client([
    "profile" => "default",
    "version" => "latest",
    "region" => "eu-central-1"
]);

$bucket_name = "fotos.schiewe-mail";


function getAllImagesInFolder($folder_name) {
    global $bucket_name;
    global $s3;
    try {
        $result = $s3->listObjectsV2([
            "Bucket" => $bucket_name,
            "Prefix" => $folder_name,
        ]);
    } catch (\Aws\S3\Exception\S3Exception $e) {
        echo $e->getMessage();
    } catch (\Aws\Exception\AwsException $e) {
        echo $e->getAwsRequestId() . "\n";
        echo $e->getAwsErrorType() . "\n";
        echo $e->getAwsErrorCode() . "\n";
    } catch (Exception $e) {
        echo $e;
    }
    $return_value = array();
    foreach($result->get("Contents") as $image) {
        if ($image["Size"] == 0) {
            continue;
        }
        $return_value[] = $image["Key"];
    }
    return $return_value;
}

function getPublicLinkForKey($key) {
    global $bucket_name;
    global $s3;
    try {
        $cmd = $s3->getCommand("GetObject", [
            "Bucket" => $bucket_name,
            "Key" => $key,
        ]);
        $request = $s3->createPresignedRequest($cmd, "+20 minutes");
        $presignedUrl = (string) $request->getUri();
    } catch (\Aws\S3\Exception\S3Exception $e) {
        echo $e->getMessage();
    } catch (\Aws\Exception\AwsException $e) {
        echo $e->getMessage();
    }
    return $presignedUrl;
}