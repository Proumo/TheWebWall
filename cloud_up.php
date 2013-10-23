<?php

    require 'cloudinary/Cloudinary.php';
    require 'cloudinary/Uploader.php';
    require 'cloudinary/Api.php';
    
    \Cloudinary::config(array( 
        "cloud_name" => "hef3kau58", 
        "api_key" => "958848766151393", 
        "api_secret" => "qEYfa-0sB0M4Gwn2KxxxNewImUM" 
    ));
    
    $ref_img_up = \Cloudinary\Uploader::upload("/images/posts/261374180701.jpg");
    
    var_dump($ref_img_up);

?>
