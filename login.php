<?php
define("ACCESS", true);
include_once('inc_setup.php');
include('inc_header.php');

$idpengguna = "";

if (isset($_POST['idpengguna']) && isset($_POST['katalaluan'])) {
    $idpengguna = trim($_POST['idpengguna']);
    $katalaluan = trim($_POST['katalaluan']);

    $sql = "SELECT * FROM pengguna
    WHERE idpengguna='$idpengguna' AND katalaluan='$katalaluan'LIMIT 1";
    $result = query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $_SESSION['idpengguna'] = $row['idpengguna'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['tahap'] = $row['tahap'];

        exit("<script>alert('Login successful.'); window.location.replace('index.php');</script>");
    } else {
        echo "<script>alert('Login failed: ($idpengguna)');</script>";
    }
}
?>
<h2 style="font-size: 2em; margin-left: 20px;"><b>Log In</b></h2>
<form method="POST" action="login.php" class="w-50 m-auto">
    <div class="mb-3"><label class="form-label"><b>User ID</b></label>
        <input type="text" class="form-control" name="idpengguna"
            placeholder="Enter User ID" value="<?= $idpengguna ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label"><b>Password</b></label>
        <input type="password" class="form-control" name="katalaluan" placeholder="Enter Password" required>
    </div>

    <div class="d-grid gap-2">
        <button class="btn btn-primary d-block" type="submit"><b>Log In</b></button>
    </div>
</form>
<?php include('inc_footer.php'); ?>