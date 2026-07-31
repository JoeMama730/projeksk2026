<?php
define("ACCESS", true);
include('inc_header.php');
include_once('inc_setup.php');
semak_tahap('admin');

if (isset($_GET['delete'])) {
    $idpengguna = $_GET['delete'];
    $sql = "DELETE FROM pengguna WHERE idpengguna='$idpengguna'";
    $result = query($db, $sql);

    echo "<script> alert('The user account has been successfully deleted.');
     window.location.replace('admin_pengguna_senarai.php');</script>";
    exit();
}
$keyword = $q = "";

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
    if (!empty($keyword)) {
        $q .= "WHERE nama LIKE '%$keyword%' OR idpengguna LIKE '%$keyword%'";
    }
}
?>

<h2 style="font-size: 2em; margin-left: 20px;"><b>Manage Users</b></h2>

<form method="POST" action="" style="margin-left: 20px;">
    <div class="row">
        <div class="col">
            <div class="d-flex gap-2">
                <input class="form-control" type='text' name='keyword' value='<?php echo $keyword; ?>' placeholder='User ID or Name' style="min-width:210px">
                <button class="btn btn-success" type='submit' name='search'>Search</button>
                <button class="btn btn-warning" type='submit' name='reset'>Reset</button>
            </div>
        </div>

        <div class="col text-end gap-2" style="margin-right: 20px;">
            <a class='btn btn-sm btn-primary'
                href="admin_pengguna_borang.php">Add User</a>
            <a class='btn btn-sm btn-primary'
                href='admin_pengguna_import.php'>Import Users</a>
            <button class="btn btn-sm btn-primary" onclick='window.print()'>Print</button>
        </div>
    </div>
</form>
<hr>
<?php
$sql = "SELECT * FROM pengguna $q GROUP BY idpengguna";

$result = query($db, $sql);
$total = mysqli_num_rows($result);
if ($total > 0) {
?>
    <p style="margin-left:20px"><b>Total:</b> <?= $total ?></p>
    <table class='table table-sm table-striped table-borderless table-responsive' cellpadding='4' cellspacing='0' style="margin-left: 20px; max-width: 95%;">
        <thead class="table-secondary">
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Level</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <?php
        $counter = 0;
        while ($row = mysqli_fetch_array($result)) {
            $counter += 1;
            $idpengguna = $row['idpengguna'];
            $nama = $row['nama'];
            $tahap = $row['tahap'];
        ?>
            <tbody>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= $idpengguna ?></td>
                    <td><?= $nama ?></td>
                    <td><?= $tahap ?></td>

                    <td align='right'>
                        <a class='btn btn-sm btn-info'
                            href='admin_pengguna_borang.php?idpengguna=<?= $idpengguna ?>'>Edit</a>
                        <a class='btn btn-sm btn-danger'
                            onclick='deletethis("<?= $idpengguna ?>")'>Delete</a>
                    </td>
                </tr>
            </tbody>
        <?php
        }
        ?>
    </table>
<?php
} else {
    echo "<p style=\"margin-left:20px;\">No user records found.</p>";
}

include('inc_footer.php');
?>