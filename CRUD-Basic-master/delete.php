<?php
    include "connect.php";

    if(isset($_POST['hapus'])){
        $id = $_POST['id'];

        $kueriSimpan = mysqli_query($koneksi, "DELETE FROM anggota WHERE id = $id");

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
    <title>CRUD Bagian 4: Delete</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">NRP</th>
                <th scope="col"><i>Interest</i></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="POST">
            <?php
                include "connect.php";

                $kueri = mysqli_query($koneksi, "SELECT * FROM anggota");
                $i = 1;
                while($data = mysqli_fetch_array($kueri)){
                    echo "<tr>";
                    echo "<th><input type='hidden' name='id' value='".$data['id']."'>".$i."</th>";
                    echo "<td>".$data['nama']."</td>";
                    echo "<td>".$data['nrp']."</td>";
                    echo "<td>".$data['ketertarikan']."</td>";
                    echo "<td><button type='submit' name='hapus' value='1' class='btn btn-primary'>Hapus</a></td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
            </form>
        </tbody>
    </table>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>