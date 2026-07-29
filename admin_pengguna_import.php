<?php
define("ACCESS", true);include('inc_header.php');
include_once('inc_setup.php');
semak_tahap('admin');

if (isset($_FILES["import"])) {
    if (!file_exists($_FILES['import']['tmp_name'])) {
        echo "<script> alert('Please select a file.'); window.location.replace('urus_import.php'); </script>";
    }
    $file = fopen($_FILES["import"]["tmp_name"], 'rb');
    while (($line = fgetcsv($file, 100, ",")) !== FALSE) {
        if (count($line) >= 3) {
            $idpengguna = trim($line[0]);
            $katalaluan = trim($line[1]);
            $nama = trim($line[2]);
            $tahap = isset($line[3]) ? trim($line[3]) : "pengguna";
            $sql = "INSERT IGNORE INTO pengguna (idpengguna, katalaluan, nama, tahap) VALUES('$idpengguna', '$katalaluan', '$nama', '$tahap')";
            $result = query($db, $sql);
        }
    }
    fclose($file);
    echo "<script>alert('Import process completed.');
    window.location.replace('admin_pengguna_senarai.php'); </script>";
} ?>
<h2>Import User Data</h2>
<form method="POST" action="" enctype="multipart/form-data">
    <p>
        <label for='import'>Select file to import (TXT or CSV format only)</label><br>
        <input class="form-control mt-4 mb-4" type="file" name='import' accept='.csv, .txt' required>
    </p>
    <p><button class="btn btn-success" type="submit" value="submit">Import Data</button>
    </p>
</form>
<p>Imported data must follow this order :<br> idpengguna, katalaluan, nama, tahap</p>
<?php include('inc_footer.php'); ?>