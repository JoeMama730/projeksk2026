<?php
define("ACCESS", true);
include('inc_header.php');
include_once('inc_setup.php');
semak_tahap('admin');

if (isset($_GET['delete'])) {
    $idundian = $_GET['delete'];
    $sql = "DELETE FROM undian WHERE idundian='$idundian'";
    $result = query($db, $sql);
    exit("<script>alert('The vote has been successfully removed.');
    window.location.replace('admin_undian_senarai.php');</script>");
}

$keyword = $q = "";

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    $status = $_POST['status'];
    if (!empty($keyword)) {
        $q = "WHERE label_undian LIKE '%$keyword%'";
    }
    $masa_now = date("Y-m-d H:i:s");
    if ($status == 'active') {
        $q = "WHERE masa_tamat >'$masa_now'";
    } elseif ($status == 'tamat') {
        $q = "WHERE masa_tamat <'$masa_now'";
    }
}
?>
<h2 style="font-size: 2em; margin-left: 20px;"><b>Manage Votes</b></h2>
<form method="POST" action="" style="margin-left: 20px;">
    <div class="row">
        <div class="col">
            <div class="d-flex gap-2">
                <input class="form-control" type='text' name='keyword'
                    value='<?php echo $keyword; ?>' placeholder='Kata kunci' style="min-width:150px">
                <select class="form-select" name="status" style="min-width: 100px;">
                    <option value="" selected>Status</option>
                    <option value="active">Active</option>
                    <option value="closed">Closed</option>
                </select>

                <button class="btn btn-success" type='submit' name='search'>Search</button>
                <button class="btn btn-warning" type='submit' name='reset'>Reset</button>
            </div>
        </div>
        <div class="col text-end gap-2" style="margin-right: 20px;">
            <a class='btn btn-sm btn-primary' href='admin_undian_borang.php'>Add Vote</a>
            <button class="btn btn-sm btn-primary" onclick='window.print()'>Print</button>
        </div>
    </div>
</form>

<hr>
<?php
$sql = "SELECT * FROM undian $q";
$result = query($db, $sql);
$total = mysqli_num_rows($result);

if ($total > 0) {
    echo "Total: $total<br>";
    echo "<table class='table table-bordered table-striped'border='1'cellpadding='4'cellspacing='0'>
    <tr><th width='200'>Image</td><th>Vote</td><th class='text-end'>Action</td></tr>";
    while ($row = mysqli_fetch_array($result)) {
        $idundian = $row['idundian'];
        $label_undian = $row['label_undian'];
        $masa_tamat = date("j M Y, g:i A", strtotime($row['masa_tamat']));

        if (semak_tamat($row['masa_tamat'])) {
            $label_masa = "Vote has ended:<span style='color:red'>$masa_tamat</span>";
        } else {
            $label_masa = "Vote Closes On:<span style='color:green'>$masa_tamat</span>";
        }
        $imej = $row['imej'];
        if (!empty($imej)) {
            $img = "<img src='$image_folder/$imej'class='border rounded'alt='Gambar Undian'width='100%'>";
        } else {
            $img = "";
        }
        echo "<tr>
        <td>$img</td><td><b>$idundian:$label_undian</b><br>$label_masa<br>
        <a href='admin_undian_borang.php?id=$idundian'>Edit Information </a>|
        <a href='admin_undian_soalan.php?id=$idundian'>Manage Questions </a>|
        <a href='javascript:void(0);'onclick='deletethis(\"$idundian\")'>Remove</a>
        </td>
        <td align='right'>
        <a class='btn btn-info btn-sm mb-2'href='undian.php?id=$idundian'>Results</a>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<p style=\"margin-left: 20px;\">No votes yet.</p>";
}
include('inc_footer.php');
?>