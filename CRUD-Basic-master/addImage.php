<?php
    if(isset($_POST['simpan'])){
        $errors = array();
        $fileName = $_FILES['afile']['name'];
        $fileSize = $_FILES['afile']['size'];
        $fileType = $_FILES['afile']['type'];
        $fileTmp = $_FILES['afile']['tmp_name'];
        $temporaryFileExt = explode(".", $fileName);
        $fileExt = strtolower(end($temporaryFileExt));

        $extensions = array("jpg", "jpeg", "png", "gif");

        if(in_array($fileExt, $extensions) === false){
            $errors[] = "File tidak didukung, pastikan formatnya JPG, GIF, atau PNG";
        }

        if($fileSize > 5242880){
            $errors[] = "File size must be excately 5 MB";
        }
        
        if(file_exists("gambar/".$fileName)){
            echo "<b>File ".$fileName." sudah ada.</b><br>";
        }
        
        if(empty($errors)){
            move_uploaded_file($fileTmp, "gambar/".$fileName);
            echo "Nama file: ".$fileName."<br>";
            echo "Tipe file: ".$fileType."<br>";
            echo "Ukuran file: ".($fileSize/1024)."kB<br>";
            echo "Gambar berhasil diunggah";
        }else{
            print_r($errors);
        }
    }else{
        echo "Format tidak didukung";
    }
?>