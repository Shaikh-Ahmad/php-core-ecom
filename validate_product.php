<?php
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imagePath = '';
    
    if(!$title){
        $errors[] = 'Product title is required';
    }
    if(!$price){
        $errors[] = 'Product price is required';
    }
    if(!is_dir(__DIR__.'/public/images')){
        mkdir(__DIR__.'/public/images');
    }
    //this if statment will check if the error array is empty then execute and will store the values entered in Database
    //in simple validation
    if(empty ($errors) ){

        //uploading image
    
        $image = $_FILES['image'] ?? null;
        $imagePath = $product['image'];


        if ($image && $image['tmp_name']) {

            //if selected new img remove/delete previous image
            if($product['image']){
                unlink(__DIR__.'/public/'.$product['image']);
            }

            $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname(__DIR__.'/public/'.$imagePath));
            move_uploaded_file($image['tmp_name'], __DIR__.'/public/'.$imagePath);
        }
        
       
    }