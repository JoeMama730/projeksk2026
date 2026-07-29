<?php
include_once('inc_setup.php');

if (!defined("ACCESS")) {
    http_response_code(403);
    header("Refresh: 4; url=index.php");
?>
    <!DOCTYPE html>
    <html lang="ms">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unauthorized Access</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <style>
            body {
                font-family: sans-serif;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
                font-size: 1.4em;
                line-height: 2em;
                background-color: #f8f9fa;
            }
        </style>
    </head>

    <body>
        <p>
            Unauthorized access is denied. You are not authorized to continue accessing this file. Please contact your system administrator for more information.<br />
            You will be redirected to the home page in <b><span id="countdown">4</span> seconds</b>.
        </p>
        <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <script>
            let seconds = 4;
            const countdownElement = document.getElementById('countdown');

            const timer = setInterval(() => {
                seconds--;
                if (seconds > 0) {
                    countdownElement.textContent = seconds;
                } else {
                    clearInterval(timer);
                    window.location.href = "index.php";
                }
            }, 1000);
        </script>
    </body>

    </html>
<?php
    exit();
}
?>

<!DOCTYPE html>
<footer class="footer mt-auto py-3">
    <div class="container">
        <a href="ketetapan.php" class="btn btn-sm btn-outline-dark"><b>Preferences</b></a>
        &nbsp;&copy; All Rights Reserved.
    </div>
</footer>

</div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    // Skrip untuk tambah pilihan jawapan undian
    function tambah_jawapan() {
        var original = document.getElementById("input-jawapan");
        var clone = original.cloneNode(true);
        var inputs = clone.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
        }
        original.parentNode.insertBefore(clone, original.nextSibling);
    }

    // Skrip untuk paparkan popup pengesahan Buang 
    function deletethis(val) {
        if (confirm("Are you sure you want to discard it?") == true) {
            let currentUrl = window.location.href;
            // semak jika url dah ada parameter
            if (currentUrl.indexOf('?') === -1) {
                // jika belum ada, kita guna ?
                window.location.replace(currentUrl + '?delete=' + val);
            } else {
                // jika dah ada, kita guna &
                window.location.replace(currentUrl + '&delete=' + val);
            }
        }
    }

    // Skrip untuk paparan Tooltip lebih cantik
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
<?php
// Skrip untuk munculkan efek Cursor
if (!empty($cursor)) {
    echo "<script src='js/cursor_multis.js'></script><script>new cursoreffects." . $cursor . "Cursor({ element: document.body })</script>";
}
?>

<script type="text/javascript">
    $("#imej").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imej_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    const path = window.location.pathname;
    const filename = path.substring(path.lastIndexOf('/') + 1);
    const anchor = document.querySelector('a[href="' + filename + '"]');
    if (anchor) {
        anchor.classList.add('activepage');
    }
</script>

</body>

</html>