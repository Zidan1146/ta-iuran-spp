<div>
  <fieldset class="fieldset_signup">
    <p class="signup">Sign Up</p>
    <br>

    <form action="<?= "/backend/action/signup.php" ?>" method="post">
      <table class="tabel_info">
        <tr>
          <td class="nama">
            <label for="nama">
              Nama
            </label>
          </td>
        </tr>

        <tr>
          <td>
            <input type="text" name="nama" id="nama" value="<?= isset($_GET['nama']) ? $_GET['nama'] : '' ?>">
          </td>
        </tr>

        <tr>
          <td class="nama">
            <label for="nisn">
              NISN
            </label>
          </td>
        </tr>

        <tr>
          <td>
            <input type="text" name="nisn" id="nisn" value="<?= isset($_GET['nisn']) ? $_GET['nisn'] : '' ?>">
        </td>
        </tr>

        <tr>
          <td class="nama">
            <label for="email">
              Email
            </label>
          </td>
        </tr>

        <tr>
          <td>
            <input type="email" name="email" id="email" <?= isset($_GET['email']) ? $_GET['email'] : '' ?>>
          </td>
        </tr>

        <tr>
          <td class="nama">
            <label for="password">
              Password
            </label>
          </td>
        </tr>

        <tr>
          <td>
            <input type="password" name="password" id="password" <?= isset($_GET['password']) ? $_GET['password'] : '' ?>>
          </td>
        </tr>
      </table>
      <div class="footer-login-signup-container">
        <div class="action-button-container">
          <button class="signup_button">Register</button>
          <p class="akun">Sudah punya akun ? <a class="link" href="index.php?halaman=login">Login</a></p>
        </div>
      </div>
    </form>

  </fieldset>
</div>