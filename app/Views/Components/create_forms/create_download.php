



<!-- Modal Scrollable Body Wrapper -->
<div class="modal-body-scroll">

  <!-- Grid Form Layout -->
  <div class="modal-form-grid">
    
    <!-- File Title -->
    <!-- <div class="mb-3 full-width">
      <label class="field-label">
        Title <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter a file title"></i>
      </label>
      <input type="text" name="file_name" placeholder="Filename" class="modal-input" required />
    </div> -->

    <!-- File Upload -->
   <div class="mb-3 full-width">
        <label class="field-label">
            Add Attachment
            <i class="fa fa-paperclip tooltip-icon" data-bs-toggle="tooltip" title="Upload a file (PDF, DOCX, etc.)"></i>
        </label>
        <div class="custom-file-upload">
            <label for="file" class="upload-btn">
             Choose File
            </label>
            <span id="file-name" class="file-name">No file chosen</span>
            <input type="file" name="file" id="file" class="modal-input file-hidden" />
        </div>
    </div>


    <!-- Description / Remarks -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Remarks <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Add a description or comment about the file"></i>
      </label>
      <textarea name="remarks" placeholder="Remarks" class="modal-input" required rows="3"></textarea>
    </div>

    <!-- Permission Level -->
    <div class="mb-3">
      <label class="field-label">
        Permission <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Who can access this file?"></i>
      </label>
      <div class="select-wrapper">
        <select name="permission" class="modal-select" required>
          <option disabled selected value="">Permission</option>
          <option value="Public">Public</option>
          <option value="Private">Private</option>
          <option value="Restricted access">Restricted access</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label class="field-label">
        Status <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Choose the current status of the file"></i>
      </label>
      <div class="select-wrapper">
        <select name="status" class="modal-select" required>
          <option disabled selected value="">Status</option>
          <option value="Available">Available</option>
          <option value="Deleted">Deleted</option>
          <option value="Archived">Archived</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Expiry Date -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Expiry Date <small class="text-danger fs-6">*</small>
        <i class="fa fa-calendar tooltip-icon" data-bs-toggle="tooltip" title="Set expiration date for this file"></i>
      </label>
      <div class="modal-date">
        <input type="date" name="expiry_date" class="modal-input" required />
       
      </div>
    </div>

  </div> <!-- /.modal-form-grid -->

</div> <!-- /.modal-body-scroll -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
</script>

<script>
    document.getElementById('file').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
    document.getElementById('file-name').textContent = fileName;
    });

</script>

