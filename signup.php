<?php
include('inc_header.php');
include('inc_setup.php');

$idpengguna = $nama = $error ='';
if(isset($_POST['idpengguna']) && isset($_POST['katalaluan'])){
    $idpengguna=trim($_POST['idpengguna']);
    $katalaluan=trim($_POST['katalaluan']);
    $nama=trim($_POST['nama']);

    if(empty($idpengguna) || empty($nama) || empty($katalaluan)){
        $error.="Sila isi semua ruang di borang pendaftaran.";
    }
    if(preg_match('/[^a-zA-Z0-9]+/', $idpengguna)){
        $error.="ID Pengguna tidak boleh menggunakan simbol.";
    }
    $panjang_idpengguna=strlen($idpengguna);
    if($panjang_idpengguna>12){
        $error.="ID Pengguna terlalu panjang. Maksima 15 aksara.";
    }
    if($panjang_idpengguna<4){
        $error.="ID Pengguna terlalu pendek. Minima 4 aksara.";
    }
    $panjang_katalaluan=strlen($katalaluan);
    if($panjang_katalaluan<6){
        $error.="Katalaluan terlalu pendek. Minima 6 aksara.";
    }
    $sql="SELECT * FROM pengguna WHERE idpengguna='$idpengguna' LIMIT 1";
    $result=query($db,$sql);

    if(mysqli_num_rows($result)>0){
        $error.="ID Pengguna('$idpengguna') sudah digunakan, sila gunakan yang lain.";
    }
    if(empty($error)){
        $sql="INSERT INTO pengguna (idpengguna,katalaluan,nama,tahap)
        VALUES('$idpengguna','$katalaluan','$nama','pengguna')";
        $result = query($db,$sql);
        exit("<script>alert('Pendaftaran berjaya. Sila Log Masuk');
            window.location.replace('login.php');</script>");
    }else{
        echo "<script>alert('$error');</script>";
    }
    
}
?>
<h2>Daftar Akaun</h2>
<form method="POST" action="signup.php" class="w-50 m-auto">

<div class="mb-3">
<label class="form-label mt-2">ID Pengguna (Username/NoTel/No.KP)</label>
<input class="form-control" type="text" name="idpenguna"
data-bs-toggle="tooltip" data-bs-placement="top" title="ID Pengguna untuk log masuk."
value='<?php echo $idpengguna; ?>' required> 
</div>

<div class="mb-3">
    <label class="form-label mt-2">Katalaluan</label>
    <input class="form-control" type="password" name="katalaluan" value="required>
</div>

<div class="mb-3">
    <label class="form-label">Nama</label>
    <input class="form-control" type="text" name="nama"
    value='<?php echo $nama; ?>' required> 
</div>

<div class="d-grip gap-2">
    <button class="btn btn-success d-block" type="submit">Daftar</button>
</div>
</form>

<?php include('inc_footer.php'); ?>