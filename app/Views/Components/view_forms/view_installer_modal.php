<!-- LINK CSS  -->
<link rel="stylesheet" href="<?= base_url('assets/css/view_forms/installer.css'); ?>?v=1">

<div class="modal fade" id="<?= esc($modalId) ?>" tabindex="-1" aria-labelledby="<?= esc($modalIdLabel) ?>"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">

      <form id="<?= esc($formId) ?>" method="post" action="<?= base_url(esc($api)) ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" disabled>  
          <div class="modal-header">
            <h5 class="modal-title" id="<?= esc($modalId) ?>Label"><?= esc($modalTitle) ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

        <div class="modal-body">

            <!-- Start editable layout -->
            <div class="announcement-body">

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
    const form = document.getElementById('viewInstallerForm');
    const toggleBtn = document.getElementById('toggleEditBtn');
    const modalEl = document.getElementById('viewInstallerModal');
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