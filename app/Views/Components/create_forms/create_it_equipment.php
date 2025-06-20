
<div class="modal-body-scroll">
  <div class="modal-form-grid">
    <!-- Equipment / Device Name -->
    <div class="full-width">
        <label class="field-label">
            Device / Unit 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Provide the name or model of the equipment.<br>Examples: <em>Dell Latitude 5420</em>, <em>HP LaserJet M404dn</em>.">
            </i>
        </label>
        <input type="text" name="unit" placeholder="Device/Unit" class="modal-input" required />
        </div>

        <!-- Serial Number -->
        <div>
        <label class="field-label">
            Serial Number 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Enter the unique serial number assigned by the manufacturer.<br>Usually located on the label at the back or bottom of the device.">
            </i>
        </label>
        <input type="text" name="serial_number" placeholder="Serial Number" class="modal-input" required />
        </div>

        <!-- System Property Number -->
        <div>
        <label class="field-label">
            System Property No. 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Enter the official property or asset number issued by your organization.<br>This is used for inventory tracking.">
            </i>
        </label>
        <input type="text" name="system_no" placeholder="System Property No." class="modal-input" required />
        </div>

        <!-- Requisition Number -->
        <div>
        <label class="field-label">
            Material Requisition 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Enter the document number related to the request or purchase.<br>Helps in referencing the source of acquisition.">
            </i>
        </label>
        <input type="text" name="requisition" placeholder="Material Requisition" class="modal-input" required />
        </div>

        <!-- Stocks on Hand -->
        <div>
        <label class="field-label">
            Stocks on Hand 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Enter the total number of available items currently in stock.<br>Use whole numbers only (e.g., 1, 2, 10).">
            </i>
        </label>
        <input type="number" name="stock" placeholder="Stocks on Hand (e.g., 3)" class="modal-input" required />
        </div>

        <!-- Unit Value -->
        <div>
        <label class="field-label">
            Unit Value (₱) 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Enter the price or cost of one unit of the equipment.<br>Use valid currency amounts (e.g., 5000.00).">
            </i>
        </label>
        <input type="number" name="unit_value" placeholder="Unit Value (₱)" step="0.01" class="modal-input" required />
        </div>

        <!-- Status -->
        <div>
        <label class="field-label">
            Status 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Select the current condition of the equipment:<br>- <strong>Available</strong>: Ready for use<br>- <strong>In Use</strong>: Currently assigned<br>- <strong>Damaged</strong>: Broken or unusable<br>- <strong>For Repair</strong>: Awaiting maintenance<br>- <strong>Disposed</strong>: No longer in inventory">
            </i>
        </label>
        <div class="select-wrapper">
            <select name="status" class="modal-select" required>
            <option disabled selected value="">Status</option>
            <option value="Available">Available</option>
            <option value="In Use">In Use</option>
            <option value="Damaged">Damaged</option>
            <option value="For Repair">For Repair</option>
            <option value="Disposed">Disposed</option>
            </select>
            <i class="fa fa-chevron-down select-icon"></i>
        </div>
        </div>

    <!-- Attachment / Image Upload -->
      <div class="full-width">
        <label class="field-label">
            Equipment Image 
            <i class="fa fa-paperclip tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Optional: Upload a clear photo of the equipment.<br>Accepted formats: JPG, PNG, PDF.<br>Helps visually confirm the item's condition.">
            </i>
        </label>
        <div class="custom-file-upload">
            <label for="it_equipment_image" class="upload-btn">
            Add Equipment Image <i class="fa fa-upload"></i>
            </label>
            <span class="file-name" id="image-name-display">No file chosen</span>
            <input type="file" name="image" id="it_equipment_image" class="file-hidden" />
        </div>
     </div>

        <!-- Remarks -->
        <div class="full-width">
        <label class="field-label">
            Remarks 
            <i class="fa fa-circle-question tooltip-icon" data-bs-toggle="tooltip" data-bs-html="true" 
            title="Add any relevant notes, comments, or observations.<br>Example: 'Battery replaced recently' or 'For delivery to finance dept.'">
            </i>
        </label>
        <textarea name="remarks" placeholder="Remarks" class="modal-input" style="height: 100px;"></textarea>
        </div>

        

  </div>
</div>

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

    // document.getElementById('image').addEventListener('change', function () {
    //   const imageName = this.files[0] ? this.files[0].name : 'No file chosen';
    //   document.getElementById('image-name').textContent = imageName;
    // });
  });
</script>

