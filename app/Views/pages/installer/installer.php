<?= $this->extend('layouts/main') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Installer' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>

<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Installer</h3>
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
        <?php
            $target = '#installerModal';
            $btnName = 'Add new Installer';
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
            $tableId = 'installerTable';
            $columns = ['#',
                        'Image',
                        'Name',
                        'Description',
                        'File Name',
                        'File Type',
                        'Remarks',
                        'Status',
                        'Actions'];
            $dataUrl = base_url('api/installer/list'); // Endpoint that returns JSON data

            // Load the reusable DataTable view
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Add modal  -->
    <?= view('components/partials/modal', [
        'modalId' => 'installerModal',
        'modalIdLabel' => 'installerModalLabel',
        'modalTitle' => 'Add New installer',
        'modalBodyView' => 'components/create_forms/create_installer',
        'formId' => 'installerForm',
        'api' => 'api/installer/add'
    ]); ?>

    <!-- View Modal  -->
    <?= view('components/view_forms/view_installer_modal', [
        'modalId' => 'viewinstallerModal',
        'modalIdLabel' => 'viewinstallerModalLabel',
        'modalTitle' => 'installer',
        'formId' => 'viewInstallerForm',
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
                url: "<?= base_url('api/installer/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total installers',
                            value: data.total,
                            description: 'Total number of installers created',
                            icon: '<i class="bi bi-megaphone-fill"></i>'
                        },
                        {
                            title: 'Active installers',
                            value: data.active,
                            description: 'Number of currently active installers',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        // {
                        //     title: 'Expired installers',
                        //     value: data.expired,
                        //     description: 'Number of installers that have expired',
                        //     icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        // },
                        {
                            title: 'Archived installers',
                            value: data.archived,
                            description: 'Number of installers archived',
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
        const installerId = $(this).data('id');
        console.log(`<?= base_url('api/installer') ?>/${installerId}`);

        $.ajax({
        url: `<?= base_url('api/installer') ?>/${installerId}`,
        method: 'GET',
        dataType: 'json',
        success: function (res) {
            if (res && res.data) {
            const data = res.data;

            // Populate modal fields
            $('#viewInstallerForm').attr('action', `<?= base_url('api/installer/update/') ?>${installerId}`);
            $('#installer_id').text(data.installer_id);
            $('#installer_title').val(data.installer_title);
            $('#installer_description').val(data.installer_description);
            $('#installer_category').val(data.installer_category);
            $('#installer_attachment').val(data.installer_attachment);
            $('#installer_status').val(data.installer_status);
            $('#installer_expiry_date').text(data.installer_expiry_date);
            $('#installer_createdAt').text(data.installercreatedAt);
            $('#installer_updatedAt').text(data.installer_updatedAt);


            // Show modal
            const modalEl = document.getElementById('viewInstallerModal');
            const modalInstance = new bootstrap.Modal(modalEl);
            modalInstance.show();
            } else {
            alert('No data returned from API.');
            }
        },
        error: function (xhr, status, error) {
            console.error("API error:", error);
            alert('Failed to fetch installer details.');
        }
        });
    });
        });
    </script>



<?= $this->endSection() ?>

