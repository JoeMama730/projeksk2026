<?php
include('inc_header.php');
include('inc_setup.php');
semak_tahap('admin');

if (isset($_GET['id'])) {
    $idundian = $_GET['id'];
} else {
    exit("<script>alert('ID diperlukan.');
    window.location.replace('admin_undian_senarai.php'); </script>");
}

if (isset($_GET['delete'])) {
    $idsoalan = $_GET['delete'];
    $sql = "DELETE FROM soalan WHERE idsoalan ='$idsoalan'";
    $result = query($db, $sql);

    exit("<script> alert('Soalan berjaya dibuang.');
    window.location.replace('admin_undian_soalan.php?id=$idundian'); </script>");
}

$sql = "SELECT * FROM undian WHERE idundian ='$idundian' LIMIT 1";
$result = query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_array($result);
    $label_undian = $data['label_undian'];
} else {
    echo "<script>alert('ID ($idundian) tidak wujud.');
    window.location.replace('admin_undian_soalan.php'); </script>";
}

if (isset($_POST['idsoalan']) && isset($_POST['label_soalan']) && isset($_POST['idjawapan']) && isset($_POST['label_jawapan'])) {
    $idsoalan = $_POST['idsoalan'];
    $label_soalan = $_POST['label_soalan'];
    $idjawapan = $_POST['idjawapan'];
    $label_jawapan = $_POST['label_jawapan'];

    $sql = "INSERT INTO soalan (idsoalan, label_soalan, idundian) VALUES ('$idsoalan', '$label_soalan', '$idundian')";
    $result = query($db, $sql);
    foreach ($idjawapan as $key => $idjawapan) {
        if (!empty($idjawapan) && !empty($label_jawapan[$key])) {
            $sql = "INSERT INTO jawapan (idjawapan, label_jawapan, idsoalan)
            VALUES ('$idjawapan', '$label_jawapan[$key]', '$idsoalan')";
            $result = query($db, $sql);
        }
    }
    echo "<script> alert('Berjaya disimpan.');
    window.location.replace('admin_undian_soalan.php?id=$idundian'); </script>";
}
?>

<h2>Soalan Undian <?= $idundian ?> : <?= $label_undian ?></h2>

<form method="POST" action="">
    <p>
        <label>ID Soalan</label><br>
        <input style="width: 100px" type='text' name='idsoalan' value='' placeholder='ID Soalan' required>
        <input type='text' name='label_soalan' placeholder='Label soalan'>
    </p>

    <label>Pilihan Jawapan:</label><br>
    <p>
        <input stype="width: 100px" type='text' name='idjawapan[]' placeholder='ID Jawapan' required>
        <input type='text' name'label_jawapan[]' placeholder='Label Jawapan' required>
    </p>

    <p id="input-jawapan">
        <input style="width: 100px" type='text' name='idjawapan[]' placeholder='ID Jawapan' required>
        <input type='text' name='label_jawapan[]' placeholder='Label Jawapan' required>
    </p>

    <p>
        <a href='javascript:void(0);' onclick="tambah_jawapan()">+ Pilihan</a>
    </p>

    <button class="btn btn-sm btn-success" type="submit" value="Simpan">
        Simpan Soalan</button>
</form>
<hr>

<?php
$sql = "SELECT * FROM soalan WHERE idundian='$idundian' 
ORDER by idsoalan ASC";

$result = query($db, $sql);
$total = mysqli_num_rows($result);

if ($total > 0) {
    echo "Jumlah: $total<br>";
    echo "<table class='table table-bordered table-striped' border='1' cellpadding='4' cellspacing='0'>
    <tr>
    <th>Label Soalan</th>
    <th>Pilihan Jawapan</th>
    <th>Tindakan</th>
    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        $idsoalan = $row['idsoalan'];
        $label_soalan = $row['label_soalan'];

        $label_jawapan = "";
        $sql = "SELECT * FROM jawapan WHERE idsoalan ='$idsoalan' ORDER BY idjawapan ASC";
        $result2 = query($db, $sql);

        while ($jaw = mysqli_fetch_array($result2)) {
            $label_jawapan .= $jaw['idjawapan'] . ":" . $jaw['label_jawapan'] . "<br>";
        }
        echo "<tr>
        <td>$idsoalan : $label_soalan</td>
        <td>$label_jawapan</td>
        <td><a class='btn btn-sm btn-danger'href='javascript:void(0);'
        onclick='deletethis(\"$idsoalan\")> Buang </a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "Belum ada soalan.";
}

include('inc_footer.php'); ?>