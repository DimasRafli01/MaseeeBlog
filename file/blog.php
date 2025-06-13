<?php
ini_set('display_errors', 1); // Aktifkan ini untuk debugging
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// *** SOLUSI UTAMA ***
// Bawa variabel global dari index.php ke dalam scope lokal blog.php
global $conn; // <<< Ini adalah baris KUNCI yang baru ditambahkan
global $cari; // <<< Pastikan ini juga ada, karena blog.php menggunakannya
global $data_per_halaman; // <<< Pastikan ini juga ada, karena blog.php menggunakannya
global $query_kategori; // <<< Juga butuh ini jika blog.php menggunakan $query_kategori dari index.php

// Debugging (opsional, bisa dihapus setelah fix):
if (!isset($conn) || !$conn instanceof mysqli) {
    die("DEBUG: \$conn tidak valid di blog.php (setelah 'global \$conn;').");
}
if (!isset($query_kategori) || !$query_kategori instanceof mysqli_result) {
    die("DEBUG: \$query_kategori tidak valid di blog.php (setelah 'global \$query_kategori;').");
}

if (isset($_POST['data_per_halaman'])) {
    $data_per_halaman = (int) $_POST['data_per_halaman'];
} elseif (isset($_GET['data_per_halaman'])) {
    $data_per_halaman = (int) $_GET['data_per_halaman'];
} else {
    $data_per_halaman = 5;
}
$data_per_halaman = max(1, $data_per_halaman);

$cari = '';
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
} elseif (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}

$C = '';
if (isset($_GET['kategori'])) {
    $C = $_GET['kategori'];
} elseif (isset($_POST['kategori'])) {
    $C = $_POST['kategori'];
}

$where_clauses = [];
if (!empty($cari)) {
    $where_clauses[] = "(penulis LIKE '%$cari%' OR judul LIKE '%$cari%' OR isi LIKE '%$cari%')";
}
if (!empty($C)) {
    $where_clauses[] = "idkategori LIKE '%$C%'";
}

$where_sql = '';
if (!empty($where_clauses)) {
    $where_sql = " WHERE " . implode(" AND ", $where_clauses);
}

$query_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM blog" . $where_sql);
$row_total = mysqli_fetch_assoc($query_total);
$total_data = $row_total['total'];
$total_halaman = ceil($total_data / $data_per_halaman);

$halaman_saat_ini = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$halaman_saat_ini = max(1, min($halaman_saat_ini, $total_halaman));

$offset = ($halaman_saat_ini - 1) * $data_per_halaman;

$query_blog = mysqli_query($conn, "SELECT * FROM blog" . $where_sql . " ORDER BY idblog ASC LIMIT $data_per_halaman OFFSET $offset");


