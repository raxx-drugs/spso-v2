<!-- Summernote CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/create_accomplishment.css') ?>">

<!-- Modal Scrollable Body Wrapper -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">
    
    <!-- Employee Name -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Employee Name <small class="text-danger">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter a file title"></i>
      </label>
      <input type="text" name="filename" placeholder="Full Name" class="modal-input" required />
    </div>

    <!-- Expiry Date -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Date <small class="text-danger">*</small>
        <i class="fa fa-calendar tooltip-icon" data-bs-toggle="tooltip" title="Set expiration date for this file"></i>
      </label>
      <input type="date" name="expiry_date" class="modal-input" required />
    </div>

    <!-- Accomplishment -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Accomplishment <small class="text-danger">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Add a description or comment about the file"></i>
      </label>
      <textarea id="summernote-remarks" name="remarks"></textarea>
    </div>

    <!-- Work Percentage Rate -->
    <div class="mb-3">
      <label class="field-label">
        Work Percentage Rate <small class="text-danger">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Select the percentage of work completed"></i>
      </label>
      <div class="select-wrapper">
        <select name="work_rate" class="modal-select" required>
          <option disabled selected value="">Percentage</option>
          <option value="25%">25%</option>
          <option value="50%">50%</option>
          <option value="75%">75%</option>
          <option value="100%">100%</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Number of Hours -->
    <div class="mb-3">
      <label class="field-label">
        Number of Hours <small class="text-danger">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter number of hours worked"></i>
      </label>
      <div class="select-wrapper">
        <select name="hours" class="modal-select" required>
          <option disabled selected value="">Select number of hours</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <!-- Add more options as needed -->
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label class="field-label">
        Status <small class="text-danger">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Current status of the accomplishment"></i>
      </label>
      <div class="select-wrapper">
        <select name="status" class="modal-select" required>
          <option disabled selected value="">Status</option>
          <option value="Completed">Completed</option>
          <option value="Ongoing">Ongoing</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>
    
  </div>
</div>

<!-- JavaScript: Tooltips and Summernote -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(el => new bootstrap.Tooltip(el));

    // Initialize Summernote when modal is shown
    const modalEl = document.querySelector('.modal');
    if (modalEl) {
      modalEl.addEventListener('shown.bs.modal', function () {
        const $summernote = $('#summernote-remarks');
        if (!$summernote.hasClass('summernote-initialized')) {
          $summernote.summernote({
            placeholder: 'Add accomplishment here...',
            tabsize: 2,
            height: 500,
            toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontsize', 'fontname']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link']],
              ['view', ['codeview']]
            ],
            callbacks: {
              onInit: function () {
                $summernote.summernote('code', `
<div style="display: flex; align-items: center; font-family: 'Times New Roman', serif; margin-bottom: 1rem;">
  <div style="flex-shrink: 0;">
    <img src="<?= base_url('assets/images/logo.png') ?>" alt="City Logo" style="height: 100px;">
  </div>
  <div style="text-align: center; width: 100%;">
    <strong style="font-size: 20px; color: black !important;">Republika ng Pilipinas</strong><br>
    <strong style="font-size: 24px; color: #b30000;">SANGGUNIANG PANLUNGSOD</strong><br>
    <span style="font-size: 14px;color: black !important;">Lungsod ng Mandaluyong</span><br>
    <span style="font-size: 13px;color: black !important;">Telefax: 941-99-22</span>
  </div>
</div>

<p style="font-family: 'Times New Roman', serif; font-size: 16px; text-align: justify; line-height: 1.7; color: black !important;">
  Create your accomplishment here
</p><br>

<div style="font-family: 'Times New Roman', serif; font-size: 16px; text-align: right; color: black !important;">
  <u><strong>JASPER-MIKE P. CORDERO</strong></u><br>
  <span style="font-style: italic;">Kagawad</span><br><br>
  <b>Petsa:</b> __________________
</div><br><br>

<p style="font-family: 'Times New Roman', serif; color: black !important;"><b>Sinuri ni:</b></p>
<p style="font-family: 'Times New Roman', serif; color: black !important;">
  <u><strong>MARIA CAROL E. FERNANDEZ</strong></u><br>
  <i>Tagapangasiwa</i><br>
  <b>Petsa:</b> ________________
</p><br>

<p style="font-family: 'Times New Roman', serif; color: black !important;"><b>Pinagtibay ni:</b></p>
<p style="font-family: 'Times New Roman', serif; color: black !important;">
  <u><strong>MA. TERESA S. MIRANDA</strong></u><br>
  <i>Kalihim ng Sanggunian</i><br>
  <b>Petsa:</b> ________________
</p>
                `);
              }
            }
          }).addClass('summernote-initialized');
        }
      });
    }
  });
</script>
