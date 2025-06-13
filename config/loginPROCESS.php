<?php
session_start();

require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = clean_input($_POST['email']);
    $password = clean_input($_POST['password']);

    // Query untuk mencari pengguna
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi kata sandi (gunakan password_hash() dan password_verify() untuk keamanan)
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['uname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            if ($role == 1) {
                header("Location: ../index.php?page=admin&login=success"); // Parameter success
            }
            header("Location: ../index.php?page=blog&login=success"); // Parameter success
            exit();
        } else {
            header("Location: ../index.php?page=login&login=failed"); // Parameter failed
        }
    } else {
        header("Location: ../index.php?page=login&login=notfound"); // Parameter notfound
    }
}
?>