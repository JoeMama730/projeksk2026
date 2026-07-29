<?php
define("ACCESS", true);
include_once('inc_setup.php');
include('inc_header.php');
if (isset($_GET['font'])) {

    if ($_GET['font'] == 'plus') {
        $saizfont = $saizfont + 5;
    } elseif ($_GET['font'] == 'minus') {
        $saizfont = $saizfont - 5;
    } else {
        $saizfont = 100;
    }

    $_SESSION['saizfont'] = $saizfont;
    exit("<script> window.location.replace('ketetapan.php'); </script>");
}

$senarai_fonts = ['sans-serif', 'Arial', 'Arial Black', 'Courier New', 'cursive', 'Times New Roman'];
$senarai_cursors = ['Asal', 'fairyDust', 'clock', 'ghost', 'trailing', 'followingDot', 'bubble', 'snowflake'];

if (isset($_POST['jenisfont']) && isset($_POST['cursor'])) {

    $jenisfont = $_POST['jenisfont'];
    $cursor = $_POST['cursor'];

    if (in_array($jenisfont, $senarai_fonts)) {
        $_SESSION['jenisfont'] = $jenisfont;
    }

    if (in_array($cursor, $senarai_cursors)) {
        if ($cursor === "Asal") {
            $_SESSION['cursor'] = '';
        } else {
            $_SESSION['cursor'] = $cursor;
        }
    }

    echo "<script>alert('The preferences have been updated.'); window.location.replace('ketetapan.php');</script>";
}

?>
<h2 style="font-size: 2em; margin-left: 20px;"><b>Page Preferences</b></h2>
<div class="w-50 m-auto">

    <h4>Text Size</h4>
    <p>
        <a class='btn btn-sm btn-success' href='?font=plus'>+</a>
        <a class='btn btn-sm btn-danger' href='?font=minus'>-</a>
        <a class='btn btn-sm btn-info' href='?font=reset'>Reset</a>
    </p>


    <form method="POST" action="ketetapan.php">
        <div class="mb-3">
            <h4>Font Type</h4>
            <select name="jenisfont" class="form-control">
                <?php
                foreach ($senarai_fonts as $font) {
                    $selected = ($font == $jenisfont) ? 'selected' : "";
                    echo "<option $selected value='$font'>$font</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <h4>Cursor Effect</h4>
            <select name="cursor" class="form-control">
                <?php
                foreach ($senarai_cursors as $cur) {
                    $selected = ($cur == $cursor) ? 'selected' : "";
                    echo "<option $selected value='$cur'>$cur</option>";
                }
                ?>
            </select>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-sm btn-primary d-block" type="submit">Save Preferences</button>
        </div>
    </form>

</div>
<?php
include('inc_footer.php');
?>