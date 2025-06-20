<!-- Custom Styles -->
<link href="<?= base_url('assets/css/partials/header.css') ?>?v=1" rel="stylesheet">

<nav class="header-nav-container">
    <div class="nav-content-logo">
        <a href="<?= base_url('dashboard') ?>">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo">
            <span class="navbar-brand h6 text-white ms-2">Sangguniang Panlungsod</span>
        </a>
    </div>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link text-white">
                <i class="bi bi-house-fill"></i>
            </a>
        </li>

        <li class="nav-item notification-btn">
            <a href="#" class="nav-link text-white" data-bs-toggle="offcanvas" data-bs-target="#notificationOffcanvas"
                aria-controls="notificationOffcanvas">
                <i class="bi bi-bell-fill"></i>
                <span > 04 </span>
            </a>
        </li>

        <!-- Menu Button in NAV -->
        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#customMenu">
            <i class="bi bi-grid-3x3-gap-fill"></i>
          </a>
        </li>

    </ul>

</nav>

<!-- Custom Menu as Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="customMenu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a>
    <!-- Add more menu items -->
  </div>
</div>


<!-- Notification Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="notificationOffcanvas" aria-labelledby="notificationLabel">
  <div class="offcanvas-header notif-header">
    <h5 class="offcanvas-title text-white" id="notificationLabel">Notifications</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="d-flex justify-content-end mb-2">
      <button class="btn btn-sm btn-outline-danger" onclick="clearNotifications()">Clear All</button>
    </div>

    <div id="notificationList">
      <!-- Notification Card 1 -->
      <div class="notification-card d-flex flex-column mb-2 border rounded p-2 position-relative" onclick="toggleExpand(this)">
        <div class="d-flex align-items-start justify-content-between w-100">
          <div class="d-flex align-items-start">
            <img src="<?= base_url('assets/images/sir.jpg') ?>" alt="Avatar" class="rounded-circle me-2" width="60" height="60">
            <div>
              <p class="mb-1" style="color: #1b657a;">
                <strong>Joshua Garcia</strong> requested <strong style="color: #1b657a;">Ballpen</strong>
              </p>
              <small class="text-muted">10 minutes ago</small>
            </div>
          </div>
          <div class="dropdown ms-2 d-flex align-items-center">
            <button class="btn btn-sm p-0 border-0 bg-transparent text-muted d-flex align-items-center justify-content-center"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 70px;" onclick="event.stopPropagation();">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#" onclick="markAsRead(this)" style="color: #174251;">Mark as Read</a></li>
              <li><a class="dropdown-item text-danger" href="#" onclick="deleteNotification(this)">Delete</a></li>
            </ul>
          </div>
        </div>
        <div class="expand-section d-none mt-3 ms-5">
          <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-success px-3" onclick="confirmRequest(this)">Confirm</button>
            <button class="btn btn-sm btn-outline-danger px-3" onclick="declineRequest(this)">Decline</button>
          </div>
        </div>
      </div>

      <!-- Notification Card 2 -->
      <div class="notification-card d-flex flex-column mb-2 border rounded p-2 position-relative" onclick="toggleExpand(this)">
        <div class="d-flex align-items-start justify-content-between w-100">
          <div class="d-flex align-items-start">
            <img src="<?= base_url('assets/images/daniel.jpg') ?>" alt="Avatar" class="rounded-circle me-2" width="60" height="60">
            <div>
              <p class="mb-1" style="color: #1b657a;">
                <strong>Daniel Padilla</strong> requested <strong style="color: #1b657a;">Laptop Issuance</strong>
              </p>
              <small class="text-muted">16 minutes ago</small>
            </div>
          </div>
          <div class="dropdown ms-2 d-flex align-items-center">
            <button class="btn btn-sm p-0 border-0 bg-transparent text-muted d-flex align-items-center justify-content-center"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 70px;" onclick="event.stopPropagation();">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#" onclick="markAsRead(this)" style="color: #174251;">Mark as Read</a></li>
              <li><a class="dropdown-item text-danger" href="#" onclick="deleteNotification(this)">Delete</a></li>
            </ul>
          </div>
        </div>
        <div class="expand-section d-none mt-3 ms-5">
          <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-success px-3" onclick="confirmRequest(this)">Confirm</button>
            <button class="btn btn-sm btn-outline-danger px-3" onclick="declineRequest(this)">Decline</button>
          </div>
        </div>
      </div>

      <!-- Informational Notification -->
      <div class="notification-card d-flex flex-column mb-2 border rounded p-2 position-relative">
        <div class="d-flex align-items-start justify-content-between w-100">
          <div class="d-flex align-items-start">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Avatar" class="rounded-circle me-2" width="60" height="60">
            <div>
              <p class="mb-1" style="color: #1b657a;">
                <strong>Log Go</strong> submitted a <strong style="color: #1b657a;">Leave Request</strong> for June 24–26
              </p>
              <small class="text-muted">30 minutes ago</small>
            </div>
          </div>
          <div class="dropdown ms-2 d-flex align-items-center">
            <button class="btn btn-sm p-0 border-0 bg-transparent text-muted d-flex align-items-center justify-content-center"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 70px;" onclick="event.stopPropagation();">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#" onclick="markAsRead(this)" style="color: #174251;">Mark as Read</a></li>
              <li><a class="dropdown-item text-danger" href="#" onclick="deleteNotification(this)">Delete</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!--  Update Notification -->
        <div class="notification-card d-flex flex-column mb-2 border rounded p-2 position-relative" onclick="toggleExpand(this)">
        <div class="d-flex align-items-start justify-content-between w-100">
            <div class="d-flex align-items-start">
            <img src="<?= base_url('assets/images/wiss.jpg') ?>" alt="Avatar" class="rounded-circle me-2" width="60" height="60">
            <div>
                <p class="mb-1" style="color: #1b657a;">
                <strong>Mark Dela Cruz</strong> updated her <strong style="color: #1b657a;">Personal <I></I>nformation</strong>
                </p>
                <small class="text-muted">5 minutes ago</small>
            </div>
            </div>
            <div class="dropdown ms-2 d-flex align-items-center">
            <button class="btn btn-sm p-0 border-0 bg-transparent text-muted d-flex align-items-center justify-content-center"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 70px;" onclick="event.stopPropagation();">
                <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" onclick="markAsRead(this)" style="color: #174251;">Mark as Read</a></li>
                <li><a class="dropdown-item text-danger" href="#" onclick="deleteNotification(this)">Delete</a></li>
            </ul>
            </div>
        </div>
       </div>
    </div>

    <!-- Empty message -->
    <p id="noNotificationsMsg" class="text-muted d-none">You have no new notifications.</p>
  </div>
