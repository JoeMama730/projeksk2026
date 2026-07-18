<?phpinclude('inc_header.php');
semak_tahap('admin');

if(isset($_GET['delete'])){
    $idundian=$_GET['delete'];
    $sql="DELETE FROM undian WHERE idundian='$idundian'";
    $result=query($db,$sql);
    exit("<script>alert('Undian berjaya dibuang.');
    window.location.replace('admin_undian_senarai.php');</script>");
}

$keyword=$q="";

if(isset($_POST['search'])){
    $keyword = $_POST['keyword'];
    $status = $_POST['status'];
    if(!empty($keyword)){
        $q = "WHERE label_undian LIKE '%$keyword%'";
    }
    $masa_now = date("Y-m-d H:i:s");
    if($status == 'aktif'){
        $q = "WHERE masa_tamat >'$masa_now'";
    }elseif($status == 'tamat'){
        $q = "WHERE masa_tamat <'$masa_now'";
    }
}
?>
<h2>Urus Undian</h2>
<form method="POST" action="">
<div class="row">
    <div class="col">
        <div class="input-group">
            <input class="form-control"type='text'name='keyword'
                value='<?php echo $keyword;?>'placeholder='Kata kunci'>
                <select class="form-select"name="status">
                    <option value=""selected>Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="tamat">Tamat</option>
</select>

<button class="btn btn-success"type='submit'name='search'>Cari</button>
<button class="btn btn-warning"type='submit'name='reset'>Reset</button>
</div>
</div>
<div class="col text-end">
    <a class='btn btn-sm btn-primary'href='admin_undian_borang.php'>Tambah Undian</a>
    <button class="btn btn-sm btn-primary"onclick='window.print()'>Cetak</button>
</div>
</div>
</form>

<hr>
<?php
$sql="SELECT * FROM undian $q";
$result = query($db,$sql);
$total = mysqli_num_rows($result);

if($total > 0){
    echo"Jumlah:$total<br>";
    echo"<table class='table table-bordered table-striped'border='1'cellpadding='4'cellspacing='0'>
    <tr><th width='200'>Imej</td><th>Undian</td><th class='text-end'>Tindakan</td></tr>";
    while($row = mysqli_fetch_array($result)){
        $idundian = $row['idundian'];
        $label_undian = $row['label_undian'];
        $masa_tamat = date("j M Y, g:i A", strtotime($row['masa_tamat']));

        if(semak_tamat($row['masa_tamat'])){
            $label_masa="Undian telah tamat:<span style='color:red'>$masa_tamat</span>";
        }else{
            $label_masa="Tarikh tamat undian:<span style='color:green'>$masa_tamat</span>";
        }
        $imej = $row['imej'];
        if(!empty($imej)){
            $img = "<img src='$image_folder/$imej'class='border rounded'alt='Gambar Undian'width='100%'>";
        }else{
            $img = "";
        }
        echo"<tr>
        <td>$img</td><td><b>$idundian:$label_undian</b><br>$label_masa<br>
        <a href='admin_undian_borang.php?id=$idundian'>Edit Maklumat </a>|
        <a href='admin_undian_soalan.php?id=$idundian'>Urus Soalan </a>|
        <a href='javascript:void(0);'onclick='deletethis(\"$idundian\")'>Buang</a>
        </td>
        <td align='right'>
        <a class='btn btn-info btn-sm mb-2'href='undian.php?id=$idundian'>Keputusan</a>
        </td>
        </tr>";
    }
    echo "</table>";
}else{
    echo "Belum ada undian.";
}
include('inc_footer.php');
?>