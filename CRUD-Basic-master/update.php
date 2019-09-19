<?php
    include "connect.php";

    if(isset($_POST['simpan'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nrp = $_POST['nrp'];
        $interest = $_POST['interest'];

        $kueriSimpan = mysqli_query($koneksi, "UPDATE anggota SET nama = '$nama', nrp = '$nrp', ketertarikan = '$interest' WHERE id = $id");

        if(!$kueriSimpan){
            echo "Gagal";
        }else{
            header("location: index.php");
        }

    }else{
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }else{
            $kueriHitung = mysqli_query($koneksi, "SELECT * FROM anggota");
            $hitung = mysqli_num_rows($kueriHitung);
            $ambilID = mysqli_fetch_array($kueriHitung);

            $id = rand((int)$ambilID['id'], (int)$ambilID['id']+(int)$hitung);
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CRUD Bagian 3: Update</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">NRP</th>
                <th scope="col"><i>Interest</i></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="POST">
            <?php
                $kueri = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = $id");
                while($data = mysqli_fetch_array($kueri)){
                    echo "<tr>";
                    echo "<th><input type='hidden' name='id' value='".$data['id']."' />".$data['id']."</th>";
                    echo "<td><input type='text' name='nama' value='".$data['nama']."' placeholder='Masukkan nama' class='form-control' /></td>";
                    echo "<td><input type='text' name='nrp' value='".$data['nrp']."' placeholder='Masukkan NRP' class='form-control'/></td>";
                    echo "<td><textarea name='interest' class='form-control'>".$data['ketertarikan']."</textarea></td>";
                    echo "<td><input type='submit' name='simpan' value='Simpan' class='btn btn-primary' /></td>";
                    echo "</tr>";
                }
            ?>
            </form>
            <form action="addImage.php" method="POST" enctype="multipart/form-data">
                <tr>
                    <td></td>
                    <td>
                        <div class="form-group">
                            <label for="fileUpload">Tambahkan foto</label>
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                            <input type="file" name="afile" class="form-control-file" id="fileUpload">
                            <input type="submit" name="simpan" value="Tambahkan foto" class="btn btn-primary" />
                        </div>
                    </td>
                    <td></td><td></td>
                </tr>
            </form>
        </tbody>
    </table>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>