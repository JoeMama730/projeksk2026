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
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
</svg>
<h2 style="font-size: 2em; margin-left: 20px;"><b>Sign Up Account</b></h2>
<form method="POST" action="signup.php" class="w-50 m-auto">
    <div class="mb-3">
        <label class="form-label mt-2"><b>User ID</b></label>
        <input class="form-control" type="text" name="idpengguna" placeholder="Username/Phone Number/IC Number"
            data-bs-toggle="tooltip" data-bs-placement="right" title="User ID for login."
            value='<?php echo $idpengguna; ?>' required>
    </div>

    <div class="mb-3">
        <label class="form-label mt-2"><b>Password</b></label>
        <input class="form-control" type="password" name="katalaluan" data-bs-toggle="tooltip" data-bs-placement="right" title="Minimum of 6 characters." required>
    </div>

    <div class=" mb-3">
        <label class="form-label"><b>Name</b></label>
        <input class="form-control" type="text" name="nama"
            value='<?php echo $nama; ?>' required>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button class="btn btn-primary d-block" type="submit"><b>Sign Up</b></button>
    </div>

    <div class="alert alert-info d-flex align-items-center p-2 fs-6" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:" style="width:1.25em;height:1.25em;fill:currentColor;">
            <use xlink:href="#info-fill" />
        </svg>
        <div>
            Click <a href="login.php" class="custom-link" style="text-decoration: none;"><b>here</b></a> to log in to an account if your account has already been registered.
        </div>
    </div>
</form>

<?php include('inc_footer.php'); ?>