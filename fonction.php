<?php
/* **************************************************
Upload de fichier
*/



function uploadFiles(){ 

    if (isset($_FILES["fileToUpload"])){
        
        // Séparer à partir '.' des chaines de caractères en segments
        $filename_uploaded = explode('.', basename($_FILES["fileToUpload"]["name"])) ; 
        // Concaténation le nom du fichier et l'extension
        $filename_tmp = basename($_FILES["fileToUpload"]["tmp_name"] .'.'.$filename_uploaded[1]); 
        // echo $filename_tmp; // fichier temporaire

        $target_dir = './upload/' ;  
        $target_file = $target_dir . $filename_tmp;  

        // Fonction de transfert du dossier tmp dans le dossier cible
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        // Récupération des infos du fchier
        $file_nom=$_FILES['fileToUpload']['name'];
        $tmp_name=$_FILES['fileToUpload']['tmp_name'];
        
        // Enregistrement dans la base SQL
        $stmt = connectionBase()->prepare("INSERT INTO `upload_files` (`file_nom` , `tmp_name`) VALUES ( :file_nom, :tmp_name);");
        $stmt->bindParam(':file_nom', $file_nom);
        $stmt->bindParam(':tmp_name', $tmp_name);
        $stmt->execute();

        // On prépare le téléchargement du fichier et on le reconvertit dans son vrai nom
        $file_to_download = ('<a href="upload/' . $filename_tmp . '" download="' . $file_nom .'">' . $_FILES["fileToUpload"]["name"] . '</a>');
        echo($file_to_download);




    }
}



?>