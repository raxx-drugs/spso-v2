<?= $this->extend('layouts/main') ?>

<!-- Include dashboard-specific CSS -->
<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>?v=1">
<?= $this->endSection() ?>

<!-- Main dashboard content -->
<?= $this->section('content') ?>

  <main class="dashboard-content">
    <div class="hexagon-grid-container" id="hexagonGrid">
      
      <!-- Transition overlay for page effect -->
      <div id="pageTransition"></div>

      <!-- Static Hexagon Layout -->
      <div class="hexagon-row">
        <!-- Employee Portal -->
        <a href="<?= base_url("portal/employee-portal") ?>" class="hexagon-link">
          <div class="hexagon-item">
            <div class="hexagon" data-name="Employee Portal">
              <i class="bi bi-person-circle"></i>
              <span class="hexagon-text">Employee Portal</span>
            </div>
          </div>
        </a>
      </div>

      <div class="hexagon-row">
        <!-- Request -->
        <a href="<?= base_url("request/it-equipment") ?>" class="hexagon-link">
          <div class="hexagon-item">
            <div class="hexagon" data-name="Request">
              <i class="bi bi-file-earmark-text"></i>
              <span class="hexagon-text">Request</span>
            </div>
          </div>
        </a>

        <!-- Attendance -->
        <a href="<?= base_url("attendance/manage-attendance") ?>" class="hexagon-link">
          <div class="hexagon-item">
            <div class="hexagon" data-name="Attendance">
              <i class="bi bi-calendar-check"></i>
              <span class="hexagon-text">Attendance</span>
            </div>
          </div>
        </a>
      </div>

      <div class="hexagon-row">
        <!-- Accomplished -->
        <a href="<?= base_url("accomplishment") ?>" class="hexagon-link">
          <div class="hexagon-item">
            <div class="hexagon" data-name="accomplishment">
              <i class="bi bi-clipboard-check"></i>
              <span class="hexagon-text">Accomplishment</span>
            </div>
          </div>
        </a>

        <!-- Inventory -->
        <a href="<?= base_url("inventory/it-equipment") ?>" class="hexagon-link">
          <div class="hexagon-item">
            <div class="hexagon" data-name="Inventory">
              <i class="bi bi-box"></i>
              <span class="hexagon-text">Inventory</span>
            </div>
          </div>
        </a>

        <!-- Installers -->
        <a href="<?= base_url("installer") ?>" class="hexagon-link">
          <div class="hexagon-item">
            <div class="hexagon" data-name="Installers">
              <i class="bi bi-tools"></i>
              <span class="hexagon-text">Installers</span>
            </div>
          </div>
        </a>
      </div>
    </div>
  </main>
<?= $this->endSection() ?>

<!-- Page transition script -->
<?= $this->section('scripts') ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.hexagon-link');
    const transitionElement = document.getElementById('pageTransition');
    const transitionSpeed = 400;
    let isTransitioning = false;

    // Animate transition on link click
    links.forEach(link => {
      link.addEventListener('click', function (e) {
        if (isTransitioning) {
          e.preventDefault();
          return;
        }

        e.preventDefault();
        isTransitioning = true;

        transitionElement.classList.add('active');
        document.body.classList.add('no-scroll');

        setTimeout(() => {
          window.location.href = link.getAttribute('href');
        }, transitionSpeed);
      });
    });

    // Remove transition overlay after page load
    window.addEventListener('load', () => {
      setTimeout(() => {
        transitionElement.classList.remove('active');
        document.body.classList.remove('no-scroll');
        isTransitioning = false;
      }, 100);
    });
  });
</script>
<?= $this->endSection() ?>
