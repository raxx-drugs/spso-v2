
<!-- Leave -->

<!-- LINK CSS  -->
<link rel="stylesheet" href="<?= base_url('assets/css/request_form/leave.css'); ?>?v=1">

<div class="modal fade" id="viewDownloadModal" tabindex="-1" aria-labelledby="viewDownloadModalLabel"
  aria-hidden="true">
  <!-- REMINDER FOR NORMAL MODAL USE "modal-xl" if editing the information portal use fullscree or xxl -->
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"> 
    <div class="modal-content">

      <form id="viewDownloadForm" data-id="viewDownloadForm" method="post" action="<?= base_url(esc($api)) ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" disabled> 
            <div class="modal-header">
            <h5 class="modal-title" id="viewDownloadModalLabel">Leave Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <div class="modal-body">
            <input type="hidden" id="view_announcement_id" name="announcement_id" value="" disabled>
          
            
             <!-- editable area start: -->
              <div class="leave-body">
                <div class="leave-row-1">
                  <h3 id="view_leave_title" class="leave-title"><strong>Leave Info</strong></h3>
                </div>
                <div class="leave-row-2-col-1">
                <div class="attachments">
                  <img src="<?= base_url('assets/images/medcert.png') ?>" alt="Announcement Image" width="100%" style="max-width: 300px; border: 1px solid #ccc; border-radius: 4px;">
                  <div id="announcement_attachments"></div>
                </div>

                <div class="employeename">
                  <label for="leave_name"><strong>Employee Name:</strong></label>
                  <span id="leave_name">Daniel Arojo</span>
                </div>

                <div class="Remarks">
                  <textarea id="leave_remarks" name="leave_remarks" rows="3" class="leave-textarea" placeholder="Remarks:" disabled></textarea>
                </div>
              </div>

                <div class="leave-row-2-col-2">
                  <p>
                    <strong>Leave Id:</strong>
                    <span id="leave_id">L34V-IT-0021</span>
                  </p><hr>
                  <!-- suggest dropdown -->
                  <p>
                    <strong> Type of Leave:</strong> 
                    <span id="leave_type">Sick Leave</span>
                  </p><hr>

                  <p>
                    <strong> Sick Leave:</strong> 
                    <span id="leave_type">In Hospital</span>
                  </p><hr>

                    
                  <!-- end -->
                  <p>
                    <strong>Reason:</strong><br>
                    <span id="leave_description">Masakit ang kanang itlog 🙂....</span>
                </p><hr>
                <p>
                    <strong>Request Date:</strong> 
                    <input id="leave_requestedAt" name="leave_status" value="June 1, 2025 - 5:00 pm" disabled/>
                  </p><hr>
                  <p>
                    <strong>Start Date:</strong> 
                    <input id="leave_startedAt" name="leave_startedAt" value="June 2, 2025 - 5:00 pm" disabled/>
                  </p><hr>
                  <p>
                    <strong>End Date:</strong> 
                    <input id="leave_endedAt" name="leave_endedAt" value="June 5, 2025 - 5:00 pm" disabled/>
                  </p><hr>

                  <!-- dynamically added -->
                  <p>
                    <strong>Total of Days:</strong> 
                    <input id="leave_numofDays" name="leave_numofDays" value="3 days" disabled/>
                  </p><hr>
                  <!-- end -->
                  <p>
                  <strong>Status:</strong>
                  <select id="leave_status" name="itequipment_status" disabled class="form-select">
                  <option value="Approved">Approved</option>
                  <option value="Decline">Decline</option>
                  <option value="Pending">Pending</option>
                  </select>
                </p><hr>
                  <p>
                    <strong>Approval Date:</strong> 
                    <input id="leave_approvedAt" name="leave_approvedAt" value="June 2, 2025 - 5:00 pm" disabled/>
                  </p><hr>
                  <p>
                    <strong>Approved By:</strong> 
                    <input id="leave_approvedBy" name="leave_approvedBy" value="Jasper Mike Wazowski" disabled/>
                  </p><hr>
                </div>
              </div>
              <!-- end: -->
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
