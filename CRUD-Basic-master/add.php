<?php
    include "connect.php";

    if(isset($_GET['simpan'])){
        $id = $_GET['id'];
        $nama = $_GET['nama'];
        $nrp = $_GET['nrp'];
        $interest = $_GET['interest'];

        $kueriSimpan = mysqli_query($koneksi, "INSERT INTO anggota (nama, nrp, ketertarikan) VALUES ('$nama', '$nrp', '$interest')");

        if(!$kueriSimpan){
            echo "Gagal";
        }else{
            header("location: index.php");
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CRUD Bagian 1: Create</title>
</head>
<body>
    <div style='width: 50%; margin: auto;'>
    <form action="add.php" method="GET">
        <div class='form-group'>
            <label for='nama'>Email address</label>
            <input type='text' id='nama' name='nama' placeholder='Masukkan nama' class='form-control' />
        </div>

        <div class='form-group'>
            <label for='nrp'>NRP</label>
            <input type='text' name='nrp' placeholder='Masukkan NRP' class='form-control' id='nrp' />
        </div>

        <div class='form-group'>
            <label for='interest'><i>Interest</i></label>
            <textarea name='interest' class='form-control' placeholder="Masukkan minat. Pisahkan jawaban ganda dengan koma." id='interest'></textarea>
        </div>
        
        <button type="submit" name='simpan' value='1' class="btn btn-primary">Simpan</button>
    </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>