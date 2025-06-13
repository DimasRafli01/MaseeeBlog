<?php 
global $conn;             
global $cari;            
global $data_per_halaman;
$query_kategori = mysqli_query($conn, "SELECT *FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.23.0/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #3498db;
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .form-control,
        .form-textarea {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-control:focus,
        .form-textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #217dbb;
        }

        .btn-secondary {
            background-color: #e7e7e7;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: #555;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #ccc;
        }

        .form-textarea {
            resize: vertical;
            height: 150px;
        }

        .form-select {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-select:focus {
            border-color: #3498db;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }

        .form-select option {
            color: #212529;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h2 class="card-title">Tambah Artikel</h2>
            <form method="post" action="index.php?proccess=blogtbh">
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis:</label>
                    <input type="text" id="penulis" name="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul:</label>
                    <input type="text" id="judul" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori:</label>
                    <select name="idkategori" id="kategori" class="form-select" required>
                        <option value="1">Pilih Kategori</option>
                    <?php while (
                                $rowkategori = mysqli_fetch_assoc($query_kategori)
                            ) {
                                ?>
                                <option value="<?php echo $rowkategori['idkategori'] ?>"><?php echo $rowkategori['namakategori'] ?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi:</label>
                    <textarea name="isiartikel" cols="30" rows="10" placeholder="Isi" id="editor"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=admin" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    console.log('CKEditor berhasil diinisialisasi:', editor);
                })
                .catch(error => {
                    console.error('Ada masalah saat menginisialisasi CKEditor:', error);
                });
        });
    </script>
</body>

</html>