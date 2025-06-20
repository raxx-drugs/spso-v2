<!-- attendance -->

<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Download' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
 
<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Attendance Page</h3> 
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
        <?php 
            $target = '#createAttendanceModal';
            $btnName = 'Add Attendance';
            echo view('components/buttons/add_header_btn', compact('target', 'btnName'));
        ?>
        
    </div>
    <hr>
<?= $this->endSection() ;?>

<!--Stat Card Section -->
<?= $this->section('content-statcard') ;?>

    <div class="statcard-container" id="statcard-container">
    <!-- Statcards will be injected here dynamically -->
</div>
<?= $this->endSection() ;?>


<!-- Main Page Content Section -->
<?= $this->section('content') ?>
    

    <!-- DataTable container -->
    <div class="table-container" id="table-container">
        <?php
            // Set DataTable ID, column headers, and data source URL
            $tableId = 'downloadTable';
            $columns = ['#', 'Employee', 'Status', 'Date', 'With Leave','Without Leave','Total Days Present', 'Actions'];
            $dataUrl = base_url('api/download/list'); // Endpoint that returns JSON data

            // Load the reusable DataTable view
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Inject the reusable modal -->
    <?= view('components/partials/modal', [
        'modalId' => 'createAttendanceModal',
        'modalIdLabel' => 'createAttendanceModalLabel',
        'modalTitle' => 'Add Attendance',
        'modalBodyView' => 'components/create_forms/create_attendance',
        'formId' => 'attendanceForm',
        'api' => 'api/download/add'
    ]); ?>
    

        <!-- View Modal  -->
    <?= view('components/view_forms/view_download_modal', [
        'api' => 'api/download/update'
    ]); ?>


<?= $this->endSection() ?>

<?= $this->section('content-footer') ;?>
<!-- CODE HERE -->
<?= $this->endSection() ;?>


<!-- JavaScript Section -->
<?= $this->section('scripts') ?>
    <script>
        <?php if (session()->getFlashdata('success')): ?>
            <?= view('components/alerts/success_alert', ['message' => session()->getFlashdata('success')]) ?>
        <?php elseif (session()->getFlashdata('error')): ?>
            <?= view('components/alerts/error_alert', ['message' => session()->getFlashdata('error')]) ?>
        <?php endif; ?>
    </script>

   <script>
        function loadStatcards() {
            $.ajax({
                url: "<?= base_url('api/attendance/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total Days',
                            value: data.total,
                            description: 'Total number of days present',
                            icon: '<i class="bi bi-collection-fill"></i>'
                        },
                        {
                            title: 'Absent with Leave',
                            value: data.present,
                            description: 'Number of total presents',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Absent without Leave',
                            value: data.absent,
                            description: 'Number of absent without official leave',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Leave  ',
                            value: data.leave,
                            description: 'Number of absent with official leave',
                            icon: '<i class="bi bi-archive-fill"></i>'
                        }
                    ];

                    const container = $('#statcard-container');
                    container.empty();

                    $.each(cards, function (i, card) {
                        const html = `
                            <div class="statcard-body">
                                <div class="statcard-header">
                                    <h5>${card.title}</h5>
                                </div>
                                <div class="statcard-value">
                                    <h3>${card.value}</h3>
                                </div>
                                <div class="statcard-description">
                                    <p>${card.description}</p>
                                </div>
                                <div class="statcard-icon">
                                    ${card.icon}
                                </div>
                            </div>
                        `;
                        container.append(html);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Statcard update failed:", error);
                }
            });
        }

        $(document).ready(function () {
            loadStatcards(); // Load immediately on page load
            setInterval(loadStatcards, 10000); // Refresh every 10 seconds
        });
    </script>

    <script>
    $(document).ready(function () {
    // When a view button is clicked
    $(document).on('click', '.btn-view', function (e) {
        console.log('wtf');
        const downloadId = $(this).data('id');
        console.log(`<?= base_url('api/download') ?>/${downloadId}`);

        $.ajax({
        url: `<?= base_url('api/download') ?>/${downloadId}`,
        method: 'GET',
        dataType: 'json',
        success: function (res) {
            if (res && res.data) {
            const data = res.data;

            // Populate modal fields
            $('#download_id').val(data.download_id);
            $('#download_filename').val(data.download_filename);
            // $('#download_file').val(data.download_file);
            $('#download_remarks').val(data.download_remarks);
            $('#download_permission').val(data.download_permission);
            $('#download_status').val(data.download_status);
            $('#download_expiry_date').val(data.download_expiry_date);
            $('#download_createdAt').text(data.download_createdAt);
            $('#download_updatedAt').text(data.download_updatedAt);

            // Show modal
            const modalEl = document.getElementById('viewDownloadModal');
            const modalInstance = new bootstrap.Modal(modalEl);
            modalInstance.show();
            } else {
            alert('No data returned from API.');
            }
        },
        error: function (xhr, status, error) {
            console.error("API error:", error);
            alert('Failed to fetch download details.');
        }
        });
    });
        });
    </script>

<?= $this->endSection() ?>