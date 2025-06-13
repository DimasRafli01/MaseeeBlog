<?php
// index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

//koneksi
require_once 'config/db.php';

if (!isset($conn) || !$conn instanceof mysqli || $conn->connect_error) {
    die("DEBUG: Gagal inisialisasi \$conn di index.php. Pastikan db.php berfungsi.");
}

$query_kategori = mysqli_query($conn, "SELECT * FROM kategori") or die("DEBUG: Kueri kategori gagal di index.php: " . mysqli_error($conn));
$cari = $_GET['cari'] ?? $_POST['cari'] ?? '';
$data_per_halaman = $_GET['data_per_halaman'] ?? $_POST['data_per_halaman'] ?? 5;



// fungsi page
$page = isset($_GET['page']) ? $_GET['page'] : 'blog';

function loadPage($page)
{
  if ($page === 'blog') {
    include 'file/blog.php';
  } else if ($page === 'isiblog') {
    include 'file/isiblog.php';
  } else if ($page === 'login') {
    include 'file/login.php';
  } else if ($page === 'register') {
    include 'file/register.php';
  } else if ($page === 'logout') {
    include 'config/logout.php';
  } else if ($page === 'admin') {
    include 'file/admin/admin.php';
  } else if ($page === 'blogview') {
    include 'file/admin/form/blogview.php';
  } else if ($page === 'blogtambah') {
    include 'file/admin/form/blogtambah.php';
  } else if ($page === 'blogedit') {
    include 'file/admin/form/blogedit.php';
  } else {
    include 'file/error/404.php';
  }
}

if (isset($_GET['proccess'])) {
  $proccess = $_GET['proccess'];
  if ($proccess === 'blogtbh') {
    include 'file/admin/proses/blogtambah.php';
  } elseif ($proccess === 'blogedit') {
    include 'file/admin/proses/blogedit.php';
  } elseif ($proccess === 'bloghapus') {
    include 'file/admin/proses/bloghapus.php';
  } else {
    include 'file/admin/admin.php';
  }
  loadPage($proccess);
}

// Inisialisasi $page
$page = isset($_GET['page']) ? $_GET['page'] : 'blog';

if (isset($_GET['proccess'])) {
    $proccess = $_GET['proccess'];
    if ($proccess === 'blogtbh' || $proccess === 'blogedit_process' || $proccess === 'bloghapus') {
        loadPage($proccess);
        exit();
    } else {
        loadPage($proccess);
    }
}

// alert
if (isset($_GET['login'])) {
    if ($_GET['login'] == 'success') {
        echo "<script>alert('Login berhasil!'); window.location.href = 'index.php?page=blog';</script>";
    } elseif ($_GET['login'] == 'failed') {
        echo "<script>alert('Password salah!'); window.location.href = 'index.php?page=blog';</script>";
    } elseif ($_GET['login'] == 'notfound') {
        echo "<script>alert('Pengguna tidak ditemukan.'); window.location.href = 'index.php?page=blog';</script>";
    } elseif ($_GET['login'] == 'signinsuccess') {
        echo "<script>alert('Registrasi berhasil'); window.location.href = 'index.php?page=blog';</script>";
    }
}

if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'successlogout') {
        echo "<script>alert('Logout berhasil!'); window.location.href = 'index.php?page=blog';</script>";
    }
}

// memanngil page
if (in_array($page, ['admin', 'blogview', 'blogtambah', 'blogedit'])) {
    loadPage($page);
} else if (in_array($page, ['login', 'register'])) {
    include 'include/template/css.php';
    loadPage($page);
    include 'include/template/js.php';
} else {
    include 'include/template/header.php';
    loadPage($page);
    include 'include/template/footer.php';
    include 'include/template/js.php';
}

if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>