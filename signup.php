<?php
define("ACCESS", true);
include('inc_header.php');
include_once('inc_setup.php');

$idpengguna = $nama = $error = '';
if (isset($_POST['idpengguna']) && isset($_POST['katalaluan'])) {
    $idpengguna = trim($_POST['idpengguna']);
    $katalaluan = trim($_POST['katalaluan']);
    $nama = trim($_POST['nama']);

    if (empty($idpengguna) || empty($nama) || empty($katalaluan)) {
        $error .= "Please fill in all the fields on the registration form.";
    }
    if (preg_match('/[^a-zA-Z0-9]+/', $idpengguna)) {
        $error .= "User ID cannot contain special characters.";
    }
    $panjang_idpengguna = strlen($idpengguna);
    if ($panjang_idpengguna > 12) {
        $error .= "User ID is too long. Maximum 15 characters.";
    }
    if ($panjang_idpengguna < 4) {
        $error .= "User ID is too short. Minimum 4 characters.";
    }
    $panjang_katalaluan = strlen($katalaluan);
    if ($panjang_katalaluan < 6) {
        $error .= "Password is too short. Minimum 6 characters.";
    }
    $sql = "SELECT * FROM pengguna WHERE idpengguna='$idpengguna' LIMIT 1";
    $result = query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error .= "User ID('$idpengguna') is already in use, please use another one.";
    }
    if (empty($error)) {
        $sql = "INSERT INTO pengguna (idpengguna,katalaluan,nama,tahap)
        VALUES('$idpengguna','$katalaluan','$nama','pengguna')";
        $result = query($db, $sql);
        exit("<script>alert('Registration successful. Please log in.');
            window.location.replace('login.php');</script>");
    } else {
        echo "<script>alert('$error');</script>";
    }
}
?>
<h2 style="font-size: 2em; margin-left: 20px;"><b>Sign Up Account</b></h2>
<form method="POST" action="signup.php" class="w-50 m-auto">

    <div class="mb-3">
        <label class="form-label mt-2"><b>User ID</b> (Username/Phone Number/IC Number)</label>
        <input class="form-control" type="text" name="idpengguna"
            data-bs-toggle="tooltip" data-bs-placement="center" title="User ID for login."
            value='<?php echo $idpengguna; ?>' required>
    </div>

    <div class="mb-3">
        <label class="form-label mt-2"><b>Password</b></label>
        <input class="form-control" type="password" name="katalaluan" required>
</div>

<div class=" mb-3">
        <label class="form-label"><b>Name</b></label>
        <input class="form-control" type="text" name="nama"
            value='<?php echo $nama; ?>' required>
    </div>

    <div class="d-grid gap-2">
        <button class="btn btn-primary d-block" type="submit"><b>Sign Up</b></button>
    </div>
</form>

<?php include('inc_footer.php'); ?>