<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sharing Session: CRUD Dasar PHP dan MySQL</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="con">
        <div class="nav">
            <span>
                <a href="#">Top</a>
                <a href="#create">Create</a>
                <a href="#read">Read</a>
                <a href="#update">Update</a>
                <a href="#delete">Delete</a>
            </span>
        </div>
        <div class="cont">
            <h1 class="tit">CRUD Basic</h1>
            <span class="tit">Membuat list anggota Telkom Web Dev.</span>
            <ol>
                <li id="create">
                    <b>CRUD Bagian 1: Create</b>
                    <p>
                        Bisa juga dilakukan dengan menjalankan perintah:
                        <pre class="code-con"><code>
/* Create Database and Table */
create database belajardb;

use belajardb;

CREATE TABLE `anggota` (
    `id` int(16) NOT NULL auto_increment,
    `nama` varchar(255),
    `nrp` int(10),
    `ketertarikan` text,
    PRIMARY KEY  (`id`)
);
                        </code></pre>
                        Untuk menjalankan perintah diatas, perlu untuk disimpan dalam
                        format <b>*.sql</b>. Nantinya bisa dilakukan import melalui phpmyadmin.
                    </p>
                </li>
                <li>
                    <b>Menghubungkan dengan database</b>
                    <p>Membuat file <b>connect.php</b>.
                    <pre class="code-con"><code>
&lt;?php
    $host = 'localhost';
    $namaDB = 'belajarDb';
    $usernameDB = 'root';
    $passwordDB = '';

    $koneksi = mysqli_connect($host, $usernameDB, $passwordDB, $namaDB);
    if(mysqli_connect_error()){
        echo "Gagal menghubungkan ke database";
    }else{
        echo "Terhubung!";
    }
?&gt;
                    </code></pre>
                    Pesan akan muncul baik jika gagal terhubung maupun berhasil pada database.
                    <pre class="code-con">
Terhubung!
                    </pre>
                    Form yang digunakan untuk menambahkan data kurang lebih seperti berikut
                    <?php
                        include "add.php";
                    ?>
                    <pre class="code-con"><code>
&lt;?php
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
?&gt;

&lt;form action="add.php" method="GET"&gt;
    &lt;div class='form-group'&gt;
        &lt;label for='nama'&gt;Email address&lt;/label&gt;
        &lt;input type='text' id='nama' name='nama' placeholder='Masukkan nama' class='form-control' /&gt;
    &lt;/div&gt;

    &lt;div class='form-group'&gt;
        &lt;label for='nrp'&gt;NRP&lt;/label&gt;
        &lt;input type='text' name='nrp' placeholder='Masukkan NRP' class='form-control' id='nrp' /&gt;
    &lt;/div&gt;

    &lt;div class='form-group'&gt;
        &lt;label for='interest'&gt;&lt;i&gt;Interest&lt;/i&gt;&lt;/label&gt;
        &lt;textarea name='interest' class='form-control' placeholder="Masukkan minat. Pisahkan jawaban ganda dengan koma." id='interest'&gt;&lt;/textarea&gt;
    &lt;/div&gt;
        
    &lt;button type="submit" name='simpan' value='1' class="btn btn-primary"&gt;Simpan&lt;/button&gt;
&lt;/form&gt;
                    </code></pre>
                    </p>
                </li>
                <li id="read">
                    <b>CRUD Bagian 2: Read</b>
                    <p>
                        Sebelum memulai, karena database dalam keadaan tanpa data, jalankan perintah dibawah ini pada menu SQL di phpmyadmin.
                        <pre class="code-con"><code>
INSERT INTO `anggota` (`id`, `nama`, `nrp`, `ketertarikan`) VALUES 
    (NULL, 'Fahmi Syaifudin', '', 'Web Programming, Desain'), 
    (NULL, 'Rachmadani Yusuf', '', 'IoT'), 
    (NULL, 'Safarudin Alwi Prayogo', '', ''), 
    (NULL, 'Agha Pradipta Merdekawan', '1210161035', '');
                        </code></pre>
                        <?php
                            include "read.php";
                        ?>
                        Untuk melakukan pengambilan data dari database, seperti pada tabel diatas, dapat digunakan perintah mysql
                        "<b>SELECT * FROM anggota</b>"". Dimana:
                        <ul class="list--content">
                            <li><b>*</b>: Berarti mengambil semua data</li>
                            <li><b>anggota</b>: adalah nama tabel yang dibuat pada database <b>belajardb</b></li>
                        </ul>
                        
                        Contoh berikut menggunakan <b>mysqli_fecth_array</b>
                        <pre class="code-con"><code>
