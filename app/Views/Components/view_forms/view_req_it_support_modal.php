<!-- It Request -->

<!-- LINK CSS  -->
<link rel="stylesheet" href="<?= base_url('assets/css/request_form/itsupport.css'); ?>?v=1">

<div class="modal fade" id="viewDownloadModal" tabindex="-1" aria-labelledby="viewDownloadModalLabel"
  aria-hidden="true">
  <!-- REMINDER FOR NORMAL MODAL USE "modal-xl" if editing the information portal use fullscree or xxl -->
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"> 
    <div class="modal-content">

      <form id="viewDownloadForm" data-id="viewDownloadForm" method="post" action="<?= base_url(esc($api)) ?>" enctype="multipart/form-data">
         <input type="hidden" name="_method" value="PUT" disabled> 
            <div class="modal-header">
            <h5 class="modal-title" id="viewDownloadModalLabel">It Support Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

        <div class="modal-body">
            <input type="hidden" id="view_announcement_id" name="announcement_id" value="" disabled>
           <!-- editable area starts here: -->
            <div class="req-it-solution-body">
              <div class="req-it-solution-row-1">
                <h3 id="view_req_it_solution_title" class="req-it-solution-title"><strong>IT Support Details</strong></h3>
              </div>
              <div class="req-it-solution-row-2-col-1">
                <div class="attachments">
                  <img src="<?= base_url('assets/images/galitnaprinsipal.png') ?>" alt="Announcement Image" width="100%" style="max-width: 300px; border: 1px solid #ccc; border-radius: 4px;">
                  <div id="announcement_attachments"></div>
                </div>

                <div class="employeename">
                  <label for="req_it_solution_name"><strong>Employee Name:</strong></label>
                    <span id="req_it_solution_name">Galit na Tiger</span>
                </div>

                <div class="Remarks">
                  <textarea id="req_it_solution_remarks" name="req_it_solution_remarks" rows="3" class="req_it_solution-textarea" placeholder="Remarks:" disabled></textarea>
                </div>
              </div>

              <div class="req_it_solution-row-2-col-2">
                <p>
                  <strong>Equipment Id:</strong>
                  <span id="req_it_solution_id">SUP-IT-0021</span>
                </p><hr>
                <p>
                  <strong>Description:</strong><br>
                  <span id="req_it_solution_description">Need lambing</span>
                </p><hr>
                <p>
                  <strong>Request Date:</strong> 
                  <span id="req_it_solution_request_date">June 2, 2025 - 5:00 pm</span>
                </p><hr>
                <p>
                  <strong>Status:</strong>
                  <select id="req_it_solution_status" name="req_it_solution_status" disabled class="form-select">
                  <option value="Approved">Approved</option>
                  <option value="Decline">Decline</option>
                  <option value="Pending">Pending</option>
                  </select>
                </p><hr>
                <p>
                  <strong>Action Date:</strong> 
                  <input id="req_it_solution_approve_date" name="req_it_solution_approve_date" value="June 3, 2025 - 5:00 pm" disabled/>
                </p><hr>
                <p>
                  <strong>Acted By:</strong> 
                  <input id="req_it_solution_approve_by" name="req_it_solution_approve_by" value="Jasper Mike Wazowski" disabled/>
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
