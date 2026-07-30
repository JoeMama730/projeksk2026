<?php
define("ACCESS", true);
include_once('inc_setup.php');
include("inc_header.php");
?>
<h2 class="text-center"><b>Welcome To</b></h2>
<br />
<h4 class="text-center" style="font-size: 1.5em; font-weight: 500;">
    Fender Institution <br />
    Digital Voting Site
</h4>
<br />
<?php
if (isset($tahap) && $tahap == 'pelawat') {
    echo '<p class="text-center" style="font-size: 1.2em;">Please <a href="login.php" class="custom-link" style="text-decoration: none;"><b>Login</b></a> to vote.</p>';
}
?>
<br/><br/>
<img class="header-img" src="images/waguri_smile.png" alt="Waguri Smile">
<?php
include("inc_footer.php");
?>