<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload File Gambar di PHP dan MySQL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.4.1.js"></script>
</head>
<body>
    <br>
    <div class="container">
        <?php
        //Validasi untuk menampilkan pesan pemberitahuan
        if (isset($_GET['add'])) {
      
            if ($_GET['add']=='berhasil'){
                echo"<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah diupload!</div>";
            }else if ($_GET['add']=='gagal'){
                echo"<div class='alert alert-danger'><strong>Gagal!</strong> File gambar gagal diupload!</div>";
            }    
        }

        if (isset($_GET['hapus'])) {
    
            if ($_GET['hapus']=='berhasil'){
                echo"<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah dihapus!</div>";
            }else if ($_GET['hapus']=='gagal'){
                echo"<div class='alert alert-danger'><strong>Gagal!</strong> File gambar gagal dihapus!</div>";
            }    
        }
        ?>
        <form action="simpan.php" method="post" enctype="multipart/form-data">
            <!-- rows -->   
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div id="msg"></div>
                        <input type="file" name="gambar" class="file" >
                            <div class="input-group my-3">
                                <input type="text" class="form-control" disabled placeholder="Upload Gambar" id="file">
                                <div class="input-group-append">
                                        <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Gambar</button>
                                </div>
                            </div>
                        <img src="gambar/80x80.png" id="preview" class="img-thumbnail">
                    </div>
                </div>
            </div>

                <button type="submit" name="btn_simpan" class="btn btn-success">Simpan</button>
        </form>

        <hr>
        <div class="row">
            <div class="col-sm-6">
                <div class="table-responsive">
                    <table class="table table-bordered" width='20%'cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width='60%'>Gambar</th> 
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            // include database
                            include 'database.php';
                            // perintah sql untuk menampilkan daftar bank yang berelasi dengan tabel kategori bank
                            $sql="select * from gambar order by id_gambar desc";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><img src="gambar/<?php echo $data['gambar'];?>" class="rounded" width='100%' alt="Cinque Terre"></td>
                            <td><a href="hapus.php?id_gambar=<?php echo $data['id_gambar'];?>&gambar=<?php echo $data['gambar'];?>" onclick="konfirmasi()" class="btn btn-danger" role="button">Hapus</a></td>
                        </tr>
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

<script>

    function konfirmasi(){
        konfirmasi=confirm("Apakah anda yakin ingin menghapus gambar ini?")
        document.writeln(konfirmasi)
    }

    $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });

    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>
