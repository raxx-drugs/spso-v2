<!-- Your Custom CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/portal/create_announcement.css') ?>">

<!-- Modal Scrollable Body Wrapper -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">

    <!-- Title -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Title <small class="text-danger fs-6">*</small>
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" title="Enter the announcement title."></i>
      </label>
      <input type="text" name="title" placeholder="Title" class="modal-input" required />
    </div>

    <!-- Description -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Description <small class="text-danger fs-6">*</small>
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" title="Enter the announcement description."></i>
      </label>
      <textarea name="description" placeholder="Description" class="modal-input" rows="3" required></textarea>
    </div>

    <!-- Category -->
    <div class="mb-3">
      <label class="field-label">
        Category <small class="text-danger fs-6">*</small>
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" title="Select the type of announcement."></i>
      </label>
      <div class="select-wrapper">
        <select name="category" class="modal-select" required>
          <option disabled selected value="">Category</option>
          <option value="News">News</option>
          <option value="Event">Event</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label class="field-label">
        Status <small class="text-danger fs-6">*</small>
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" title="Choose the status of the post."></i>
      </label>
      <div class="select-wrapper">
        <select name="status" class="modal-select" required>
          <option disabled selected value="">Status</option>
          <option value="Published">Published</option>
          <option value="Draft">Draft</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Attachment -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Attachment
        <i class="fa fa-paperclip tooltip-icon" data-bs-toggle="tooltip" title="Optional file to attach."></i>
      </label>
      <div class="custom-file-upload">
        <label for="file" class="upload-btn">Choose File</label>
        <span id="file-name" class="file-name">No file chosen</span>
        <input type="file" name="file" id="file" class="modal-input file-hidden" />
      </div>
    </div>

    <!-- Expiry Date -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Expiry Date
        <i class="fa fa-calendar tooltip-icon" data-bs-toggle="tooltip" title="Optional expiration date for the announcement."></i>
      </label>
      <div class="modal-date">
        <input type="date" name="expiry_date" class="modal-input" />
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
  });
</script>
