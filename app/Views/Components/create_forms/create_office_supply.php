
<div class="modal-body-scroll">
  <div class="modal-form-grid">
    
    <!-- Office Supply ID -->
    <div>
      <label class="field-label">
        Supply ID 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Enter a unique identifier for the supply item.<br>Example: <em>SUP-001</em>">
        </i>
      </label>
      <input type="text" name="office_supply_id" placeholder="Supply ID" class="modal-input" required />
    </div>

    <!-- Category -->
    <div>
      <label class="field-label">
        Category 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Select the appropriate supply category.<br>Helps in classification and reporting.">
        </i>
      </label>
      <div class="select-wrapper">
        <select name="office_supply_category" class="modal-select" required>
          <option disabled selected value="">Category</option>
          <option value="Paper Products">Paper Products</option>
          <option value="Writing Instruments">Writing Instruments</option>
          <option value="Office Equipment">Office Equipment</option>
          <option value="Filing Supplies">Filing Supplies</option>
          <option value="Other">Other</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Supply Name -->
    <div>
      <label class="field-label">
        Supply Name 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Enter the name of the supply.<br>Example: <em>Bond Paper A4</em>">
        </i>
      </label>
      <input type="text" name="name" placeholder="Supply Name" class="modal-input" required />
    </div>

    <!-- Supply Code -->
    <div>
      <label class="field-label">
        Supply Code 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Enter the internal code used for this supply item.<br>Helps in fast retrieval and tracking.">
        </i>
      </label>
      <input type="text" name="office_supply_code" placeholder="Supply Code" class="modal-input" required />
    </div>

    <!-- Stocks on Hand -->
    <div>
      <label class="field-label">
        Stocks on Hand 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Enter the quantity currently in inventory.<br>Example: <em>10</em>">
        </i>
      </label>
      <input type="number" name="office_supply_stocks" placeholder="Stocks on Hand" class="modal-input" required />
    </div>

    <!-- Status -->
    <div>
      <label class="field-label">
        Status 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Current stock status:<br>- <strong>Available</strong>: In stock<br>- <strong>Low Stock</strong>: Needs reorder<br>- <strong>Out of Stock</strong>: None left<br>- <strong>Archived</strong>: Not in use">
        </i>
      </label>
      <div class="select-wrapper">
        <select name="office_supply_status" class="modal-select" required>
          <option disabled selected value="">Status</option>
          <option value="Available">Available</option>
          <option value="Low Stock">Low Stock</option>
          <option value="Out of Stock">Out of Stock</option>
          <option value="Archived">Archived</option>
        </select>
        <i class="fa fa-chevron-down select-icon"></i>
      </div>
    </div>

    <!-- Description -->
    <div class="full-width">
      <label class="field-label">
        Description 
        <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Add any details or description about the supply.<br>Example: 'For printer model HP LaserJet 107w'">
        </i>
      </label>
      <textarea name="office_supply_description" placeholder="Description" class="modal-input" style="height: 100px;"></textarea>
    </div>

    <!-- Attachment / Image Upload -->
    <div class="full-width">
      <label class="field-label">
        Supply Image 
        <i class="fa fa-paperclip tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Optional: Upload a photo of the supply item.<br>Accepted formats: JPG, PNG, PDF.">
        </i>
      </label>
      <div class="custom-file-upload">
        <label for="office_supply_image" class="upload-btn">
          Add Supply Image <i class="fa fa-upload"></i>
        </label>
        <span class="file-name" id="supply-image-name-display">No file chosen</span>
        <input type="file" name="office_supply_image" id="office_supply_image" class="file-hidden" />
      </div>
    </div>

    <!-- Date Created -->
    <div>
      <label class="field-label">
        Date Created 
        <i class="fa fa-calendar tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Select the date this supply was added to the system.">
        </i>
      </label>
      <input type="date" name="office_supply_createdAt" class="modal-input" required />
    </div>

    <!-- Date Updated -->
    <div>
      <label class="field-label">
        Date Updated 
        <i class="fa fa-calendar tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true"
           title="Select the most recent date this supply info was modified.">
        </i>
      </label>
      <input type="date" name="office_supply_updatedAt" class="modal-input" />
    </div>

  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltips.forEach(t => new bootstrap.Tooltip(t));

    const supplyImageInput = document.getElementById('office_supply_image');
    const supplyImageNameDisplay = document.getElementById('supply-image-name-display');

    supplyImageInput.addEventListener('change', function () {
      supplyImageNameDisplay.textContent = this.files[0] ? this.files[0].name : 'No file chosen';
    });
  });
</script>
