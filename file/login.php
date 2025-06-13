<div class="background-image"></div>
<section class="height100vh">
    <div class="login-form">
        <form method="post" action="./config/loginPROCESS.php">
            <h3>Login</h3>

            <label for="email" class="labelBold">Email</label>
            <input type="text" id="email" name="email">

            <label for="password" class="labelBold">Password</label>
            <input type="password" id="password" name="password">

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat Saya</label>
                </div>
                <a href="#" style="margin-left: 30px;">Lupa Kata Sandi?</a>
            </div>

            <button type="submit">Masuk</button>
            <div class="textdaftar">
                <p>Belum memiliki akun? <a href="index.php?page=register">Daftar</a></p>
            </div>
        </form>
    </div>
</section>