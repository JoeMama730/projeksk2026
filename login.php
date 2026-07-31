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
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
</svg>
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

    <div class="d-grid mb-3">
        <button class="btn btn-primary d-block" type="submit"><b>Log In</b></button>
    </div>

    <div class="alert alert-info d-flex align-items-center p-2 fs-6" role="alert">
        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:" style="width:1.25em;height:1.25em;fill:currentColor;">
            <use xlink:href="#info-fill" />
        </svg>
        <div>
        Click <a href="signup.php" class="custom-link" style="text-decoration: none;"><b>here</b></a> to register an account if yet to.
        </div>
    </div>
</form>
<?php include('inc_footer.php'); ?>