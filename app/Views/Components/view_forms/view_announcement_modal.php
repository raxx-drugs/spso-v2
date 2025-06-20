<!-- LINK CSS  -->
<link rel="stylesheet" href="<?= base_url('assets/css/view_forms/announcement.css'); ?>?v=1">

<div class="modal fade" id="<?= esc($modalId) ?>" tabindex="-1" aria-labelledby="<?= esc($modalIdLabel) ?>"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">

      <form id="viewAnnouncementForm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" disabled>
        <div class="modal-header">
          <h5 class="modal-title" id="<?= esc($modalId) ?>Label"><?= esc($modalTitle) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            <!-- Start editable layout -->
            <div class="announcement-body">
              <!-- Title -->  
              <div class="announcement-row-1">
                <h3 id="view_announcement_title" class="announcement-title"><span>ANNOUNCEMENT</span></h3>
              </div>

              <!-- Left Column: Attachments + Remarks -->
              <div class="announcement-row-2-col-1">
                <div class="attachments">
                  <img src="<?= base_url('assets/images/pdsBg.png') ?>" alt="Announcement Image">
                  <div id="announcement_attachments"></div>
                </div>

                <div class="remarks">
                  <label for="announcement_remarks"><strong>Remarks:</strong></label>
                  <textarea id="announcement_description" class="announcement_description" name="announcement_description" disabled>
                  </textarea>
                </div>
              </div>

              <!-- Right Column: Details -->
              <div class="announcement-row-2-col-2">
                <p>
                  <strong>Announcement ID:</strong>
                  <span id="announcement_id" name="id" ></span>
                </p><hr>

                <p>
                  <strong>Description:</strong><br>
                  <input id="announcement_description" name="description" value="This is a sample announcement description." disabled />
                </p><hr>

                <p>
                  <strong>Category:</strong>
                  <input id="announcement_category" name="category" value="Reminder" disabled />
                </p><hr>

                <p>
                  <strong>Status:</strong>
                  <input id="announcement_status" name="status" value="Published" disabled />
                </p><hr>

                <p>
                  <strong>Expiry Date:</strong>
                  <input id="announcement_expiry_date" name="expiry_date" value="June 9, 2025 - 5:00 PM" disabled />
                </p><hr>

                <p>
                  <strong>Date Created:</strong>
                  <span id="announcement_createdAt" name="created" ></span>
                </p><hr>

                <p>
                  <strong>Date Last Updated:</strong>
                  <span id="announcement_updatedAt" name="updated" ></span>
                </p>
              </div>
            </div>

            <!-- end editable layout -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="toggleEditBtn" onclick="toggleInputs()">Edit</button>
          <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Custom Modal Logic -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('viewAnnouncementForm');
    const toggleBtn = document.getElementById('toggleEditBtn');
    const modalEl = document.getElementById('viewAnnouncementModal');
    const saveBtn = document.getElementById('saveBtn');

    // Bootstrap modal instance
    const modalInstance = new bootstrap.Modal(modalEl);

    // Show the modal using JS (optional, or use data-bs-toggle="modal" on a button)
    // modalInstance.show();

    // Handle modal hide: reset fields
    modalEl.addEventListener('hide.bs.modal', () => {
      const inputs = form.querySelectorAll('input, textarea, select');
      inputs.forEach(input => {
        input.disabled = true;
        input.classList.remove('editable-outline');
      });
      toggleBtn.textContent = 'Edit';
      saveBtn.style.display = 'none'; // hide save button on close
    });

    // Toggle editable state
    toggleBtn.addEventListener('click', () => {
      const inputs = form.querySelectorAll('input, textarea, select');
      const isDisabled = inputs[0].disabled;

      inputs.forEach(input => {
        input.disabled = !isDisabled;
        input.classList.toggle('editable-outline', !input.disabled);
      });

      toggleBtn.textContent = isDisabled ? 'Disable Edit' : 'Edit';
      saveBtn.style.display = isDisabled ? 'inline-block' : 'none'; // toggle visibility
    });
  });
</script>