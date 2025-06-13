<section class="height100vh">
    <div class="background-image"></div>
    <div class="login-form">
        <form METHOD="post" action="./config/registerPROCESS.php">
            <h3>Registrasi</h3>

            <label for="email" class="labelBold">Email</label>
            <input type="text" id="email" name="email">

            <label for="username" class="labelBold">Username</label>
            <input type="text" id="username" name="username">

            <label for="password" class="labelBold">Password</label>
            <input type="password" id="password" name="password">

            <label for="cpassword" class="labelBold">Konfirmasi Password</label>
            <input type="password" id="cpassword" name="cpassword">

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Saya Menerima <a href="#">Syarat dan Ketentuan</a></label>
                </div>
            </div>

            <button type="submit">Registrasi</button>
            <div class="textdaftar">
                <p>Sudah memiliki akun? <a href="index.php?page=login">Login</a></p>
            </div>
        </form>
    </div>
</section>