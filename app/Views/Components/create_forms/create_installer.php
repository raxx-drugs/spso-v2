<!-- Modal Scrollable Body Wrapper -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">

    <!-- Installer Picture -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Picture
        <i class="fa fa-image tooltip-icon" data-bs-toggle="tooltip" title="Upload an image of the installer"></i>
      </label>
      <div class="custom-file-upload">
        <label for="image" class="upload-btn">Choose Image</label>
        <span id="image-name" class="file-name">No file chosen</span>
        <input type="file" name="image" id="image" accept="image/*" class="modal-input file-hidden" />
      </div>
    </div>

    <!-- Installer Name -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Installer Name <small class="text-danger fs-6">*</small>
        <i class="fa fa-user tooltip-icon" data-bs-toggle="tooltip" title="Enter the installer's full name"></i>
      </label>
      <input type="text" name="name" placeholder="Installer Name" class="modal-input" required />
    </div>

    <!-- Description -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Description
        <i class="fa fa-align-left tooltip-icon" data-bs-toggle="tooltip" title="Provide a brief description of the installer"></i>
      </label>
      <textarea name="description" placeholder="Description" class="modal-input" rows="3"></textarea>
    </div>

    <!-- Attachment -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Attachment
        <i class="fa fa-paperclip tooltip-icon" data-bs-toggle="tooltip" title="Upload related files (PDF, DOCX, etc.)"></i>
      </label>
      <div class="custom-file-upload">
        <label for="file" class="upload-btn">Choose File</label>
        <span id="file-name" class="file-name">No file chosen</span>
        <input type="file" name="file" id="file" class="modal-input file-hidden" />
      </div>
    </div>

    <!-- Remarks -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Remarks <small class="text-danger fs-6">*</small>
        <i class="fa fa-comment tooltip-icon" data-bs-toggle="tooltip" title="Additional notes or comments about the installer"></i>
      </label>
      <textarea name="remarks" placeholder="Remarks" class="modal-input" rows="3" required></textarea>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label class="field-label">
        Status <small class="text-danger fs-6">*</small>
        <i class="fa fa-info-circle tooltip-icon" data-bs-toggle="tooltip" title="Select current status"></i>
      </label>
      <div class="select-wrapper">
        <select name="status" class="modal-select" required>
          <option disabled selected value="">Status</option>
          <option value="Active">Active</option>
          <option value="Inactive">Inactive</option>
          <option value="Archived">Archived</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

  </div> <!-- /.modal-form-grid -->
</div> <!-- /.modal-body-scroll -->

<!-- Tooltip & File Name Scripts -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (el) {
      new bootstrap.Tooltip(el);
    });

    document.getElementById('file').addEventListener('change', function () {
      const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
      document.getElementById('file-name').textContent = fileName;
    });

    document.getElementById('image').addEventListener('change', function () {
      const imageName = this.files[0] ? this.files[0].name : 'No file chosen';
      document.getElementById('image-name').textContent = imageName;
    });
  });
</script>
