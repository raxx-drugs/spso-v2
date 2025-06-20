<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Information' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>

<link rel="stylesheet" href="<?= base_url('assets/css/view_forms/employee_manage.css'); ?>?v=1">

<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Information</h3> 
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
   
    </div>
    <hr>
<?= $this->endSection() ;?>

<!-- Main Page Content Section -->
<?= $this->section('content') ?>
    <div class="content-2col">

        <form id="viewEmployeeModalForm" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" disabled>  

        <div class="modal-body">
            <input type="hidden" id="view_announcement_id" name="announcement_id" disabled>
         <!-- editable area start -->
         <div class="employee-manage-body">
            <!-- Top row with image and lines -->
            <div class="employee-manage-row-1">
              <div class="line"></div>
              <div class="employee-manage-img">
                <img src="<?= base_url('assets/images/daniel.jpg') ?>" alt="Profile Image" />
              </div>
              <div class="line"></div>
            </div>

            <!-- Name/Email row -->
            <div class="employee-manage-row-2-col-1">        
              <div class="name fw-bold fs-4 text-dark">Daniel Padilla</div>
              <div class="email text-muted small">DJ@gmail.com</div>       
            </div>

            <!-- Buttons + Dynamic content row -->
            <div class="employee-manage-row-3">
              <!-- Sidebar buttons -->
              <div class="employee-manage-sidebar">
                <button type="button" class="info-btn active" data-target="personal-info">Personal Info</button>
                <button type="button" class="info-btn" data-target="family-bg">Family Background</button>
                <button type="button" class="info-btn" data-target="education-bg">Education</button>
                <button type="button" class="info-btn" data-target="civil-service">Civil Service</button>
                <button type="button" class="info-btn" data-target="work-exp">Work Experience</button>
                <button type="button" class="info-btn" data-target="employee-invent">Inventory</button>
              </div>
            
              <!-- Dynamic content section -->
              <div class="employee-manage-section" id="personal-info">
                <div class="employee-manage-row-2-col-2">
                    <p><strong>First Name:</strong><input id="fname" name="fname" value="Daniel" disabled /></p>
                    <p><strong>Middle Name:</strong><input id="mname" name="mname" value="John" disabled /></p>
                    <p><strong>Last Name:</strong><input id="lname" name="lname" value="Padilla" disabled /></p>
                    <p><strong>Suffix:</strong><input id="suffix" name="suffix" value="Jr." disabled /></p>
                    <p><strong>Birth Date:</strong><input id="birth_date" name="birth_date" value="1995-04-26" disabled /></p>
                    <p><strong>Place of Birth:</strong><input id="birth_place" name="birth_place" value="Manila, Philippines" disabled /></p>
                    <p><strong>Sex:</strong><input id="sex" name="sex" value="Male" disabled /></p>
                    <p><strong>Civil Status:</strong><input id="civil_status" name="civil_status" value="Single" disabled /></p>
                    <p><strong>Height:</strong><input id="height" name="height" value="180 cm" disabled /></p>
                    <p><strong>Weight:</strong><input id="weight" name="weight" value="70 kg" disabled /></p>
                    <p><strong>Blood Type:</strong><input id="blood_type" name="blood_type" value="O+" disabled /></p>
                    <p><strong>Mobile Number:</strong><input id="mobile_number" name="mobile_number" value="09171234567" disabled /></p>
                    <p><strong>Telephone Number:</strong><input id="telephone_number" name="telephone_number" value="(02) 8123-4567" disabled /></p>
                    <p><strong>Lot No./Apartment No./House No.:</strong><input id="house_number" name="house_number" value="25" disabled /></p>
                    <p><strong>Street:</strong><input id="street" name="street" value="Blue Ridge Ave" disabled /></p>
                    <p><strong>Region:</strong><input id="region" name="region" value="NCR" disabled /></p>
                    <p><strong>Province:</strong><input id="province" name="province" value="Metro Manila" disabled /></p>
                    <p><strong>Municipality:</strong><input id="municipality" name="municipality" value="Quezon City" disabled /></p>
                    <p><strong>Barangay:</strong><input id="barangay" name="barangay" value="Loyola Heights" disabled /></p>
                    <p><strong>TIN:</strong><input id="tin_number" name="tin_number" value="123-456-789-000" disabled /></p>
                    <p><strong>Philhealth No.:</strong><input id="philhealth_number" name="philhealth_number" value="12-345678901-2" disabled /></p>
                    <p><strong>SSS No.:</strong><input id="sss_number" name="sss_number" value="34-5678901-2" disabled /></p>
                    <p><strong>Pag-IBIG ID No.:</strong><input id="pagibig_number" name="pagibig_number" value="1234-5678-9012" disabled /></p>
                    <p><strong>GSIS No.:</strong><input id="gsis_number" name="gsis_number" value="9876543210" disabled /></p>
                    <p><strong>Citizenship:</strong><input id="citizenship" name="citizenship" value="Filipino" disabled /></p>                
                </div>
              </div>              
              <div class="employee-manage-section d-none" id="family-bg">
                <div class="employee-manage-row-2-col-2">
                    <p><strong>Spouse's First Name:</strong><input id="spouses_fname" name="spouses_fname" value="Maria" disabled /></p>
                    <p><strong>Spouse's Middle Name:</strong><input id="spouses_mname" name="spouses_mname" value="Lopez" disabled /></p>
                    <p><strong>Spouse's Last Name:</strong><input id="spouses_lname" name="spouses_lname" value="Cruz" disabled /></p>

                    <p><strong>Father's First Name:</strong><input id="father_fname" name="father_fname" value="Carlos" disabled /></p>
                    <p><strong>Father's Middle Name:</strong><input id="father_mname" name="father_mname" value="Garcia" disabled /></p>
                    <p><strong>Father's Last Name:</strong><input id="father_lname" name="father_lname" value="Padilla" disabled /></p>
                    <p><strong>Father's Suffix:</strong><input id="father_suffix" name="father_suffix" value="Sr." disabled /></p>

                    <p><strong>Mother's First Name:</strong><input id="mother_fname" name="mother_fname" value="Isabel" disabled /></p>
                    <p><strong>Mother's Middle Name:</strong><input id="mother_mname" name="mother_mname" value="Santos" disabled /></p>
                    <p><strong>Mother's Last Name:</strong><input id="mother_lname" name="mother_lname" value="Reyes" disabled /></p>

                     <!-- Added children info -->
                    <p><strong>Children's Full Name:</strong><input id="children_full_name" name="children_full_name" value="Andres Bonifacio" disabled /></p>
                    <p><strong>Children's Birthday:</strong><input id="children_birth_date" name="children_birth_date"  value="February 25 ,1995" disabled /></p>
                </div>

              </div>
              <div class="employee-manage-section d-none" id="education-bg">
                <div class="employee-manage-row-2-col-2">
                  <p><strong>Elementary School Name:</strong>
                    <input id="elem_school" name="elem_school" value="San Miguel Elementary School" disabled />
                  </p>
                  <p><strong>Period of Attendance (Elem):</strong>
                    <input id="elem_period" name="elem_period" value="2000 - 2006" disabled />
                  </p>

                  <p><strong>Secondary School Name:</strong>
                    <input id="secondary_school" name="secondary_school" value="Sta. Lucia High School" disabled />
                  </p>
                  <p><strong>Period of Attendance (Secondary):</strong>
                    <input id="secondary_period" name="secondary_period" value="2006 - 2010" disabled />
                  </p>

                  <p><strong>Vocational Trade Course:</strong>
                    <input id="vocational_course" name="vocational_course" value="Computer Hardware Servicing NCII" disabled />
                  </p>
                  <p><strong>Period of Attendance (Vocational):</strong>
                    <input id="vocational_period" name="vocational_period" value="2011 - 2012" disabled />
                  </p>

                  <p><strong>College:</strong>
                    <input id="college" name="college" value="University of the East" disabled />
                  </p>
                  <p><strong>Course:</strong>
                    <input id="college_course" name="college_course" value="BSIT" disabled />
                  </p>
                  <p><strong>Period of Attendance (College):</strong>
                    <input id="college_period" name="college_period" value="2012 - 2016" disabled />
                  </p>

                  <p><strong>Highest Level/Units Earned (if not graduate):</strong>
                    <input id="highest_level_unit" name="highest_level_unit" value="N/A" disabled />
                  </p>

                  <p><strong>Graduate Studies:</strong>
                    <input id="graduate_studies" name="graduate_studies" value="SLSU" disabled />
                  </p>

                  <p><strong>Scholarship / Academic Honors Received:</strong>
                    <input id="academic_honors" name="academic_honors" value="Dean’s Lister (2014 - 2016)" disabled />
                  </p>
                </div>
              </div>
              <div class="employee-manage-section d-none" id="civil-service">
                <div class="employee-manage-row-2-col-2">
                  <p><strong>CAREER SERVICE / RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS / CES / CSEE BARANGAY ELIGIBILITY / DRIVER'S LICENSE:</strong>
                    <input id="career" name="career" value="Professional Driver's License" disabled />
                  </p>

                  <p><strong>Rating:</strong>
                    <input id="rating" name="rating" value="N/A" disabled />
                  </p>

                  <p><strong>DATE OF EXAMINATION / CONFERMENT:</strong>
                    <input id="date_examination" name="date_examination" value="March 15, 2018" disabled />
                  </p>

                  <p><strong>PLACE OF EXAMINATION / CONFERMENT:</strong>
                    <input id="place_examination" name="place_examination" value="LTO Quezon City Main Branch" disabled />
                  </p>

                  <p><strong>Licence (if available) Image:</strong><br />
                    <img id="license" src="/uploads/licenses/sample-license.jpg" alt="License Image" style="max-width: 200px; border: 1px solid #ccc;" />
                  </p>

                  <p><strong>Licence Number:</strong>
                    <input id="license_number" name="license_number" value="D12-34-567890" disabled />
                  </p>

                  <p><strong>Licence Date of Validity:</strong>
                    <input id="license_validity" name="license_validity" value="March 15, 2028" disabled />
                  </p>
                </div>
              </div>
              <div class="employee-manage-section d-none" id="work-exp">
                  <div class="employee-manage-row-2-col-2">
                    <p><strong>INCLUSIVE DATES (From):</strong>
                      <input id="inclusive_date_from" name="inclusive_date_from" value="June 1, 2020" disabled />
                    </p>

                    <p><strong>INCLUSIVE DATES (To):</strong>
                      <input id="inclusive_date_to" name="inclusive_date_to" value="Present" disabled />
                    </p>

                    <p><strong>DEPARTMENT / AGENCY / OFFICE / COMPANY:</strong>
                      <input id="company" name="company" value="Department of Information and Communications Technology" disabled />
                    </p>

                    <p><strong>MONTHLY SALARY:</strong>
                      <input id="monthly_salary" name="monthly_salary" value="₱45,000" disabled />
                    </p>

                    <p><strong>SALARY/ JOB/ PAY GRADE (if applicable):</strong>
                      <input id="salary" name="salary" value="SG-18" disabled />
                    </p>

                    <p><strong>STATUS OF APPOINTMENT:</strong>
                      <input id="status_appointment" name="status_appointment" value="Permanent" disabled />
                    </p>

                    <p><strong>GOV'T SERVICE (Y/N):</strong>
                      <input id="gov_service" name="gov_service" value="Y" disabled />
                    </p>

                    <p><strong>Position:</strong>
                      <input id="position" name="position" value="Information Technology Officer I" disabled />
                    </p>

                    <p><strong>Section:</strong>
                      <input id="section" name="section" value="Application Development Division" disabled />
                    </p>
                  </div>
                </div>
         
              <div class="employee-manage-section d-none" id="employee-invent">
                    <div class="employee-manage-row-2-col-2">
                      <div class="employee-invent-section">
                        <div class="employee-invent-child">
                          <span>DOWNLOADS</span>
                          <p>
                            <strong>Download ID:</strong>
                            <input id="download_id" name="download_id" value="12345" disabled />
                          </p>
                          <p>
                            <strong>Filename:</strong>
                            <input id="download_filename" name="download_filename" value="example_document.pdf" disabled />
                          </p>
                          <p>
                            <strong>Attachment:</strong>
                            <input id="download_file" name="download_file" value="example_document.pdf" disabled />
                          </p>
                          <p>
                            <strong>Remarks:</strong>
                            <input id="download_remarks" name="download_remarks" value="Approved document for reference" disabled />
                          </p>
                          <p>
                            <strong>Permission Level:</strong>
                            <input id="download_permission" name="download_permission" value="Admin Only" disabled />
                          </p>
                          <p>
                            <strong>Status:</strong>
                            <input id="download_status" name="download_status" value="Active" disabled />
                          </p>
                          <p>
                            <strong>Expiry Date:</strong>
                            <input id="download_expiry_date" name="download_expiry_date" value="December 31, 2025" disabled />
                          </p>
                        </div>

                        <div class="employee-invent-child">
                          <span>EQUIPMENTS</span>
                          <p>
                            <strong>Device/Unit:</strong>
                            <input id="device_unit" name="device_unit" value="Sample Device" disabled />
                          </p>
                          <p>
                            <strong>Serial Number:</strong>
                            <input id="serial_number" name="serial_number" value="SN-123456789" disabled />
                          </p>
                          <p>
                            <strong>System Property No.:</strong>
                            <input id="system_property_no" name="system_property_no" value="SPN-987654321" disabled />
                          </p>
                          <p>
                            <strong>End User:</strong>
                            <input id="end_user" name="end_user" value="Daniel Padilla" disabled />
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>

            </div>
         </div>      
             <!-- editable area end -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="toggleEditBtn">Edit</button>
          <button type="submit" class="btn btn-primary d-none" id="saveBtn">Save changes</button>
        </div>
      </form>
    </div>
    <div class="d-flex" >
      <div class="me-4">
        <img src="<?= base_url('assets/images/work-in-progress.png') ?>" style="width: 100px;"; alt="Logo" class="logo"> <!-- Optional logo -->
        <h1>Work In Progress</h1>
        <p>Por Halo na Por !!!</p>
      </div>
      <div class="wip">
        <img src="<?= base_url('assets/images/almost-done.jpg') ?>" style="width: 300px;"; alt="Logo" class="logo"> <!-- Optional logo -->
        <h1>Kinapos sa graba Por !!!</h1>
      </div>
    </div>


