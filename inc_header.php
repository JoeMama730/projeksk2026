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
        <title>Access denied</title>
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
            Access is denied. You are not authorized to continue accessing this file. Please contact your system administrator for more information.<br />
            You will be redirected to the home page <b><span id="countdown">4</span> seconds</b>.
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
<html>

<head>
    <title><?= $nama_sistem ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- imej icon di Title bar pelayar web -->
    <link rel="icon" href="images/f.png" type="image/png">

    <!-- memanggil bootstrap framework dan library untuk icon -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <style>
        * {
            font-family: <?= $jenisfont ?>, sans-serif;
            font-size: <?= $saizfont ?>%;
        }

        .wrapper {
            border-radius: 24px;
            /* Warna latar box sistem */
            background-color: rgba(255, 255, 255, 0.75) !important;
            max-width: 60%;
            overflow: hidden;
            box-shadow: 0 1px 6px #222;
            margin: auto;
        }

        body {
            /* Imej latar sistem */
            background-image: url('images/Kamikochi-autumn-people.jpg');
            /* Warna latar sistem jika tidak gunakan imej */
            background-color: #6aa8ff;

            z-index: 1;

            margin: 0px;
            padding: 0px;
            flex-direction: column;
            align-items: flex-start;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        /* Tambah jenis warna baru jika perlu */
        .mybg-red {
            background-color: #ff3c2e !important;
        }

        .mybg-purple {
            background-color: purple !important;
        }

        /* Warna semua kotak input */
        input,
        textarea,
        select {
            background-color: #f6fcca !important;
            border: 2px solid #d4cd83;
            border-radius: 8px;
        }

        input:focus,
        textarea:focus {
            background-color: #dedad9 !important;
        }

        /* Warna button bila halaman aktif */
        .activepage {
            background-color: #d9faff !important;
            color: black !important;
        }

        .progress {
            /* Warna untuk LATAR bar keputusan undian */
            background-color: #dedede !important;
            background-image: none;
            -webkit-print-color-adjust: exact;
            box-shadow: inset 0 0;
            -webkit-box-shadow: inset 0 0;
        }

        .progress-bar {
            /* Warna untuk PROGRESS bar keputusan undian */
            background-color: #137dde !important;
            background-image: none;
            -webkit-print-color-adjust: exact;
            box-shadow: inset 0 0;
            -webkit-box-shadow: inset 0 0;
        }
    </style>
</head>

<body>
    <div class="container wrapper min-vh-100 d-flex flex-column">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <img src="images/kii.png" height="100" class="d-flex mb-2 me-lg-4 me-md-0 align-items-center text-decoration-none">
            <div class="d-flex flex-column align-items-center">
                <div class="mt-2 text-center">
                    <h3><strong> <?= $nama_sistem ?> </strong></h3>
                </div>
                <ul class="nav nav-pills ms-2 me-2 m-auto gap-1">
                    <li class="nav-item"><a href="index.php" class="btn-header btn me-2">Home</a></li>
                    <li class="nav-item"><a href="senarai_undian.php" class="btn-header btn me-2">Vote</a></li>
                    <?php
                    if ($tahap == 'admin') {
                        echo "
          <li class='nav-item'><a class='btn-header btn me-2' href='admin_undian_senarai.php'>Manage Votes</a></li>
          <li class='nav-item'><a class='btn-header btn me-2' href='admin_pengguna_senarai.php'>Manage Users</a></li>
          ";
                    }
                    if ($tahap == 'pelawat') {
                        echo "
          <li class='nav-item'><a class='btn-header btn me-2' href='login.php'>Log In</a></li>
          <li class='nav-item'><a class='btn-header btn me-2' href='signup.php'>Sign Up</a></li>";
                    } else {
                        echo "
          <li class='nav-item'><a class='btn-header btn me-2' href='logout.php'>Log Out</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </header>