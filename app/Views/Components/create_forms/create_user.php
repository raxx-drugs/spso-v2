
<div class="modal-body-scroll">
  <div class="modal-form-grid">
  <!-- start of editing  -->
    <!-- User Role -->
    <div class="mb-3 full-width">
      <label class="field-label">
        User Role <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Select user role"></i>
      </label>
      <div class="select-wrapper">
        <select name="role" class="modal-select" required>
          <option disabled selected value="">User Role </option>
          <option value="admin">ADMIN</option>
          <option value="user">USER</option>
        </select>
        
      </div>
    </div>

    <!-- First Name -->
    <div class="mb-3">
      <label class="field-label">
        First Name <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your legal first name"></i>
      </label>
      <input type="text" name="fname" class="modal-input" required />
    </div>

    <!-- Middle Name -->
    <div class="mb-3">
      <label class="field-label">
        Middle Name 
        <i title="Enter your middle name"></i>
      </label>
      <input type="text" name="mname" class="modal-input"/>
    </div>

    <!-- Last Name -->
    <div class="mb-3">
      <label class="field-label">
        Last Name <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your legal last name"></i>
      </label>
      <input type="text" name="lname" class="modal-input" required />
    </div>

    <!-- Suffix -->
    <div class="mb-3">
      <label class="field-label">
        Suffix
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Optional suffix like Jr., Sr., III"></i>
      </label>
      <input type="text" name="suffix" class="modal-input" />
    </div>

    <!-- Birth Date -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Birth Date <small class="text-danger fs-6">*</small>
        <i title="Select your date of birth"></i>
      </label>
      <div class="modal-date">
        <input type="date" name="birth_date" class="modal-input" required />
        
      </div>
    </div>

    <!-- Birth Place -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Birth Place <small class="text-danger fs-6">*</small>
        <i title="Enter your place of birth"></i>
      </label>
      <input type="text" name="birth_place" class="modal-input" required />
    </div>

    <!-- Sex -->
    <div class="mb-3">
      <label class="field-label">
        Sex <small class="text-danger fs-6">*</small>
        <i title="Select your sex"></i>
      </label>
      <div class="select-wrapper">
        <select name="sex" class="modal-select" required>
          <option disabled selected value="">Sex</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
       
      </div>
    </div>

    <!-- Civil Status -->
    <div class="mb-3">
      <label class="field-label">
        Civil Status <small class="text-danger fs-6">*</small>
        <i title="Select your civil status"></i>
      </label>
      <div class="select-wrapper">
        <select name="civil_status" class="modal-select" required>
          <option disabled selected value="">Civil Status</option>
          <option value="Single">Single</option>
          <option value="Married">Married</option>
          <option value="Widowed">Widowed</option>
          <option value="Divorced">Divorced</option>
        </select>
    
      </div>
    </div>

    <!-- Height -->
    <div class="mb-3">
      <label class="field-label">
        Height (cm)
        <i title="Enter your height in centimeters"></i>
      </label>
      <input type="number" name="height" class="modal-input" />
    </div>

    <!-- Weight -->
    <div class="mb-3">
      <label class="field-label">
        Weight (kg)
        <i title="Enter your weight in kilograms"></i>
      </label>
      <input type="number" name="weight" class="modal-input" />
    </div>

    <!-- Blood Type -->
    <div class="mb-3">
      <label class="field-label">
        Blood Type
        <i title="Enter your blood type (e.g., O+)"></i>
      </label>
      <input type="text" name="blood_type" class="modal-input" />
    </div>

    <!-- Mobile Number -->
    <div class="mb-3">
      <label class="field-label">
        Mobile Number <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter a valid mobile number (09*********)"></i>
      </label>
      <input type="text" name="mobile_number" class="modal-input"  maxlength="11" required/>
    </div>

    <!-- Telephone Number -->
    <div class="mb-3">
      <label class="field-label">
        Telephone Number
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Optional: landline telephone number"></i>
      </label>
      <input type="text" name="telephone_number" class="modal-input" />
    </div>

    <!-- House Number -->
    <div class="mb-3">
      <label class="field-label">
        House Number 
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your house or lot number (Optional)"></i>
      </label>
      <input type="text" name="house_number" class="modal-input" />
    </div>
    <!-- Address Section -->
    <div class="mb-3 full-width">
    <label class="field-label">
        Region <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Select your region"></i>
    </label>
    <select name="region" class="modal-select" id="region" required></select>
    <input type="hidden" name="region_text" id="region-text"  />
    </div>

    <div class="mb-3 full-width">
    <label class="field-label">
        Province <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Select your province"></i>
    </label>
    <select name="province" class="modal-select" id="province" required></select>
    <input type="hidden" name="province_text" id="province-text" />
    </div>

    <div class="mb-3 full-width">
    <label class="field-label">
        City / Municipality <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Select your city or municipality"></i>
    </label>
    <select name="city" class="modal-select" id="city" required></select>
    <input type="hidden" name="city_text" id="city-text" />
    </div>

    <div class="mb-3 full-width">
    <label class="field-label">
        Barangay <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Select your barangay"></i>
    </label>
    <select name="barangay" class="modal-select" id="barangay" required></select>
    <input type="hidden" name="barangay_text" id="barangay-text" />
    </div>

    <div class="mb-3 full-width">
    <label class="field-label">
        Street <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your street name or subdivision"></i>
    </label>
    <input type="text" name="street_text" class="modal-input" id="street-text" required/>
    </div>

    <!-- TIN Number -->
    <div class="mb-3">
      <label class="field-label">
        TIN Number
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your Taxpayer Identification Number"></i>
      </label>
      <input type="text" name="tin_number" class="modal-input"/>
    </div>

    <!-- PhilHealth Number -->
    <div class="mb-3">
      <label class="field-label">
        PhilHealth Number
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your PhilHealth number"></i>
      </label>
      <input type="text" name="philhealth_number" class="modal-input"/>
    </div>

    <!-- SSS Number -->
    <div class="mb-3">
      <label class="field-label">
        SSS Number
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your Social Security System number (optional)"></i>
      </label>
      <input type="text" name="sss_number" class="modal-input" />
    </div>

    <!-- Pag-IBIG Number -->
    <div class="mb-3">
      <label class="field-label">
        Pag-IBIG Number
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your Pag-IBIG Fund number (optional)"></i>
      </label>
      <input type="text" name="pagibig_number" class="modal-input" />
    </div>

    <!-- GSIS Number -->
    <div class="mb-3">
      <label class="field-label">
        GSIS Number
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your GSIS number (required for government employees)"></i>
      </label>
      <input type="text" name="gsis_number" class="modal-input" />
    </div>

    <!-- Citizenship -->
    <div class="mb-3">
      <label class="field-label">
        Citizenship
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter your citizenship status"></i>
      </label>
      <input type="text" name="citizenship" class="modal-input" />
    </div>

    <!-- Email Address -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Email Address <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter a valid email address"></i>
      </label>
      <input type="email" name="email" class="modal-input" required />
    </div>

    <!-- Password -->
    <div class="mb-3 full-width">
      <label class="field-label">
        Password <small class="text-danger fs-6">*</small>
        <i class="fa fa-question-circle tooltip-icon" data-bs-toggle="tooltip" title="Enter a secure password (at least 8 characters)"></i>
      </label>
      <input type="password" name="password" class="modal-input" required />
    </div>

   <!-- end of editing -->
