<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Header -->
<style>
    .header-bg {
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
    }

    .btn-login {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem 1.25rem;
    }

    .btn-login:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
        color: white;
    }

    @media (max-width: 767.98px) {
        .navbar-nav {
            flex-direction: column;
            align-items: flex-start;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .navbar-nav .nav-item {
            width: 100%;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
        }

        .navbar-nav .btn-login {
            width: 100%;
            margin-top: 10px;
            margin-left: 0 !important;
        }
    }

    .btn-social {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-social:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>
<header class="header-bg py-3">
    <nav class="navbar navbar-expand-md navbar-light bg-white container">
        <a href="?page=blog" class="logo navbar-brand"><img src="./include/img/logo.png" alt="" style="width:32px;height:32px;">
            MaseeeBlog</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active-blog" aria-current="page" href="?page=blog">Berita</a>
                </li>
                <?php
                if (isset($_SESSION['username'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link text-gray-700" href="index.php?page=admin">Admin Page</a>
                    </li>
                    <li class="nav-item ms-md-3"> <a href="index.php?page=logout" class="btn btn-login">logout</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item ms-md-3"> <a href="index.php?page=login" class="btn btn-login">Login</a>
                    </li>
                    <?php
                }

                ?>
            </ul>
        </div>
    </nav>
</header>
<!-- end header -->