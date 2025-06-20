<!-- LINK CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/view_forms/download.css'); ?>?v=1">

<div class="modal fade" id="viewDownloadModal" tabindex="-1" aria-labelledby="viewDownloadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <form id="viewDownloadForm" method="post" enctype="multipart/form-data">
        <!-- ilalagay -->
        <input type="hidden" name="_method" value="PUT" disabled> 
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="view_announcement_id" name="announcement_id" disabled>

          <!-- Download Body -->
          <div class="download-body">

            <!-- Row 1: Title & Download Link -->
            <div class="download-row-1">
              <h3 id="view_announcement_title" class="download-title"><span>DOWNLOADS</span></h3>
            </div>

            <!-- Row 2 Column 1: Preview Section -->
            <div class="download-row-2-col-1" >
              <div class="attachments" style="height: 90%;">
                <div class="d-flex align-items-center mb-2">
                  <h5 class="me-4 mb-0">Attachment:</h5>
                  <button type="button" id="fullscreenBtn" class="me-4 btn btn-sm btn-outline-secondary">
                    Fullscreen Preview
                  </button>
                  <a id="downloadOriginalBtn" class="btn btn-sm btn-success" target="_blank">
                    Download File
                  </a>
                </div>
                <div id="announcement_attachments" style="height: 100%;">
                  <div id="filePreviewContainer" style="position: relative; border: 1px solid #ccc; height: 100%; overflow: hidden;">
                    <iframe id="filePreview" src="" width="100%" height="100%" style="border:1px solid #ccc;"></iframe>
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 2 Column 2: File Metadata -->
             <!-- lalagyan   -->
            <div class="download-row-2-col-2">
              <p><strong>Download Id:</strong> <span id="download_id"></span></p><hr>
              <p><strong>Filename:</strong><br><input id="download_file_name" name="file_name" disabled /></p><hr>
              <p><strong>Remarks:</strong><input id="download_remarks" name="remarks" disabled /></p><hr>
              <p><strong>Permission Level:</strong><input id="download_permission" name="permission" disabled /></p><hr>
              <p><strong>Status:</strong><input id="download_status" name="status" disabled /></p><hr>
              <p><strong>Expiry Date:</strong><input id="download_expiry_date" name="expiry_date" disabled /></p><hr>
              <p><strong>Date Created:</strong> <span id="download_createdAt"></span></p><hr>
              <p><strong>Date Updated:</strong> <span id="download_updatedAt"></span></p>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="toggleEditBtn">Edit</button>
          <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Custom Modal Logic -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('viewDownloadForm');
    const toggleBtn = document.getElementById('toggleEditBtn');
    const modalEl = document.getElementById('viewDownloadModal');
    const saveBtn = document.getElementById('saveBtn');

    const modalInstance = new bootstrap.Modal(modalEl);

    modalEl.addEventListener('hide.bs.modal', () => {
      form.querySelectorAll('input, textarea, select').forEach(input => {
        input.disabled = true;
        input.classList.remove('editable-outline');
      });
      toggleBtn.textContent = 'Edit';
      saveBtn.style.display = 'none';
    });

    toggleBtn.addEventListener('click', () => {
      const inputs = form.querySelectorAll('input, textarea, select');
      const isDisabled = inputs[0].disabled;

      inputs.forEach(input => {
        input.disabled = !isDisabled;
        input.classList.toggle('editable-outline', !input.disabled);
      });

      toggleBtn.textContent = isDisabled ? 'Disable Edit' : 'Edit';
      saveBtn.style.display = isDisabled ? 'inline-block' : 'none';
    });
  });

</script>

