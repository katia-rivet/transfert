<?php
/* **************************************************
Upload de fichier
*/

require_once ('databaseConnection.php');

function uploadFiles(){
    if(isset($_FILES["fileToUpload"])){
        $target_dir = './upload/';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]['name']);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    





$file_path=$target_file;

$stmt = connectionBase()->prepare("INSERT INTO `upload_files` (`file_path`) VALUES (:file_path);");


$stmt->bindParam(':file_path', $file_path);


$stmt->execute();

base64_encode($file_path);

echo '<a href="' . $file_path . '" download>' . base64_encode($file_path) . '<a/>';
    }
}



// function lien(){
//     $target = 'upload/';
//     $link = 'bootstrap.txt';
//     link($target, $link);

// }
?>