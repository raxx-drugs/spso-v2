<!-- editable area start: -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">

    <!-- Requester name -->
    <div>
      <label class="field-label" for="name">
        Employee Name
        <span class="tooltip-icon" title="Enter your full name as the requester.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="text" id="employee_name" name="employee_name" placeholder="Enter name" class="modal-input mb-3" required />
    </div>

    <!-- Position (nothing from backend) -->
    <div>
      <label class="field-label" for="position">
        Position
        <span class="tooltip-icon" title="Enter your current job title or position.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="text" id="position" name="position" placeholder="Enter position" class="modal-input mb-3" required />
    </div>

    <!-- Date Created DYNAMICALLY ADDED FROM DATABASE-->
    <!-- <div>
      <label class="field-label" for="created_date">
        Date Created
        <span class="tooltip-icon" title="Select the date when you are submitting this request.">
          <i class="bi bi-calendar"></i>
        </span>
      </label>
      <div class="modal-date mb-3">
        <input type="date" name="created_date" id="created_date" class="modal-input" required />
        <i class="fa fa-calendar"></i>
      </div>
    </div> -->

    <!-- Description -->
    <div class="full-width">
      <label class="field-label" for="description">
        Description
        <span class="tooltip-icon" title="Provide a short description of the IT issue or support needed.">
          <i class="bi bi-pencil-square"></i>
        </span>
      </label>
      <textarea name="description" id="description" placeholder="Enter description" class="modal-input mb-3" required></textarea>
    </div>

    <!-- Attachment -->
    <div class="mb-3 field-input">
      <label class="field-label">
        Attachment
        <i class="fa fa-paperclip tooltip-icon" data-bs-toggle="tooltip" title="Upload related files (PDF, DOCX, etc.)"></i>
      </label>
      <div class="custom-file-upload">
        <label for="leave_attachment" class="upload-btn">Choose File</label>
        <span id="attachment-name" class="file-name">No file chosen</span>
        <input type="file" name="leave_attachment" id="leave_attachment" class="modal-input file-hidden" />
      </div>
    </div>

  </div>
</div>
<!-- end of editable area -->