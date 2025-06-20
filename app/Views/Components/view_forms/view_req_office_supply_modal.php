view_officesupply_modal.php
<!-- office supply -->

<!-- LINK CSS  -->
<link rel="stylesheet" href="<?= base_url('assets/css/request_form/officesupply.css'); ?>?v=1">

<div class="modal fade" id="viewDownloadModal" tabindex="-1" aria-labelledby="viewDownloadModalLabel"
  aria-hidden="true">
  <!-- REMINDER FOR NORMAL MODAL USE "modal-xl" if editing the information portal use fullscree or xxl -->
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"> 
    <div class="modal-content">

      <form id="viewDownloadForm" data-id="viewDownloadForm" method="post" action="<?= base_url(esc($api)) ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" disabled> 
            <div class="modal-header">
            <h5 class="modal-title" id="viewDownloadModalLabel">Office Supply Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <div class="modal-body">
            <input type="hidden" id="view_announcement_id" name="announcement_id" value="" disabled>

            <!-- editable area start -->
           <div class="office-supply-body">
              <div class="office-supply-row-1">
                <h3 id="view_supply_title" class="office-supply-title"><span>Office Supply</span></h3>
              </div>

              <div class="office-supply-row-2-col-1">
                <div class="attachments">
                  <h5>Attachment:</h5>
                  <div id="office_supply_picture">
                    
                  </div>
                </div>
              </div>

              <div class="office-supply-row-2-col-2">
                <p>
                  <strong>Ofiice Supply ID:</strong>
                  <input id="office_supply_id" name="office_supply_id" value="SUP-001" disabled />
                </p><hr>

                <p>
                  <strong>Supply Name:</strong><br>
                  <input id="req_supply_name" name="req_supply_name" value="Bond Paper A4" disabled />
                </p><hr>

                <p>
                  <strong>Supply Code:</strong>
                  <input id="req_supply_code" name="req_supply_code" value="SN1234567890" disabled />
                </p><hr>

                <p>
                  <strong>Stock on hand.:</strong>
                  <input id="req_supply_stock" name="req_supply_stock" value="PROP-987654321" disabled />
                </p><hr>

                <p>
                  <strong>End User:</strong>
                  <input id="req_supply_user" name="req_supply_user" value="Juan Dela Cruz" disabled />
                </p><hr>

                <p>
                  <strong>Material Requisition:</strong>
                  <input id="req_supply_requisition" name="req_supply_requisition" value="MR-2025-015" disabled />
                </p><hr>

                <p>
                  <strong>Stocks on Hand:</strong>
                  <input id="req_supply_stock" name="req_supply_stock" value="3 units" disabled />
                </p><hr>

                <p>
                  <strong>Status:</strong>
                  <input id="req_supply_status" name="req_supply_status" value="In Use" disabled />
                </p><hr>

                <p>
                  <strong> Value:</strong>
                  <input id="req_supply_value" name="req_supply_value" value="₱55,000.00" disabled />
                </p><hr>

                <p>
                  <strong>Remarks:</strong>
                  <input id="req_supply_remarks" name="req_supply_remarks" value="Assigned to IT Department" disabled />
                </p><hr>

                <p>
                  <strong>Date Created:</strong>
                  <input id="req_supply_created" name="req_supply_created" value="June 1, 2025 - 9:15 AM" disabled />
                </p><hr>

                <p>
                  <strong>Date Updated:</strong>
                  <input id="req_supply_updated" name="req_supply_updated" value="June 3, 2025 - 2:45 PM" disabled />
                </p>
              </div>
            </div>



             <!-- editable area end -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="toggleEditBtn" onclick="toggleInputs()">Edit</button>
          <button type="submit" class="btn btn-primary" >Save changes</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- Custom Modal Logic -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('viewDownloadForm');
    const toggleBtn = document.getElementById('toggleEditBtn');
    const modalEl = document.getElementById('viewDownloadModal');

    // Bootstrap modal instance
    const modalInstance = new bootstrap.Modal(modalEl);

    // Show the modal using JS (optional, or use data-bs-toggle="modal" on a button)
    // modalInstance.show();

    // Handle modal hide: reset fields
    modalEl.addEventListener('hide.bs.modal', () => {
      const inputs = form.querySelectorAll('input, textarea, select');
      inputs.forEach(input => {
        input.disabled = true;
        input.classList.remove('editable-outline');
      });
      toggleBtn.textContent = 'Edit';
    });

    // Toggle editable state
    toggleBtn.addEventListener('click', () => {
      const inputs = form.querySelectorAll('input, textarea, select');
      const isDisabled = inputs[0].disabled;

      inputs.forEach(input => {
        input.disabled = !isDisabled;
        input.classList.toggle('editable-outline', !input.disabled);
      });

      toggleBtn.textContent = isDisabled ? 'Disable Edit' : 'Edit';
    });
  });
</script>
