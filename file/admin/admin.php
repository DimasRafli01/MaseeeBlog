<?php
include './config/db.php';

// Atur jumlah data per halaman (bisa diubah melalui form atau URL, dengan prioritas ke URL)
if (isset($_POST['data_per_halaman'])) {
    $data_per_halaman = (int) $_POST['data_per_halaman'];
} elseif (isset($_GET['data_per_halaman'])) {
    $data_per_halaman = (int) $_GET['data_per_halaman'];
} else {
    $data_per_halaman = 5;
}
$data_per_halaman = max(1, $data_per_halaman); // Pastikan minimal 1 data per halaman

// Cari data jika ada permintaan pencarian
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM blog WHERE
                                        penulis LIKE '%$cari%' OR judul LIKE '%$cari%'
                                        OR isi LIKE '%$cari%'");
} else {
    $query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM blog");
}
$row_total = mysqli_fetch_assoc($query_total);
$total_data = $row_total['total'];
$total_halaman = ceil($total_data / $data_per_halaman);

// Tentukan halaman saat ini
$halaman_saat_ini = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$halaman_saat_ini = max(1, min($halaman_saat_ini, $total_halaman)); // Validasi nomor halaman

// Hitung offset
$offset = ($halaman_saat_ini - 1) * $data_per_halaman;

