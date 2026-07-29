<?php
define("ACCESS", true);
include_once('inc_setup.php');
include('inc_header.php');
$idpengguna = isset($_SESSION['idpengguna']) ? $_SESSION['idpengguna'] : false;
?>
<h2 style="font-size: 2em; margin-left: 20px;"><b>List of Votes</b></h2>
<?php
$sql = "SELECT * FROM undian";
$result = query($db, $sql);
$total = mysqli_num_rows($result);

if ($total > 0) {
    echo "<table class='table table-bordered table-striped'border='1'cellpadding='4'cellspacing='0'>
    <tr> <th width='200'>Image</td><th>Voting</td> 
    <th class='text-end'>Action</td></tr>";

    while ($row = mysqli_fetch_array($result)) {
        $idundian = $row['idundian'];
        $label_undian = $row['label_undian'];
        $masa_tamat = date("j M Y, g:i A", strtotime($row['masa_tamat']));

        if (semak_tamat($row['masa_tamat'])) {
            $label_masa = "Voting has ended: <span style='color: red'>$masa_tamat</span>";
        } else {
            $label_masa = "Vote Closes On: <span style='color: green'>$masa_tamat</span>";
        }
        $imej = $row['imej'];
        if (!empty($imej)) {
            $imej = "<img src='$image_folder/$imej' class='border rounded' alt='Gambar Undian' width='100%'>";
        } else {
            $imej = "";
        }
        $respon_undi = "";
        if ($idpengguna) {
            $undi_db = semak_undi($idundian, $idpengguna);

            if ($undi_db) {
                $respon_undi = "<br><b>Your Vote:</b><br>";
                foreach ($undi_db as $key => $value) {
                    $respon_undi .= $value['label_soalan'] . ":" . $value['label_jawapan'] . "<br>";
                }
            }
        }
        echo "<tr> <td>$imej</td>
        <td><b>$label_undian</b><br>
        $label_masa <br>$respon_undi
        </td>
        <td align='right'>
        <a class='btn btn-info btn-sm mb-2' href='undian.php?id=$idundian'>Vote</a>
        <a class='btn btn-info btn-sm mb-2' href='undian.php?id=$idundian'>Results</a>
        </td>
        </tr>
        ";
    }
    echo "</table>";
} else {
    echo "<p style=\"margin-left: 20px;\">No votes yet.</p>";
}
include('inc_footer.php'); ?>