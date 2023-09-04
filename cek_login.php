// functions.php
<?php
function check_login() {
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }
}
?>