// Query untuk mengambil data dengan limit dan offset
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    $query = mysqli_query($conn, "SELECT b.*, k.namakategori
                                  FROM blog b
                                  JOIN kategori k ON b.idkategori = k.idkategori
                                  WHERE b.penulis LIKE '%$cari%'
                                  OR b.judul LIKE '%$cari%'
                                  OR b.isi LIKE '%$cari%'
                                  OR k.namakategori LIKE '%$cari%'
                                  ORDER BY b.idblog ASC
                                  LIMIT $data_per_halaman OFFSET $offset");
} else {
    $query = mysqli_query($conn, "SELECT b.*, k.namakategori
                                  FROM blog b
                                  JOIN kategori k ON b.idkategori = k.idkategori
                                  ORDER BY b.idblog ASC
                                  LIMIT $data_per_halaman OFFSET $offset");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            width: 250px;
            padding-top: 20px;
            flex-shrink: 0;
            transition: width 0.3s ease-in-out;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar-brand {
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid #555;
        }

        .sidebar-menu {
            padding: 0;
            list-style: none;
        }

        .sidebar-menu .nav-item .nav-link {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .sidebar-menu .nav-item .nav-link:hover {
            background-color: #495057;
        }

        .sidebar-menu .nav-item .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar-menu .nav-item.active .nav-link {
            background-color: #0d6efd;
            /* Bootstrap primary color */
            color: white;
        }

        #content {
            flex-grow: 1;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }


        .sidebar.collapsed .sidebar-menu .nav-item .nav-link span {
            display: none;
            /* Sembunyikan elemen span (yang kemungkinan berisi teks) */
        }

        .sidebar.collapsed .sidebar-brand {
            font-size: 1.5rem;
            /* Sesuaikan ukuran font brand agar pas di lebar kecil */
            text-align: center;
        }

        .sidebar.collapsed {
            width: 60px;
            align-items: center;
            /* Center ikon secara vertikal */
        }

        .sidebar.collapsed .sidebar-menu .nav-item .nav-link {
            padding: 10px 15px;
            /* Sesuaikan padding agar ikon tetap di tengah */
            justify-content: center;
            /* Center ikon secara horizontal */
        }

        .sidebar.collapsed .sidebar-menu .nav-item .nav-link i {
            margin-right: 0;
            /* Hilangkan margin kanan ikon */
        }

        .navbar {
            background-color: white;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-toggler-btn {
            background: none;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .dashboard-card {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 0.375rem;
            /* Bootstrap default border-radius */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-body {
            /* Style untuk isi card */
        }

        .data-widget {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 0.375rem;
            /* Bootstrap default border-radius */
            margin-bottom: 15px;
            text-align: center;
        }

        .widget-title {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .widget-value {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .pagination-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pagination-links {
            display: inline-block;
        }

        .pagination-links a,
        .pagination-info {
            padding: 8px 12px;
            margin-right: 5px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
        }

        .pagination-links a:hover {
            background-color: #f0f0f0;
        }

        .pagination-links .active {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            Admin Panel
        </div>
        <ul class="sidebar-menu">
            <li class="nav-item active">
                <a href="#" class="nav-link"><i class="fas fa-tachometer-alt"></i> Blog</a>
            </li>
            <!-- <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users"></i> Users</a>
            </li> -->
            <li class="nav-item">
                <a href="?page=blog" class="nav-link"><i class="fas fa-users"></i> blog page</a>
            </li>
            <!-- <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-box"></i> Products</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-chart-bar"></i> Reports</a>
            </li> -->
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-cog"></i> Settings</a>
            </li>
        </ul>
    </div>

    <div id="content">
        <nav class="navbar">
            <button id="sidebarToggleBtn" class="navbar-toggler-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-flex align-items-center">
                <span class="me-3">Welcome, Admin</span>
                <a href="?page=blog" class="btn btn-sm btn-outline-info" style="margin-right:10px">Blog</a>
                <a href="?page=logout" class="btn btn-sm btn-outline-danger">Logout</a>
            </div>
        </nav>
        <div class="dashboard-card">
            <h5 class="card-title">Daftar Blog</h5>
            <div class="card-body">
                <form action="" method="post" class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Cari..." name="cari">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="data_per_halaman" onchange="this.form.submit()">
                                <option value="5" <?php if ($data_per_halaman == 5)
                                    echo 'selected'; ?>>5 per halaman
                                </option>
                                <option value="10" <?php if ($data_per_halaman == 10)
                                    echo 'selected'; ?>>10 per halaman
                                </option>
                                <option value="20" <?php if ($data_per_halaman == 20)
                                    echo 'selected'; ?>>20 per halaman
                                </option>
                                <option value="50" <?php if ($data_per_halaman == 50)
                                    echo 'selected'; ?>>50 per halaman
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
                <a href="index.php?page=blogtambah" class="btn btn-success mb-3">Tambah</a>
                <table class="table table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <!-- <th>ID</th> -->
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Isi</th>
                            <th colspan="3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1 + $offset;
                        while ($rowp = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <!-- <td><?php 
                                // echo $rowp['idblog']; 
                                ?></td> -->
                                <td><?php echo $rowp['penulis']; ?></td>
                                <td><?php echo $rowp['tanggalbuat']; ?></td>
                                <td><?php echo $rowp['judul']; ?></td>
                                <td><?php echo $rowp['namakategori']; ?></td>
                                <td><?php echo substr($rowp['isi'], 0, 100); ?>...</td>
                                <!-- <td><a href="index.php?page=blogview&id=<?php
                                // echo $rowp['idblog']; 
                                ?>"
                                        class="btn btn-sm btn-info">View</a></td> -->
                                <td><a href="index.php?page=blogedit&id=<?php echo $rowp['idblog']; ?>"
                                        class="btn btn-sm btn-warning">Edit</a></td>
                                <td><a href="index.php?proccess=bloghapus&id=<?php echo $rowp['idblog']; ?>"
                                        class="btn btn-sm btn-danger">Hapus</a></td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>

                <div class="pagination-container">
                    <div class="pagination-info">
                        Halaman <?php echo $halaman_saat_ini; ?> dari <?php echo $total_halaman; ?> (Total
                        <?php echo $total_data; ?> data)
                    </div>
                    <div class="pagination-links">
                        <?php
                        if ($halaman_saat_ini > 1) {
                            echo "<a href='index.php?page=admin&halaman=" . ($halaman_saat_ini - 1) . "&data_per_halaman=" . $data_per_halaman . "#tabel'>Previous</a>";
                        }

                        for ($i = 1; $i <= $total_halaman; $i++) {
                            if ($i == $halaman_saat_ini) {
                                echo "<a href='index.php?page=admin&halaman=$i&data_per_halaman=" . $data_per_halaman . "#tabel' class='active'>$i</a>";
                            } else {
                                echo "<a href='index.php?page=admin&halaman=$i&data_per_halaman=" . $data_per_halaman . "#tabel'>$i</a>";
                            }
                        }

                        if ($halaman_saat_ini < $total_halaman) {
                            echo "<a href='index.php?page=admin&halaman=" . ($halaman_saat_ini + 1) . "&data_per_halaman=" . $data_per_halaman . "#tabel'>Next</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.querySelector('.sidebar');
            const content = document.getElementById('content');

            sidebarToggleBtn.addEventListener('click', function () {
                sidebar.classList.toggle('collapsed');
                content.classList.toggle('collapsed');
            });
        });
    </script>
</body>

</html>