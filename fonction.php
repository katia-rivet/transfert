<?php
/* **************************************************
Upload de fichier
*/

require_once ('databaseConnection.php');

function uploadFiles(){

    if (isset($_FILES["fileToUpload"])){
        
        
        $filename_uploaded = explode('.', basename($_FILES["fileToUpload"]["name"])) ;
        $filename_tmp = basename($_FILES["fileToUpload"]["tmp_name"] .'.'.$filename_uploaded[1]);
        // echo $filename_tmp; // fichier temporaire

        $target_dir = './upload/' ; 
        //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);  
        $target_file = $target_dir . $filename_tmp;  

        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        $file_nom=$_FILES['fileToUpload']['name'];
        $tmp_name=$_FILES['fileToUpload']['tmp_name'];
        
        $stmt = connectionBase()->prepare("INSERT INTO `upload_files` (`file_nom` , `tmp_name`) VALUES ( :file_nom, :tmp_name);");
        $stmt->bindParam(':file_nom', $file_nom);
        $stmt->bindParam(':tmp_name', $tmp_name);
        $stmt->execute();


/*
faudrait que lorsque je click sur le lien, je reconvertisse le fichier en "vrai" nom
*/


        rename($target_file, $file_nom);
        var_dump($target_file);

        $file_to_download = ('<a href="upload/' . $filename_tmp . '" download>' . $_FILES["fileToUpload"]["name"] . '</a>');
        echo($file_to_download);




    }
}


// function lien(){
//     $target = 'upload/';
//     $link = 'bootstrap.txt';
//     link($target, $link);

// }
?>