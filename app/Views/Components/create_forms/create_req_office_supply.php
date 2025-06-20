<!-- editable area start: -->
<div class="modal-body-scroll">
  <div class="modal-form-grid">

    <!-- Category Dropdown (LINK TO DATABASE) PARENT DROPDOWN -->
    <div class="full-width">
      <label class="field-label" for="category">
        Category
        <span class="tooltip-icon" title="Select the appropriate category for the office supply.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <div class="select-wrapper mb-3">
        <select name="category" id="category" class="modal-select" required>
          <option disabled selected value="">-- Select Category --</option>
          <option value="Writing Instruments">Writing Instruments</option>
          <option value="Paper Products">Paper Products</option>
          <option value="Notebooks and Pads">Notebooks and Pads</option>
          <option value="Filing and Organization">Filing and Organization</option>
          <option value="Desk Accessories">Desk Accessories</option>
          <option value="Adhesives and Tapes">Adhesives and Tapes</option>
          <option value="Printer Supplies">Printer Supplies</option>
          <option value="Calendars and Planners">Calendars and Planners</option>
          <option value="Mailing Supplies">Mailing Supplies</option>
          <option value="Cleaning Supplies">Cleaning Supplies</option>
          <option value="Other">Other</option>
        </select>
        <i class="bi bi-caret-down-fill select-icon"></i>
      </div>
    </div>


    <!-- Supply Name (LINK TO DATABASE) CHILD DROPDOWN -->
    <div class="full-width">
      <label class="field-label" for="supply">
        Supply Name
        <span class="tooltip-icon" title="Enter the name of the office supply you are requesting.">
          <i class="bi bi-question-circle-fill"></i>
        </span>
      </label>
      <input type="text" id="supply" name="filename" placeholder="Enter supply name" class="modal-input mb-3" required />
    </div>

    <!-- Description -->
    <div class="full-width">
      <label class="field-label" for="remarks">
        Description
        <span class="tooltip-icon" title="Provide a short description or justification for this supply request.">
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