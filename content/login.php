<div>
  <fieldset class="fieldset_signup">
    <p class="signup">Login</p>
    <br>

    <form action="/backend/action/login.php" method="post">
      <table class="tabel_info">
        <tr>
          <td class="nama">
            <label for="nama">Nama/Email</label>
          </td>
        </tr>

        <tr>
          <td><input type="text" name="nama" value="<?= isset($_GET['nama']) ? $_GET['nama'] : '' ?>"></td>
        </tr>

        <tr>
          <td class="nama">
            <label for="password">Password</label>
          </td>
        </tr>

        <tr>
          <td><input type="password" name="password" value="<?= isset($_GET['password']) ? $_GET['password'] : '' ?>"></td>
        </tr>

        <tr>
          <td><input type="checkbox" name="remember">Remember me</td>
        </tr>

      </table>

      <div class="footer-login-signup-container">
        <div class="action-button-container">
          <button class="signup_button">Login</button>
          <p class="akun">Belum punya akun ? <a class="link" href="index.php?halaman=signup">Sign Up</a></p>
        </div>
      </div>
    </form>
  </fieldset>
</div>