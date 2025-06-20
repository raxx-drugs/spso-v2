<?= $this->extend('layouts/main') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Accomplish Report List' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
    <!-- Custom stylesheet for content header styling -->
    <link rel="stylesheet" href="<?= base_url('assets/css/modal.css'); ?>?v=1">
<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Accomplishment List</h3> 
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
        <?php 
            $target = '#createAccomplishmentModal';
            $btnName = 'Add Accomplishment';
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
<div class="d-flex">
    <div>
    <img src="<?= base_url('assets/images/coming-soon.png') ?>" alt="Logo" class="logo"> <!-- Optional logo -->
    <h1>Coming Soon</h1>
    <p>We're working hard to launch our new system.<br>Stay tuned!</p>
    <p>Absorb to Unlock!!!! <strong>Sorry Boss, nakatulog</strong></p>
    </div>
</div>
    

    <!-- DataTable container -->
    <div class="table-container" id="table-container">
        <?php
            // Set DataTable ID, column headers, and data source URL
            $tableId = 'accomplishmentTable';
            $columns = ['#', 'Employee', 'Date', 'Category', 'Description', 'Hours ','Remarks', 'Actions'];
            $dataUrl = base_url('api/accomplishment/list'); // Endpoint that returns JSON data

            // Load the reusable DataTable view
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Inject the reusable modal -->
    <?= view('components/partials/modal', [
        'modalId' => 'createAccomplishmentModal',
        'modalIdLabel' => 'createAccomplishmentModalLabel',
        'modalTitle' => 'Add New Accomplishment',
        'modalBodyView' => 'components/create_forms/create_accomplishment',
        'formId' => 'accomplishmentForm',
        'api' => 'api/accomplishment/add'
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
                url: "<?= base_url('api/announcement/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                           {
                                title: 'Total Accomplishment',
                                value: data.total,
                                description: 'Total number of accomplishment uploaded',
                                icon: '<i class="bi bi-bar-chart-fill"></i>' // Changed to bar chart for total
                            },
                            {
                                title: 'Completed Accomplishment',
                                value: data.active,
                                description: 'Number of completed accomplishment report',
                                icon: '<i class="bi bi-check2-square"></i>' // Changed to check square for completed
                            },
                            {
                                title: 'Ongoing Accomplishment',
                                value: data.expired,
                                description: 'Number of ongoing accomplishment report',
                                icon: '<i class="bi bi-hourglass-split"></i>' // Changed to hourglass for ongoing
                            },
                                                
                            // {
                        //     title: 'Archived Downloads',
                        //     value: data.archived,
                        //     description: 'Number of downloads archived',
                        //     icon: '<i class="bi bi-archive-fill"></i>'
                        // }
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

