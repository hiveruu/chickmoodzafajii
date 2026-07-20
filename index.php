<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: dashboard.php");
} else {
    header("Location: auth/login.php");
}
exit;
?>
