<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
if(!empty($_FILES)){ 
    // File path configuration 
    $uploadDir = "upload/images/"; 
    $fileName = time().'_'.basename($_FILES['file']['name']); 
    $uploadFilePath = $uploadDir.$fileName; 
     
    // Upload file to server 
    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)){ 
        // Insert file information in the database 
        //$insert = $db->query("INSERT INTO files (file_name, uploaded_on) VALUES ('".$fileName."', NOW())"); 
      $base_url = "upload/images/";
      $file_link = $base_url.$fileName;
      die(json_encode(array("error"=>false,"status"=>"200","message"=>"File upload successful","file_path"=>$file_link)));
    } else{
        die(json_encode(array("error"=>true,"status"=>"400","message"=>"File not uploaded")));
    }
} 
?>