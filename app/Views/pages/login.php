<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ;?>


<!-- Custom authentication page styles -->
  <link href="<?= base_url('assets/css/auth.css') ?>" rel="stylesheet">
<?= $this->endSection() ;?>


<?= $this->section('content') ?>

<!-- Login/Register container with logo and headings -->
<div class="glass-container text-center">

  <!-- Application logo -->
  <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" width="150">

  <!-- System short name -->
  <h4 class="mt-3 text-info fw-bold">SPSO</h4>

  <!-- System full name/description -->
  <h5 class="text-white">Management Information System</h5>

  <!-- Login Form Wrapper (default visible) -->
  <div id="loginFormWrapper">
    <form id="loginForm" action="<?= base_url('auth/login') ?>" method="post" autocomplete="new-password">
      
      <!-- Email input field with icon -->
      <div class="mb-3 input-group">
        <span class="input-group-text bg-transparent border-end-0">
          <i class="bi bi-person-fill"></i>
        </span>
        <input type="text" name="email" class="form-control border-start-0" placeholder="Email" required>
      </div>

      <!-- Password input field with icon -->
      <div class="mb-3 input-group">
        <span class="input-group-text bg-transparent border-end-0">
          <i class="bi bi-lock-fill"></i>
        </span>
        <input type="password" name="password" class="form-control border-start-0" placeholder="Password" required>
      </div>

      <!-- Login button with loading spinner -->
      <button type="submit" id="loginButton" class="btn btn-primary w-100">
        <span class="btn-text">
          <i class="bi bi-box-arrow-in-right me-2"></i>Login
        </span>
        <span class="spinner spinner-border spinner-border-sm d-none"></span>
      </button>

      <!-- Display login error message if available -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="mt-3 p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
          <?= session()->getFlashdata('error'); ?>
        </div>
      <?php endif; ?>
    </form>

    <!-- Link to switch to Forgot Password form -->
    <p class="mt-3 text-center">
      <a href="#" id="showForgotPassword" class="text-white small">Forgot password?</a>
    </p>
  </div>

  <!-- Forgot Password Form Wrapper (initially hidden) -->
  <div id="forgotPasswordWrapper" style="display: none;">
    <h5 class="mb-4 text-center">Forgot Password?</h5>

    <form id="forgotPasswordForm" method="post" action="<?= base_url('forgot-password') ?>">
      <!-- Email input for password reset -->
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <!-- Submit button for OTP request -->
      <button type="submit" id="submitButton" class="btn btn-primary w-100">
        <span class="btn-text">Send OTP</span>
        <span class="spinner spinner-border spinner-border-sm d-none"></span>
      </button>
    </form>

    <!-- Link to go back to the Login form -->
    <p class="mt-3 text-center">
      <a href="#" id="backToLogin" class="text-white small">
        <i class="bi bi-arrow-left"></i> Back to Login
      </a>
    </p>
  </div>

</div>
<?= $this->endSection() ?>


<?= $this->section('footer') ;?>
  <!-- Footer section -->
  <footer class="bg-dark text-white text-center py-2 small">
    <p class="mb-0">&copy; <?= date('Y') ?> SLSU OJT. All rights reserved.</p>
  </footer>
<?= $this->endSection() ;?>


<?= $this->section('scripts') ;?>
<!-- JavaScript to toggle between login and forgot password forms -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const loginFormWrapper = document.getElementById('loginFormWrapper');
    const forgotPasswordWrapper = document.getElementById('forgotPasswordWrapper');

    // Show Forgot Password form
    document.getElementById('showForgotPassword').addEventListener('click', function (e) {
      e.preventDefault();
      loginFormWrapper.style.display = 'none';
      forgotPasswordWrapper.style.display = 'block';
    });

    // Back to Login form
    document.getElementById('backToLogin').addEventListener('click', function (e) {
      e.preventDefault();
      forgotPasswordWrapper.style.display = 'none';
      loginFormWrapper.style.display = 'block';
    });
  });
</script>
<?= $this->endSection() ;?>