</div>

<!-- Notification Scripts -->
<script>
  function clearNotifications() {
    document.getElementById('notificationList').innerHTML = '';
    document.getElementById('noNotificationsMsg').classList.remove('d-none');
  }

  function deleteNotification(el) {
    el.closest('.notification-card').remove();
    if (!document.getElementById('notificationList').children.length) {
      document.getElementById('noNotificationsMsg').classList.remove('d-none');
    }
  }

  function markAsRead(el) {
    el.closest('.notification-card').style.opacity = 0.5;
  }

  function toggleExpand(card) {
    if (event.target.tagName === 'BUTTON' || event.target.closest('button')) return;
    const expandSection = card.querySelector('.expand-section');
    if (expandSection) expandSection.classList.toggle('d-none');
  }

  function confirmRequest(button) {
    const section = button.closest('.expand-section');
    button.textContent = 'Confirmed';
    button.disabled = true;
    section.querySelector('.btn-outline-danger').remove();
    button.closest('.notification-card').style.border = '2px solid #198754';
  }

  function declineRequest(button) {
    const section = button.closest('.expand-section');
    button.textContent = 'Declined';
    button.disabled = true;
    section.querySelector('.btn-success').remove();
    button.closest('.notification-card').style.border = '2px solid #dc3545';
  }
</script>
<!-- <script>
  document.addEventListener("DOMContentLoaded", function () {
    fetchNotifications();
  });

  function fetchNotifications() {
    fetch("<?= base_url('portal/notifications/fetchAll') ?>")
      .then(response => response.json())
      .then(data => renderNotifications(data.notifications));
  }

  function renderNotifications(notifications) {
    const container = document.getElementById("notificationList");
    const emptyMsg = document.getElementById("noNotificationsMsg");
    container.innerHTML = "";

    if (!notifications.length) {
      emptyMsg.classList.remove("d-none");
      return;
    }

    emptyMsg.classList.add("d-none");

    notifications.forEach(notif => {
      const card = document.createElement("div");
      card.className = "notification-card d-flex flex-column mb-2 border rounded p-2 position-relative";
      card.setAttribute("onclick", notif.action_required ? "toggleExpand(this)" : "");

      card.innerHTML = `
        <div class="d-flex align-items-start justify-content-between w-100">
          <div class="d-flex align-items-start">
            <img src="${notif.sender_image}" alt="Avatar" class="rounded-circle me-2" width="60" height="60">
            <div>
              <p class="mb-1" style="color: #1b657a;">
                <strong>${notif.sender_name}</strong> ${notif.message}
              </p>
              <small class="text-muted">${notif.created_at}</small>
            </div>
          </div>
          <div class="dropdown ms-2 d-flex align-items-center">
            <button class="btn btn-sm p-0 border-0 bg-transparent text-muted d-flex align-items-center justify-content-center"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 32px; height: 70px;" onclick="event.stopPropagation();">
              <i class="bi bi-three-dots-vertical"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#" onclick="markAsRead(this)" style="color: #174251;">Mark as Read</a></li>
              <li><a class="dropdown-item text-danger" href="#" onclick="deleteNotification(this)">Delete</a></li>
            </ul>
          </div>
        </div>
        ${notif.action_required ? `
        <div class="expand-section d-none mt-3 ms-5">
          <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-success px-3" onclick="confirmRequest(this)">Confirm</button>
            <button class="btn btn-sm btn-outline-danger px-3" onclick="declineRequest(this)">Decline</button>
          </div>
        </div>` : ''}
      `;

      container.appendChild(card);
    });
  }
</script> -->
