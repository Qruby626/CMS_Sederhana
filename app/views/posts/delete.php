<?php
include '../../config/connection.php';
$id = $_GET['id'];
if (mysqli_query($conn, "DELETE FROM posts WHERE id=$id")) {
    header('Location: index.php?msg=delete');
} else {
    header('Location: index.php?msg=fail');
}
exit;