function limit_words($text, $limit, $ellipsis = '...')
{
    $words = preg_split('/\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

    if (count($words) <= $limit) {
        return $text;
    }

    $limited_words = array_slice($words, 0, $limit);

    return implode(' ', $limited_words) . $ellipsis;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaseeeBlog</title>
    <style>
        body {
            padding-top: 100px;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f3f4f6;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px 0;
        }

        .logo {
            color: #212529;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .nav-link.active-blog {
            color: #0d6efd !important;
            font-weight: bold;
        }

        .sidebar .list-group-item {
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.3rem;
            transition: background-color 0.2s ease-in-out;
        }

        .sidebar .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .blog-post .card-title a {
            text-decoration: none;
            color: #212529;
        }

        .blog-post .card-title a:hover {
            color: #0d6efd;
        }

        .blog-post .read-more {
            text-decoration: none;
            color: #0d6efd;
        }

        .blog-post .read-more:hover {
            color: #0a58ca;
        }

        .btn-search {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .btn-search:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .pagination .page-item .page-link {
            color: #6c757d;
        }

        .pagination .page-item .page-link:hover {
            background-color: #e9ecef;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <div class="container main-content">
        <div class="row w-100">
            <aside class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h3 class="card-title fs-5 fw-semibold text-gray-800 mb-3">Kategori</h3>
                        <ul class="list-group list-group-flush">
                            <?php
                            while (
                                $rowkategori = mysqli_fetch_assoc($query_kategori)
                            ) {
                                ?>
                                <li class="list-group-item"><a href="?page=blog&kategori=<?php echo $rowkategori['idkategori']; 
                                    // Preserve search and data_per_halaman when changing category
                                    if (!empty($cari)) { echo '&cari=' . urlencode(htmlspecialchars($cari)); }
                                    echo '&data_per_halaman=' . $data_per_halaman;
                                    ?>"
                                        class="text-decoration-none text-gray-700 d-block"><?php echo $rowkategori['namakategori'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </aside>

            <main class="col-md-9">
                <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <label for="itemsPerPage" class="form-label text-gray-700 mb-0 me-2">Tampilkan:</label>
                        <form action="" method="post" class="d-flex align-items-center mb-0">
                            <select id="itemsPerPage" class="form-select form-select-sm" name="data_per_halaman"
                                onchange="this.form.submit()">
                                <option value="5" <?php if ($data_per_halaman == 5)
                                    echo 'selected'; ?>>5</option>
                                <option value="10" <?php if ($data_per_halaman == 10)
                                    echo 'selected'; ?>>10</option>
                                <option value="20" <?php if ($data_per_halaman == 20)
                                    echo 'selected'; ?>>20</option>
                                <option value="50" <?php if ($data_per_halaman == 50)
                                    echo 'selected'; ?>>50</option>
                            </select>
                            <?php
                            // Mempertahankan nilai pencarian saat dropdown "Tampilkan" diubah
                            if (!empty($cari)) {
                                echo '<input type="hidden" name="cari" value="' . htmlspecialchars($cari) . '">';
                            }
                            // Mempertahankan nilai kategori saat dropdown "Tampilkan" diubah
                            if (!empty($C)) {
                                echo '<input type="hidden" name="kategori" value="' . htmlspecialchars($C) . '">';
                            }
                            ?>
                        </form>
                    </div>

                    <div class="ms-auto">
                        <form action="" method="post" class="input-group w-auto">
                            <input type="text" class="form-control form-control-sm" placeholder="Cari artikel..."
                                name="cari"
                                value="<?php echo htmlspecialchars($cari); ?>">
                            <button class="btn btn-search btn-sm" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.088.125l3.493 3.493a1 1 0 0 0 1.414-1.414l-3.493-3.493a.75.75 0 0 0-.125-.088zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </button>
                            <?php
                            // Mempertahankan nilai data_per_halaman saat pencarian dilakukan
                            if (isset($data_per_halaman)) {
                                echo '<input type="hidden" name="data_per_halaman" value="' . htmlspecialchars($data_per_halaman) . '">';
                            }
                            // Mempertahankan nilai kategori saat pencarian dilakukan
                            if (!empty($C)) {
                                echo '<input type="hidden" name="kategori" value="' . htmlspecialchars($C) . '">';
                            }
                            ?>
                        </form>
                    </div>
                </div>

                <h1 class="h3 fw-bold text-gray-800 mb-4">Berita Terbaru</h1>

                <?php
                if (mysqli_num_rows($query_blog) > 0) {
                    while ($rowblog = mysqli_fetch_assoc($query_blog)) {
                        $isi_artikel_penuh = $rowblog['isi'];
                        $jumlah_kata_pratinjau = 50;
                        $pra_isi = limit_words($isi_artikel_penuh, $jumlah_kata_pratinjau);
                        ?>
                        <article class="card shadow-sm mb-4 border-0">
                            <div class="card-body">
                                <h2 class="card-title h5 fw-semibold mb-2"><a href="index.php?page=isiblog&id=<?php echo htmlspecialchars($rowblog['idblog']); ?>"
                                        class="text-decoration-none"><?php echo htmlspecialchars($rowblog['judul']); ?></a></h2>
                                <p class="card-subtitle text-muted mb-2"><small>Dipublikasikan pada
                                        <?php echo htmlspecialchars($rowblog['tanggalbuat']); ?> oleh <span
                                            class="fw-medium"><?php echo htmlspecialchars($rowblog['penulis']); ?></span></small></p>
                                <p class="card-text text-gray-700"><?php echo htmlspecialchars($pra_isi); ?></p> <a href="index.php?page=isiblog&id=<?php echo htmlspecialchars($rowblog['idblog']); ?>" class="read-more">Baca Selengkapnya &rarr;</a>
                            </div>
                        </article>
                        <?php
                    }
                } else {
                    ?>
                    <article class="card shadow-sm mb-4 border-0">
                        <div class="card-body">
                            <h2 class="card-title h5 fw-semibold mb-2 text-center">Artikel tidak ditemukan.</h2>
                            <p class="text-center text-muted">Maaf, tidak ada artikel yang sesuai dengan kriteria Anda.</p>
                        </div>
                    </article>
                <?php
                }
                ?>

                <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
                    <ul class="pagination">
                        <?php
                        // Build the base URL for pagination, including existing filters
                        $base_url = 'index.php?page=blog';
                        if (!empty($C)) {
                            $base_url .= '&kategori=' . htmlspecialchars($C);
                        }
                        if (!empty($cari)) {
                            $base_url .= '&cari=' . urlencode(htmlspecialchars($cari));
                        }
                        $base_url .= '&data_per_halaman=' . $data_per_halaman;

                        // Previous button
                        if ($halaman_saat_ini > 1) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="' . $base_url . '&halaman=' . ($halaman_saat_ini - 1) . '" aria-label="Previous">';
                            echo '<span aria-hidden="true">Previous</span>';
                            echo '</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="page-item disabled">';
                            echo '<span class="page-link" aria-disabled="true">Previous</span>';
                            echo '</li>';
                        }

                        // Page numbers
                        for ($i = 1; $i <= $total_halaman; $i++) {
                            $active_class = ($i == $halaman_saat_ini) ? 'active' : '';
                            $current_aria = ($i == $halaman_saat_ini) ? 'aria-current="page"' : '';

                            echo '<li class="page-item ' . $active_class . '">';
                            echo '<a class="page-link" href="' . $base_url . '&halaman=' . $i . '" ' . $current_aria . '>' . $i . '</a>';
                            echo '</li>';
                        }

                        // Next button
                        if ($halaman_saat_ini < $total_halaman) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="' . $base_url . '&halaman=' . ($halaman_saat_ini + 1) . '" aria-label="Next">';
                            echo '<span aria-hidden="true">Next</span>';
                            echo '</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="page-item disabled">';
                            echo '<span class="page-link" aria-disabled="true">Next</span>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </nav>
            </main>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.querySelector('.sidebar');
            const content = document.getElementById('content');

            // This part of the JS is not present in the provided HTML, but kept for completeness based on its purpose
            if (sidebarToggleBtn && sidebar && content) {
                sidebarToggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('collapsed');
                });
            }
        });
    </script>
</body>

</html>