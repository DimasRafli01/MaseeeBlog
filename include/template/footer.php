<?php
global $conn;
global $query_kategori;
global $cari;
global $data_per_halaman;

mysqli_data_seek($query_kategori, 0);
$query_footer = $query_kategori;

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
                <p>Jl. Lorem No. 123, Kota Medan, Sumatera Utara</p>
                <p>info@maseeeblog.com</p>
                <p>+62 812 3456 7890</p>
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
                        <?php
                        if ($query_footer instanceof mysqli_result && mysqli_num_rows($query_footer) > 0) {
                            while (
                                $rowkategori = mysqli_fetch_assoc($query_footer)
                            ) {
                                ?>
                                <li class="list-group-item"><a href="?page=blog&kategori=<?php echo htmlspecialchars($rowkategori['idkategori']);
                                if (!empty($cari)) {
                                    echo '&cari=' . urlencode(htmlspecialchars($cari));
                                }
                                if (isset($data_per_halaman) && $data_per_halaman !== 5) {
                                    echo '&data_per_halaman=' . htmlspecialchars($data_per_halaman);
                                }
                                ?>"
                                        class="text-decoration-none text-gray-700 d-block"><?php echo htmlspecialchars($rowkategori['namakategori']) ?></a>
                                </li>
                            <?php }
                        } else {
                            echo '<li class="list-group-item text-muted">Tidak ada kategori.</li>';
                        } ?>
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