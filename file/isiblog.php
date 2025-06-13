<?php
require_once 'config/db.php';



$idblog = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($idblog > 0) {

    $sql_detail_blog = "SELECT
    blog.idblog,
    blog.penulis,
    blog.tanggalbuat,
    blog.judul,
    blog.isi,
    kategori.namakategori
FROM
    blog
JOIN
    kategori ON blog.idkategori = kategori.idkategori WHERE idblog = ?;";

    $stmt_detail = mysqli_prepare($conn, $sql_detail_blog);

    if ($stmt_detail) {
        mysqli_stmt_bind_param($stmt_detail, "i", $idblog);
        mysqli_stmt_execute($stmt_detail);
        $result_detail = mysqli_stmt_get_result($stmt_detail);
        $blog_data = mysqli_fetch_assoc($result_detail);


        mysqli_stmt_close($stmt_detail);
    } else {
        $blog_data = null;
        error_log("Error preparing detail blog query: " . mysqli_error($conn));
    }

} else {
    $blog_data = null;
}
?>



<style>
    .blog-detail-card {
        padding: 20px;  
    }

    .blog-content {
        line-height: 1.8;
        font-size: 1.1rem;
    }
</style>

<div class="container main-content mt-5 mb-5" style="padding-top: 120px;padding-bottom: 80px;">
    <?php if ($blog_data): ?>
        <article class="card shadow-sm border-0 blog-detail-card">
            <div class="card-body">
                <p class="text-muted mb-2"><small>Kategori: <span
                            class="fw-medium"><?php echo ($blog_data['namakategori']); ?></span></small></p>

                <h1 class="card-title fw-bold mb-3"><?php echo ($blog_data['judul']); ?></h1>

                <p class="card-subtitle text-muted mb-4"><small>Dipublikasikan pada
                        <?php echo ($blog_data['tanggalbuat']); ?> oleh <span
                            class="fw-medium"><?php echo ($blog_data['penulis']); ?></span></small>
                </p>

                <div class="blog-content mb-4">
                    <?php echo nl2br(($blog_data['isi'])); ?>
                </div>

                <a href="index.php?page=blog" class="btn btn-primary">&larr; Kembali ke Berita</a>
            </div>
        </article>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert">
            Artikel tidak ditemukan atau ID tidak valid.
        </div>
        <div class="text-center">
            <a href="index.php?page=blog" class="btn btn-primary">&larr; Kembali ke Berita</a>
        </div>
    <?php endif; ?>
</div>