</div>

<!-- Tooltip Initializer -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el))
  });
</script>

<!-- script for address  -->
<script>
    var my_handlers = {
    // fill province
    fill_provinces: function() {
        //selected region
        var region_code = $(this).val();

        // set selected text to input
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text');
        region_input.val(region_text);
        //clear province & city & barangay input
        $('#province-text').val('');
        $('#city-text').val('');
        $('#barangay-text').val('');

        //province
        let dropdown = $('#province');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');
        dropdown.prop('selectedIndex', 0);

        //city
        let city = $('#city');
        city.empty();
        city.append('<option selected="true" disabled></option>');
        city.prop('selectedIndex', 0);

        //barangay
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        // filter & fill
        var url = '<?= base_url('assets/js/ph-json/province.json') ?>';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });

            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            })

        });
    },
    // fill city
    fill_cities: function() {
        //selected province
        var province_code = $(this).val();

        // set selected text to input
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text');
        province_input.val(province_text);
        //clear city & barangay input
        $('#city-text').val('');
        $('#barangay-text').val('');

        //city
        let dropdown = $('#city');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');
        dropdown.prop('selectedIndex', 0);

        //barangay
        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');
        barangay.prop('selectedIndex', 0);

        // filter & fill
        var url = '<?= base_url('assets/js/ph-json/city.json') ?>';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });

            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            })

        });
    },
    // fill barangay
    fill_barangays: function() {
        // selected barangay
        var city_code = $(this).val();

        // set selected text to input
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text');
        city_input.val(city_text);
        //clear barangay input
        $('#barangay-text').val('');

        // barangay
        let dropdown = $('#barangay');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');
        dropdown.prop('selectedIndex', 0);

        // filter & Fill
        var url = '<?= base_url('assets/js/ph-json/barangay.json') ?>';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });

            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });

            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            })

        });
    },

    onchange_barangay: function() {
        // set selected text to input
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text');
        barangay_input.val(barangay_text);
    },

};


$(function() {
    // events
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    $('#barangay').on('change', my_handlers.onchange_barangay);

    // load region
    let dropdown = $('#region');
    dropdown.empty();
    dropdown.append('<option selected="true" disabled>Choose Region</option>');
    dropdown.prop('selectedIndex', 0);
    const url = '<?= base_url('assets/js/ph-json/region.json') ?>';
    // Populate dropdown with list of regions
    $.getJSON(url, function(data) {
        $.each(data, function(key, entry) {
            dropdown.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
        })
    });

});
</script>