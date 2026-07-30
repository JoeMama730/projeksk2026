<?php
http_response_code(403);
header("Refresh: 4; url=index.php");

if (!isset($_GET['u'])) {
    header("Location: index.php");
    exit();
}
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
            font-size: 1.5em;
            line-height: 2em;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <p>
        Unauthorized access is denied. You are not authorized to continue accessing this file. <br/>Please contact your system administrator for more information.<br />
        You will be redirected to the home page in <b><span id="countdown">5</span> seconds</b>.
    </p>
    <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    <script>
        let seconds = 5;
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
?>