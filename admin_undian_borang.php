<?php
define("ACCESS", true);
include('inc_header.php');
include_once('inc_setup.php');
semak_tahap('admin');

$idundian = $label_undian = $detail = $imej = "";
$edit_data = 0;

if (isset($_GET['id'])) {
    $idundian = $_GET['id'];
    $sql = "SELECT * FROM undian WHERE idundian = '$idundian' LIMIT 1";
    $result = query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $edit_data = mysqli_fetch_array($result);
        $idundian = $edit_data['idundian'];
        $label_undian = $edit_data['label_undian'];
        $detail = $edit_data['detail'];
        $imej = $edit_data['imej'];

        $masa_tamat = date("Y-m-d H:i:s", strtotime($edit_data['masa_tamat']));
    } else {
        exit("<script>alert('Voting ID not found.');
        window.location.replace('admin_undian_senarai.php');</script>");
    }
}

if (isset($_POST['label_undian']) && !empty($_POST['label_undian'])) {
    $idundian = $_POST['idundian'];
    $idedit = $_POST['idedit'];
    $label_undian = $_POST['label_undian'];
    $detail = $_POST['detail'];

    $masa_tamat = date("Y-m-d H:i:s", strtotime($_POST['masa_tamat']));

    if (isset($_FILES['imej']) && file_exists($_FILES['imej']['tmp_name'])) {
        $i = $_FILES['imej'];
        $file_name = explode('.', $i['name']);
        $file_ext = strtolower(end($file_name));

        if (in_array($file_ext, ['jpeg', 'jpg', 'png', 'bmp', 'gif'])) {
            $location = __DIR__ . '/' . $image_folder . '/';
            $newname = 'undian_' . $idundian . '.' . $file_ext;
            if (move_uploaded_file($i['tmp_name'], $location . $newname)) {
                $imej = $newname;
            }
        }

    }
    if ($edit_data) {
        $sql = "UPDATE IGNORE undian SET idundian='$idundian',label_undian='$label_undian',detail= '$detail',masa_tamat='$masa_tamat',imej='$imej' WHERE idundian='$idedit'";
    } else {
        $sql = "INSERT IGNORE INTO undian (idundian, label_undian, detail, masa_tamat, imej) VALUES('$idundian','$label_undian','$detail','$masa_tamat','$imej')";
    }
    $result = query($db, $sql);

    echo "<script>alert('Successfully saved.');
    window.location.replace('admin_undian_senarai.php');</script>";
}
?>

<h2>Vote Information Form</h2>
<form class="form-group row" method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="idedit" value="<?= $idundian ?>">

    <div class="col">
        <p> <label>ID Vote</label><br>
            <input type='text' name='idundian' value='<?= $idundian; ?>'
                placeholder='Unique Vote ID' required>
        </p>
        <p> <label>Label Vote</label><br>
            <input type='text' name='label_undian' value='<?= $label_undian; ?>'
                placeholder='Vote Title' required>
        </p>

        <div class="mb-2"> <label class="form-label">Detailed Information</label><br>
            <code>Can use HTML or embed code.</code>
            <textarea class="form-control" type='text' name='detail' rows="8" cols="30"><?= htmlspecialchars($detail) ?></textarea>
        </div>
    </div>

    <div class="col">
        <p> <label>Vote Closes On</label><br>
            <input type="datetime-local" step="any" name='masa_tamat' value='<?= $masa_tamat; ?>' required>
        </p>
        <p>
            <?php
            if (!empty($imej)) {
                $img = $image_folder . '/' . $imej;
            } else {
                $img = '';
            }
            echo "<img src='$img' id='imej_preview' class='border rounded' alt='' width='200'>";
            ?>
        <p class="mt-2"><label for='gambar'>Upload Image</label><br>
            <input class="form-control" type="file" name='imej' id='imej' accept='image/*'>
        </p>
        </p>
        <p><button class="btn btn-success" type="submit" value="Save">Save</button> </p>
    </div>
</form>

<?php include('inc_footer.php'); ?>