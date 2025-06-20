<!-- view_equipment_modal -->

<?php 
    // Load session values if user is logged in
if (session()->has('user')): 
    $name = session('user'); 
    $role = session('role'); 
    $title = session('title'); 
    $viewId = session('viewId') ?? '';
    $modalId = 'viewAnnouncementModal'; 
endif;
?>
<!-- LINK CSS  -->
<link rel="stylesheet" href="<?= base_url('assets/css/portal/employee_equipment.css'); ?>?v=1">

<div class="modal fade" id="<?= esc($modalId) ?>" tabindex="-1" aria-labelledby="<?= esc($modalIdLabel) ?>"
  aria-hidden="true">
  <!-- REMINDER FOR NORMAL MODAL USE "modal-xl" if editing the information portal use fullscree or xxl -->
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"> 
    <div class="modal-content">

      <form id="<?= esc($formId) ?>" method="post" action="<?= base_url(esc($api)) ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" disabled> 
        <div class="modal-header">
          <h5 class="modal-title" id="<?= esc($modalId) ?>Label"><?= esc($modalTitle) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" id="view_announcement_id" name="announcement_id" value="">
          
            
            <!-- editable area start -->
           <div class="equipment-body">
              <div class="equipment-row-1">
                <h3 id="view_equipment_title" class="equipment-title"><span>IT EQUIPMENTS</span></h3>
              </div>

              <div class="equipment-row-2-col-1">
                <div class="attachments">
                  <h5>Attachment:</h5>
                  <div id="equipment_picture">
                    
                  </div>
                </div>
              </div>

              <div class="equipment-row-2-col-2">
                <p>
                  <strong>IT Equipment ID:</strong>
                  <input id="equipment_id" name="equipment_id" value="EQ-2025-001" disabled />
                </p><hr>

                <p>
                  <strong>Device/Unit:</strong><br>
                  <input id="equipment_device" name="equipment_device" value="Dell Latitude 5520" disabled />
                </p><hr>

                <p>
                  <strong>Serial Number:</strong>
                  <input id="equipment_serial" name="equipment_serial" value="SN1234567890" disabled />
                </p><hr>

                <p>
                  <strong>System Property No.:</strong>
                  <input id="equipment_property_no" name="equipment_property_no" value="PROP-987654321" disabled />
                </p><hr>

                <p>
                  <strong>End User:</strong>
                  <input id="equipment_user" name="equipment_user" value="Juan Dela Cruz" disabled />
                </p><hr>

                <p>
                  <strong>Material Requisition:</strong>
                  <input id="equipment_requisition" name="equipment_requisition" value="MR-2025-015" disabled />
                </p><hr>

                <p>
                  <strong>Stocks on Hand:</strong>
                  <input id="equipment_stock" name="equipment_stock" value="3 units" disabled />
                </p><hr>

                <p>
                  <strong>Status:</strong>
                  <input id="equipment_status" name="equipment_status" value="In Use" disabled />
                </p><hr>

                <p>
                  <strong>Unit Value:</strong>
                  <input id="equipment_value" name="equipment_value" value="₱55,000.00" disabled />
                </p><hr>

                <p>
                  <strong>Remarks:</strong>
                  <input id="equipment_remarks" name="equipment_remarks" value="Assigned to IT Department" disabled />
                </p><hr>

                <p>
                  <strong>Date Created:</strong>
                  <input id="equipment_created" name="equipment_created" value="June 1, 2025 - 9:15 AM" disabled />
                </p><hr>

                <p>
                  <strong>Date Updated:</strong>
                  <input id="equipment_updated" name="equipment_updated" value="June 3, 2025 - 2:45 PM" disabled />
                </p>
              </div>
            </div>



             <!-- editable area end -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="toggleEditBtn" onclick="toggleInputs()">Enable Edit</button>

          <button type="submit" class="btn btn-primary" >Save changes</button>
        </div>
      </form>

    </div>
  </div>
</div>
<script>
  function toggleInputs() {
    const form = document.getElementById('viewAnnouncementForm');
    const inputs = form.querySelectorAll('input, textarea, select');
    const button = document.getElementById('toggleEditBtn');

    let isDisabled = inputs[0].disabled; // Check the state of first input

    inputs.forEach(input => {
      input.disabled = !isDisabled;
    });

    button.textContent = isDisabled ? 'Disable Edit' : 'Enable Edit';
  }
</script>