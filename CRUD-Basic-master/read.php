<?php
    include "connect.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>CRUD Bagian 2: Read</title>
</head>
<body>
    <div align="center" style="padding: 10px;">Dengan mysqli_fetch_array</div>
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
            <?php
                include "connect.php";

                $kueri = mysqli_query($koneksi, "SELECT * FROM anggota");
                $i = 1;
                while($data = mysqli_fetch_array($kueri)){
                    echo "<tr>";
                    echo "<th>".$i."</th>";
                    echo "<td>".$data['nama']."</td>";
                    echo "<td>".$data['nrp']."</td>";
                    echo "<td>".$data['ketertarikan']."</td>";
                    echo "<td><a class='btn btn-primary' href='update.php?id=".$data['id']."'>Ubah</a></td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
        </tbody>
    </table>

    <div align="center" style="padding: 10px;">Dengan mysqli_fetch_rows</div>
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
            <?php
                include "connect.php";

                $kueri2 = mysqli_query($koneksi, "SELECT * FROM anggota");
                $i = 1;
                while($data = mysqli_fetch_row($kueri2)){
                    echo "<tr>";
                    echo "<th>".$i."</th>";
                    echo "<td>".$data[1]."</td>";
                    echo "<td>".$data[2]."</td>";
                    echo "<td>".$data[3]."</td>";
                    echo "<td><a class='btn btn-primary' href='update.php?id=".$data[0]."'>Ubah</a></td>";
                    echo "</tr>";
                    $i++;
                }
            ?>
        </tbody>
    </table>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>