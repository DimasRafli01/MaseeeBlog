<?php
require_once './config/db.php';

$query_kategori = mysqli_query($conn, "SELECT *FROM kategori");
?>
<footer class="pt-5 pb-4" style="background-color:#dbdbdb">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase fw-bold mb-4"><img src="./include/img/logo.png" alt=""
                        style="width:32px;height:32px;margin-right:10px">MaseeeBlog</h5>
                <p>
                    Kami adalah platform blog yang berdedikasi untuk menyajikan berita, artikel, dan informasi
                    terbaru di berbagai topik menarik.
                </p>
                <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Contoh No. 123, Kota Medan, Sumatera Utara</p>
                <p><i class="bi bi-envelope-fill me-2"></i> info@maseeeblog.com</p>
                <p><i class="bi bi-phone-fill me-2"></i> +62 812 3456 7890</p>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="text-uppercase fw-bold mb-4">Halaman</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php?page=blog" class="text-black text-decoration-none mb-2 d-block">Berita</a>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li><a href="index.php?page=admin" class="text-black text-decoration-none mb-2 d-block">Admin
                                Page</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=login" class="text-black text-decoration-none mb-2 d-block">Login</a>
                        </li>
                        <li><a href="index.php?page=register"
                                class="text-black text-decoration-none mb-2 d-block">Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase fw-bold mb-4">Kategori Populer</h5>
                <ul class="list-unstyled">
                    <ul class="list-group list-group-flush">
                        <?php
                        while (
                            $rowkategori = mysqli_fetch_assoc($query_kategori)
                        ) {
                            ?>
                            <li class="list-group-item"><a href="?page=blog&kategori=<?php echo $rowkategori['idkategori'];
                            // Preserve search and data_per_halaman when changing category
                            if (!empty($cari)) {
                                echo '&cari=' . urlencode(htmlspecialchars($cari));
                            }
                            echo '&data_per_halaman=' . $data_per_halaman;
                            ?>"
                                    class="text-decoration-none text-gray-700 d-block"><?php echo $rowkategori['namakategori'] ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </ul>
            </div>

        </div>
        <hr class="mb-4">
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8 text-center text-md-start">
                <p class="mb-0">&copy; 2025 MaseeeBlog. All Rights Reserved.</p>
            </div>
            <div class="col-md-5 col-lg-4 mt-3 mt-md-0 text-center text-md-end">
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>