<?php
echo "<pre>";
$uploadFolder = __DIR__.'/../public/upload/';
$filePaths = [
    $uploadFolder.'first.txt',
    $uploadFolder.'second.txt'
];

$app = Sergey\Illuminati\IlluminatiServiceProvider::compareFiles($filePaths);

