<?php
session_start();
include "db.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$email = $_POST['email'];

$sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssi", $username, $email, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<h3>Profile Updated Successfully!</h3>";
        echo "<a href='edit_profile.php'>Go Back</a>";
    } else {
        echo "<h3>Error updating profile!</h3>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<h3>Failed to prepare SQL statement.</h3>";
}
?>
