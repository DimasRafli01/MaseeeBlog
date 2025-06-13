<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Nama Website Anda</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengatur font-family secara global dan dasar styling */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f3f4f6; /* Warna latar belakang umum */
        }

        /* Gaya tambahan untuk flexbox pada elemen utama */
        .main-content {
            display: flex;
            flex-grow: 1; /* Agar konten utama mengisi sisa tinggi */
            padding: 20px;
            gap: 20px; /* Jarak antar kolom */
            max-width: 1200px; /* Lebar maksimum untuk konten utama */
            margin: 0 auto; /* Pusatkan konten utama */
        }

        /* Gaya untuk sidebar */
        .sidebar {
            width: 300px; /* Lebar tetap untuk sidebar */
            flex-shrink: 0; /* Mencegah sidebar mengecil */
            background-color: #ffffff;
            border-radius: 12px; /* Sudut membulat */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Sedikit bayangan */
            display: flex;
            flex-direction: column;
            gap: 20px; /* Jarak antar bagian di sidebar */
        }

        /* Gaya untuk area posting blog */
        .blog-posts {
            flex-grow: 1; /* Agar area posting blog mengisi sisa lebar */
            background-color: #ffffff;
            border-radius: 12px; /* Sudut membulat */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Sedikit bayangan */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column; /* Ubah tata letak menjadi kolom di layar kecil */
                padding: 15px;
            }
            .sidebar {
                width: 100%; /* Sidebar mengisi penuh lebar */
                margin-bottom: 20px;
            }
            .header-right .menu ul {
                flex-direction: column;
                align-items: flex-end;
            }
            .header-right .menu li {
                margin: 5px 0;
            }
            .header-right {
                flex-direction: column;
                align-items: flex-end;
            }
            /* Sesuaikan layout search/pagination di mobile agar rapi */
            .main-posts-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px; /* Tambahkan jarak antar elemen */
            }
            .search-bar {
                width: 100%; /* Search bar mengambil lebar penuh */
            }
            .search-bar input {
                width: calc(100% - 40px); /* Sesuaikan lebar input agar tombol pas */
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <aside class="sidebar">
            <div class="sidebar-categories">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Kategori</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="block p-2 rounded-md hover:bg-gray-100 text-gray-700 transition-colors duration-200">Teknologi</a></li>
                    <li><a href="#" class="block p-2 rounded-md hover:bg-gray-100 text-gray-700 transition-colors duration-200">Gaya Hidup</a></li>
                    <li><a href="#" class="block p-2 rounded-md hover:bg-gray-100 text-gray-700 transition-colors duration-200">Kuliner</a></li>
                    <li><a href="#" class="block p-2 rounded-md hover:bg-gray-100 text-gray-700 transition-colors duration-200">Pendidikan</a></li>
                    <li><a href="#" class="block p-2 rounded-md hover:bg-gray-100 text-gray-700 transition-colors duration-200">Bisnis</a></li>
                    <li><a href="#" class="block p-2 rounded-md hover:bg-gray-100 text-gray-700 transition-colors duration-200">Kesehatan</a></li>
                </ul>
            </div>
        </aside>

        <main class="blog-posts">
            <div class="main-posts-controls flex justify-between items-center mb-6 flex-wrap gap-4">
                <div class="pagination-view flex items-center gap-2">
                    <label for="itemsPerPage" class="text-gray-700 text-sm font-medium">Tampilkan:</label>
                    <select id="itemsPerPage" class="p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="search-bar flex items-center space-x-2">
                    <input type="text" placeholder="Cari artikel..." class="p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm w-full">
                    <button class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>

            <h1 class="text-3xl font-bold text-gray-800 mb-6">Berita Terbaru</h1>

            <article class="blog-post bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-200">
                <img src="https://placehold.co/800x450/E0E0E0/333333?text=Gambar+Artikel+1" alt="Gambar Artikel 1" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-2"><a href="#" class="hover:text-blue-600 transition-colors duration-200">Inovasi Terbaru dalam Dunia AI yang Mengubah Lanskap Industri</a></h2>
                <p class="text-sm text-gray-500 mb-3">Dipublikasikan pada 10 Juni 2024 oleh <span class="font-medium">Tim Penulis</span></p>
                <p class="text-gray-700 leading-relaxed mb-4">Artikel ini membahas terobosan terbaru di bidang kecerdasan buatan, dampaknya pada berbagai sektor, dan bagaimana AI akan membentuk masa depan pekerjaan dan kehidupan sehari-hari...</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Baca Selengkapnya &rarr;</a>
            </article>

            <article class="blog-post bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-200">
                <img src="https://placehold.co/800x450/D0D0D0/444444?text=Gambar+Artikel+2" alt="Gambar Artikel 2" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-2"><a href="#" class="hover:text-blue-600 transition-colors duration-200">Panduan Lengkap Membangun Kebiasaan Produktif di Era Digital</a></h2>
                <p class="text-sm text-gray-500 mb-3">Dipublikasikan pada 05 Juni 2024 oleh <span class="font-medium">Admin Blog</span></p>
                <p class="text-gray-700 leading-relaxed mb-4">Temukan strategi dan tips praktis untuk meningkatkan produktivitas Anda di tengah banyaknya distraksi digital. Artikel ini akan memandu Anda menciptakan rutinitas yang efektif...</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Baca Selengkapnya &rarr;</a>
            </article>

            <article class="blog-post bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-200">
                <img src="https://placehold.co/800x450/C0C0C0/555555?text=Gambar+Artikel+3" alt="Gambar Artikel 3" class="w-full h-48 object-cover rounded-md mb-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-2"><a href="#" class="hover:text-blue-600 transition-colors duration-200">Destinasi Wisata Tersembunyi di Indonesia yang Wajib Dikunjungi</a></h2>
                <p class="text-sm text-gray-500 mb-3">Dipublikasikan pada 01 Juni 2024 oleh <span class="font-medium">Jelajah Nusantara</span></p>
                <p class="text-gray-700 leading-relaxed mb-4">Indonesia kaya akan keindahan alam yang belum banyak terekspos. Artikel ini akan membawa Anda menjelajahi beberapa permata tersembunyi yang menawarkan pengalaman tak terlupakan...</p>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Baca Selengkapnya &rarr;</a>
            </article>

            <div class="pagination flex justify-center items-center space-x-2 mt-8">
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">Previous</button>
                <span class="px-4 py-2 border border-blue-600 bg-blue-600 text-white rounded-lg font-bold">1</span>
                <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">2</a>
                <a href="#" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">3</a>
                <span class="px-4 py-2 text-gray-500">...</span>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">Next</button>
            </div>
        </main>
    </div>
</body>
</html>