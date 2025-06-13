<?php
include 'config/db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo "ID tidak valid.";
    exit;
}

$query = mysqli_query($conn, "SELECT * FROM blog WHERE idblog = $id");
$row = mysqli_fetch_assoc($query);

if (!$row) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .card {
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }

        .blog-details {
            line-height: 1.7;
            /* Meningkatkan line height untuk keterbacaan */
        }

        .blog-title {
            font-size: 2.2rem;
            /* Lebih besar dari card title */
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
            /* Warna yang sedikit lebih gelap */
        }

        .author-date {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 20px;
            display: flex;
            /* Menggunakan flexbox untuk layout */
            justify-content: space-between;
            /* Memisahkan penulis dan tanggal */
            align-items: center;
            /* Mengalign item secara vertikal di tengah */
        }

        .author {
            font-weight: bold;
        }

        .post-date {
            font-style: italic;
        }

        .blog-content {
            font-size: 1.1rem;
            /* Ukuran font yang lebih besar untuk isi konten */
            color: #444;
            /* Warna teks yang sedikit lebih gelap untuk konten */
            margin-bottom: 25px;
            /* Margin bottom yang lebih besar */
            white-space: pre-line; /* mempertahankan newlines */
        }

        .back-button {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="card-title">Detail Blog</h2>
            <div class="blog-details">
                <h3 class="blog-title"><?php echo $row['judul']; ?></h3>
                <div class="author-date">
                    <span class="author">Penulis: <?php echo $row['penulis']; ?></span>
                    <span class="post-date">Tanggal: <?php echo $row['tanggalbuat']; ?></span>
                </div>
                <p class="blog-content"><?php echo $row['isi']; ?></p>
                <a href="index.php?page=admin" class="btn btn-secondary back-button">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
