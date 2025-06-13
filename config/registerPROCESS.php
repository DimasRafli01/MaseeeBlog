<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = clean_input($_POST['email']);
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['cpassword'];

    // Validasi input
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Semua kolom harus diisi.";
    } elseif ($password !== $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok.";
    } else {

        // Periksa apakah email atau username sudah ada
        $check_sql = "SELECT * FROM user WHERE email = '$email' OR uname = '$username'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $error = "Email atau username sudah terdaftar.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Masukkan data ke database
            $insert_sql = "INSERT INTO user (email, uname, password, role) VALUES ('$email', '$username', '$hashed_password' , 1)";

            if ($conn->query($insert_sql) === TRUE) {
                header("Location: ../index.php?page=login&login=signinsuccess");
                exit();
            } else {
                $error = "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        }
    }

    // Tampilkan pesan kesalahan jika ada
    if (isset($error)) {
        echo "<script>alert('$error'); window.history.back();</script>";
    }
}
?>