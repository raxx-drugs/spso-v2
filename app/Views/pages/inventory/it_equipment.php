<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'IT Equipments' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>

<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>IT Equipments</h3> 
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
        <?php 
            $target = '#itEquipmentModal';
            $btnName = 'Add new It Equipment';
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
            $tableId = 'announcementTable';
            $columns = ['#','Unit', 'Serial Number',  'Status', 'Actions'];
            $dataUrl = base_url('api/inventory/it-equipment/list'); // Endpoint that returns JSON data

            // Load the reusable DataTable view
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Add modal  -->
    <?= view('components/partials/modal', [
        'modalId' => 'itEquipmentModal',
        'modalIdLabel' => 'itEquipmentModalLabel',
        'modalTitle' => 'Add New IT Equipment',
        'modalBodyView' => 'components/create_forms/create_it_equipment',
        'formId' => 'itEquipmentForm',
        'api' => 'api/inventory/it-equipment/add'
    ]); ?>

    <!-- View Modal  -->
    <?= view('components/view_forms/view_announcement_modal', [
        'modalId' => 'viewItEquipmentModal',
        'modalIdLabel' => 'viewItEquipmentModalLabel',
        'modalTitle' => 'IT Equipment',
        'formId' => 'viewItEquipmentForm',
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
                url: "<?= base_url('api/inventory/it-equipment/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total It Equipment',
                            value: data.total,
                            description: 'Total number of IT Equipments',
                            icon: '<i class="bi bi-collection-fill"></i>'
                        },
                        {
                            title: 'Working It Equipment',
                            value: data.working,
                            description: 'Number of currently working It Equipment',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Damaged It Equipment',
                            value: data.damaged,
                            description: 'Number of damaged It Equipments ',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        {
                            title: 'For Disposal It Equipment',
                            value: data.disposal,
                            description: 'Number of It Equipment for disposal',
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


<?= $this->endSection() ?>

