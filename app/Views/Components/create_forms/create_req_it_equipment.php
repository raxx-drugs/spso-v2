<!-- request page (it equipment) -->

<!-- CSS Link -->
<link rel="stylesheet" href="<?= base_url('assets/css/request_form/request_form.css'); ?>?v=1">

<!-- editable area start: -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">

   <!-- Category DropdowN (data link to it equipments) PARENT -->
    <div class="full-width">
      <label class="field-label" for="category">
        Category
        <span class="tooltip-icon" title="Select the appropriate category for the equipment.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <div class="select-wrapper mb-3">
        <select name="Category" id="category" class="modal-select" required>
          <option disabled selected value="">-- Select Category --</option>
          <option value="Desktop Computer">Desktop Computer</option>
          <option value="Laptop">Laptop</option>
          <option value="Monitor">Monitor</option>
          <option value="Keyboard">Keyboard</option>
          <option value="Mouse">Mouse</option>
          <option value="Printer">Printer</option>
          <option value="Scanner">Scanner</option>
          <option value="External Hard Drive">External Hard Drive</option>
          <option value="Network Switch">Network Switch</option>
          <option value="Router">Router</option>
          <option value="Other">Other</option>
        </select>
        <i class="bi bi-caret-down-fill select-icon"></i>
      </div>
    </div>


    <!-- Equipment Name (data link to it equipment) CHILD -->
    <div class="full-width">
      <label class="field-label" for="equipment">
        Equipment Name
        <span class="tooltip-icon" title="Enter the name of the equipment you are requesting.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="text" id="equipment" name="filename" placeholder="Enter equipment name" class="modal-input mb-3" required />
    </div>

    <!-- Description -->
    <div class="full-width">
      <label class="field-label" for="remarks">
        Description
        <span class="tooltip-icon" title="Provide a short description or justification for this equipment request.">
          <i class="bi bi-pencil-square"></i>
        </span>
      </label>
      <textarea name="remarks" id="remarks" placeholder="Enter description" class="modal-input mb-3" required></textarea>
    </div>

    <!-- Quantity -->
    <div>
      <label class="field-label" for="quantity">
        Quantity
        <span class="tooltip-icon" title="Enter the number of items requested.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" class="modal-input mb-3" min="1" required />
    </div>

    <!-- Request Date DYNAMICALLY ADDED FROM DATABASE -->
    <!-- <div>
      <label class="field-label" for="request_date">
        Request Date
        <span class="tooltip-icon" title="Select the date of this request.">
          <i class="bi bi-calendar"></i>
        </span>
      </label>
      <div class="modal-date mb-3">
        <input type="date" id="request_date" name="request_date" class="modal-input" required />
        <i class="fa fa-calendar"></i>
      </div>
    </div> -->

  </div>
</div>
<!-- end of editable area -->