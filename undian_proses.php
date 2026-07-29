<?php
define("ACCESS", true);
include_once('inc_setup.php');
semak_tahap('pengguna');

if (isset($_POST['undian']) && isset($_POST['respon'])) {
    $idpengguna = $_SESSION['idpengguna'];
    $idundian = $_POST['undian'];
    foreach ($_POST['respon'] as $idsoalan => $idjawapan) {
        if (!empty($idjawapan)) {
            $sql = "INSERT IGNORE INTO respon (idpengguna, idjawapan) VALUES ('$idpengguna', '$idjawapan')";
            $result = query($db, $sql);
        }
    }
    echo "<script> alert('Thank you for voting.');
    window.location.replace('keputusan.php?id=$idundian');</script>";
} else {
    echo "<script> alert ('No POST data needed.');
    window.location.replace('index.php'); </script>";
}