<?= $this->endSection() ?>

<!-- JavaScript Section -->
<?= $this->section('scripts') ?>
    <script>
        // Select the element that holds the DataTable
        const tableContainer = document.querySelector('.table-container');

        if (tableContainer) {
            // Use ResizeObserver to watch for height changes in the container
            const resizeObserver = new ResizeObserver(entries => {
                for (let entry of entries) {
                    // Output the updated height to the console
                    console.log("Table container height changed:", entry.contentRect.height);
                }
            });

            // Start observing the container for size changes
            resizeObserver.observe(tableContainer);
        }
    </script>
    <script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('viewEmployeeForm');
    const toggleBtn = document.getElementById('toggleEditBtn');
    const modalEl = document.getElementById('viewEmployeeModal');
    const saveBtn = document.getElementById('saveBtn');

    const modalInstance = new bootstrap.Modal(modalEl);

    modalEl.addEventListener('hide.bs.modal', () => {
      form.querySelectorAll('input, textarea, select').forEach(input => {
        input.disabled = true;
        input.classList.remove('editable-outline');
      });
      toggleBtn.textContent = 'Edit';
      saveBtn.style.display = 'none';
    });

    toggleBtn.addEventListener('click', () => {
      const inputs = form.querySelectorAll('input, textarea, select');
      const isDisabled = inputs[0].disabled;

      inputs.forEach(input => {
        input.disabled = !isDisabled;
        input.classList.toggle('editable-outline', !input.disabled);
      });

      toggleBtn.textContent = isDisabled ? 'Disable Edit' : 'Edit';
      saveBtn.style.display = isDisabled ? 'inline-block' : 'none';
    });
  });
</script> 

<script>
  // Toggle sections on sidebar button click
  document.querySelectorAll('.employee-manage-sidebar .info-btn').forEach(button => {
    button.addEventListener('click', () => {
      // Remove active class from all buttons
      document.querySelectorAll('.employee-manage-sidebar .info-btn').forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      // Hide all sections
      document.querySelectorAll('.employee-manage-section').forEach(section => section.classList.add('d-none'));

      // Show the target section
      const target = button.getAttribute('data-target');
      document.getElementById(target)?.classList.remove('d-none');
    });
  });
</script>
<?= $this->endSection() ?>
