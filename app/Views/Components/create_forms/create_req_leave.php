<!-- editable area start: -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">

  <!-- Position -->
    <div>
      <label  class="field-label" for="department">
        Department
        <span class="tooltip-icon" title="Enter your dapartment.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="text" id="department" name="department" placeholder="Enter department" class="modal-input mb-3" required />
    </div>

    <!-- Position -->
    <div>
      <label class="field-label" for="position">
        Position
        <span class="tooltip-icon" title="Enter your current position or job title.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="text" id="position" name="position" placeholder="Enter position" class="modal-input mb-3" required />
    </div>

    <!-- Salary -->
    <div class="full-width">
      <label class="field-label" for="salary">
        Salary
        <span class="tooltip-icon" title="Enter your monthly salary using numeric values only.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="number" id="salary" name="salary" placeholder="Enter salary" class="modal-input mb-3" min="1" required />
    </div>

    <!-- Date Created (dynamically added from database)-->
    <!-- <div class="field-input">
      <label class="field-label" for="created_date">
        Date Created
        <span class="tooltip-icon" title="Indicates when this leave request was filled out.">
          <i class="bi bi-calendar-event"></i>
        </span>
      </label>
      <div class="modal-date mb-3">
        <input type="date" name="created_date" id="created_date" class="modal-input" required />
        <i class="fa fa-calendar"></i>
      </div>
    </div> -->

    <!-- Parent Dropdown: Type of Leave -->
    <div class="full-width">
      <label class="field-label" for="category">
        Type of Leave
        <span class="tooltip-icon" title="Choose the general category of leave you're requesting.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <div class="select-wrapper mb-3">
        <select name="Category" id="category" class="modal-select" required>
          <option disabled selected value="">--Select leave--</option>
          <option value="Vacation">Vacation Leave</option>
          <option value="Mandatory/Forced">Mandatory/Forced Leave</option>
          <option value="Sick">Sick Leave</option>
          <option value="Maternity">Maternity Leave</option>
          <option value="Paternity">Paternity Leave</option>
          <option value="Special Privilege">Special Privilege Leave</option>
          <option value="Solo Parent">Solo Parent Leave</option>
          <option value="Study">Study Leave</option>
          <option value="10-Day VAWC">10-Day VAWC Leave</option>
          <option value="Rehabilitation">Rehabilitation Leave</option>
          <option value="Benefit for Women">Special Leave Benefit for Women</option>
          <option value="Special Emergency">Special Emergency (Calamity) Leave</option>
          <option value="Adoption">Adoption Leave</option>
        </select>
        <i class="bi bi-caret-down-fill select-icon"></i>
      </div>
    </div>

    <!-- Child Dropdown: Specific Leave Reason -->
    <div class="full-width" id="child-wrapper" style="display: none;">
      <label class="field-label" for="subtype">
        Specific Reason (if applicable)
        <span class="tooltip-icon" title="Choose a more specific reason based on the selected leave type.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <div class="select-wrapper mb-3">
        <select name="subtype" id="subtype" class="modal-select">
          <option disabled selected value="">--Select specific reason--</option>
        </select>
        <i class="bi bi-caret-down-fill select-icon"></i>
      </div>
    </div>

    <!-- Description -->
    <div class="full-width">
      <label class="field-label" for="remarks">
        Description
        <span class="tooltip-icon" title="Provide a brief explanation or justification for your leave.">
          <i class="bi bi-pencil-square"></i>
        </span>
      </label>
      <textarea name="remarks" id="remarks" placeholder="Enter description" class="modal-input mb-3" required></textarea>
    </div>

    <!-- Start Date -->
    <div class="field-input">
      <label class="field-label" for="start_date">
        Start Date
        <span class="tooltip-icon" title="Select the first day of your leave.">
          <i class="bi bi-calendar-date"></i>
        </span>
      </label>
      <div class="modal-date mb-3">
        <input type="date" name="start_date" id="start_date" class="modal-input" required />
        <i class="fa fa-calendar"></i>
      </div>
    </div>

    <!-- End Date -->
    <div class="full-width">
      <label class="field-label" for="end_date">
        End Date
        <span class="tooltip-icon" title="Select the last day of your leave.">
          <i class="bi bi-calendar-event"></i>
        </span>
      </label>
      <div class="modal-date mb-3">
        <input type="date" name="end_date" id="end_date" class="modal-input" required />
        <i class="fa fa-calendar"></i>
      </div>
    </div>

    <!-- Attachment -->
    <div class="mb-3 full-width">
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


<script>
  const subtypeOptions = {
    "Vacation": ["Local Travel", "International Travel", "Rest Day"],
    "Sick": ["In Hospital", "Out Patient"],
    "Maternity": ["Normal Delivery", "Cesarean Delivery"],
    "Benefit for Women": ["Gynecological Surgery", "Other Medical Need"],
    "Study": ["Completion of Master's Degree", "BAR/Board Exam Review", "Other Educational Pursuits"]
  };

  const parent = document.getElementById("category");
  const childWrapper = document.getElementById("child-wrapper");
  const child = document.getElementById("subtype");

  parent.addEventListener("change", function () {
    const selected = this.value;
    child.innerHTML = '<option disabled selected value="">--Select specific reason--</option>';

    if (subtypeOptions[selected]) {
      subtypeOptions[selected].forEach(reason => {
        const opt = document.createElement("option");
        opt.value = reason;
        opt.textContent = reason;
        child.appendChild(opt);
      });
      childWrapper.style.display = "block";
      child.required = true;
    } else {
      childWrapper.style.display = "none";
      child.required = false;
    }
  });
</script>