&lt;table class="table"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th scope="col"&gt;#&lt;/th&gt;
            &lt;th scope="col"&gt;Nama Lengkap&lt;/th&gt;
            &lt;th scope="col"&gt;NRP&lt;/th&gt;
            &lt;th scope="col"&gt;&lt;i&gt;Interest&lt;/i&gt;&lt;/th&gt;
            &lt;th scope="col"&gt;&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;?php
            include "connect.php";

            $kueri = mysqli_query($koneksi, "SELECT * FROM anggota");
            while($data = mysqli_fetch_array($kueri)){
                echo "&lt;tr&gt;";
                echo "&lt;th&gt;".$data['id']."&lt;/th&gt;";
                echo "&lt;td&gt;".$data['nama']."&lt;/td&gt;";
                echo "&lt;td&gt;".$data['nrp']."&lt;/td&gt;";
                echo "&lt;td&gt;".$data['ketertarikan']."&lt;/td&gt;";
                echo "&lt;td&gt;&lt;a class='btn btn-primary' href='update.php?id=".$data['id']."'&gt;Ubah&lt;/a&gt;&lt;/td&gt;";
                echo "&lt;/tr&gt;";
            }
        ?&gt;
    &lt;/tbody&gt;
&lt;/table&gt;
                        </code></pre>
                        Terdapat beberapa cara untuk pengambilan data, diantaranya:
                        <ol class="list--content">
                            <li>
                                mysqli_fecth_array<br>
                                Mengambil data berdasarkan array asosiatif.
                            </li>
                            <li>
                                mysqli_fetch_rows<br>
                                Mengambil data satu baris.
                            </li>
                            <li>
                                dan lainnya.    
                            </li>
                        </ol>
                    </p>
                </li>
                <li id="update">
                    <b>CRUD Bagian 3: Update</b>
                    <p>
                        Digunakan untuk melakukan update data, perintah yang digunakan
                        <pre class="code-con"><code>
UPDATE anggota SET (kolom) = (nilai baru) WHERE (selector) = (data yang ingin diubah)
                        </code></pre>
                        Untuk melakukan perubahan data, digunakan php form
                        <pre class="code-con"><code>
&lt;?php
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

            $id = rand(1, $hitung);
        }
    }
?&gt;

&lt;table class="table"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th scope="col"&gt;#&lt;/th&gt;
            &lt;th scope="col"&gt;Nama Lengkap&lt;/th&gt;
            &lt;th scope="col"&gt;NRP&lt;/th&gt;
            &lt;th scope="col"&gt;&lt;i&gt;Interest&lt;/i&gt;&lt;/th&gt;
            &lt;th scope="col"&gt;&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;form action="" method="POST"&gt;
        &lt;?php
            $kueri = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = $id");
            while($data = mysqli_fetch_array($kueri)){
                echo "&lt;tr&gt;";
                echo "&lt;th&gt;&lt;input type='hidden' name='id' value='".$data['id']."' /&gt;".$data['id']."&lt;/th&gt;";
                echo "&lt;td&gt;&lt;input type='text' name='nama' value='".$data['nama']."' placeholder='Masukkan nama' class='form-control' /&gt;&lt;/td&gt;";
                echo "&lt;td&gt;&lt;input type='text' name='nrp' value='".$data['nrp']."' placeholder='Masukkan NRP' class='form-control'/&gt;&lt;/td&gt;";
                echo "&lt;td&gt;&lt;textarea name='interest' class='form-control'&gt;".$data['ketertarikan']."&lt;/textarea&gt;&lt;/td&gt;";
                echo "&lt;td&gt;&lt;input type='submit' name='simpan' value='Simpan' class='btn btn-primary' /&gt;&lt;/td&gt;";
                echo "&lt;/tr&gt;";
            }
        ?&gt;
        &lt;/form&gt;
    &lt;/tbody&gt;
&lt;/table&gt;
                        </code></pre>
                        <?php
                            include "update.php";
                        ?>
                    </p>
                    </li>
                    <li id="delete">
                        <b>CRUD Bagian 4: Delete</b>
                        <p>
                            Digunakan untuk menghapus entry data. Digunakan perintah
                            <pre class="code-con"><code>
DELETE FROM anggota WHERE (selector) = (data yang ingin diubah)
                            </code></pre>
                            <pre class="code-con"><code>
    if(isset($_POST['hapus'])){
        $id = $_POST['id'];

        $kueriSimpan = mysqli_query($koneksi, "DELETE FROM anggota WHERE id = $id");

        if(!$kueriSimpan){
            echo "Gagal";
        }else{
            header("location: index.php");
        }

    }
                        </code></pre>
                        <?php
                            include "delete.php";
                        ?>
                        </p>
                    </li>
            </ol>
        </div>
    </div>
</body>
</html>