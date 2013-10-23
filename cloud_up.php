<?php

    require 'cloudinary/Cloudinary.php';
    require 'cloudinary/Uploader.php';
    require 'cloudinary/Api.php';
    
    \Cloudinary::config(array( 
        "cloud_name" => "hxasx9ldn", 
        "api_key" => "893558381195987", 
        "api_secret" => "5O80V2hJMzCFodM9-utRc1KgJ4Y" 
    ));
    
    $ref_img_up = \Cloudinary\Uploader::upload("images/posts/261374180701.jpg");
    
    var_dump($ref_img_up);

?>
