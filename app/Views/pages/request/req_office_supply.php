<!-- request page (Office Supplies) -->

<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Request Office Supply' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
    <link rel="stylesheet" href="<?= base_url('assets/css/modal.css'); ?>?v=1">
<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Request Office Supplies</h3> 
        <div></div>
        <?php 
            $target = '#createReqOfficeSupplyModal';
            $btnName = 'Create request';
            echo view('components/buttons/add_header_btn', compact('target', 'btnName'));
        ?>
    </div>
    <hr>
<?= $this->endSection() ;?>

<!--Stat Card Section -->
<?= $this->section('content-statcard') ;?>
    <div class="statcard-container" id="statcard-container"></div>
<?= $this->endSection() ;?>

<!-- Main Page Content Section -->
<?= $this->section('content') ?>

    <!-- DataTable container -->
    <div class="table-container" id="table-container">
        <?php
            $tableId = 'reqOfficeSupplyTable';
            $columns = ['#', 'Item', 'Category', 'Quantity', 'Status', 'Actions'];
            $dataUrl = base_url('api/request/office-supply/list');
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Create Modal -->
    <?= view('components/partials/modal', [
        'modalId' => 'createReqOfficeSupplyModal',
        'modalIdLabel' => 'createReqOfficeSupplyModalLabel',
        'modalTitle' => 'Add Office Supply Request',
        'modalBodyView' => 'components/create_forms/create_req_office_supply',
        'formId' => 'createReqOfficeSupplyForm',
        'api' => 'api/request/office-supply/add'
    ]); ?>

    <!-- View Modal -->
    <?= view('components/view_forms/view_req_office_supply_modal', [
        'api' => 'api/request/office-supply/update'
    ]); ?>

<?= $this->endSection() ?>

<?= $this->section('content-footer') ;?>
<!-- Optional footer content -->
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
                url: "<?= base_url('api/request/office-supply/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total Requests',
                            value: data.total,
                            description: 'Total number of office supply requests',
                            icon: '<i class="bi bi-collection-fill"></i>'
                        },
                        {
                            title: 'Approved',
                            value: data.approved,
                            description: 'Approved requests',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Pending',
                            value: data.pending,
                            description: 'Pending requests',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        {
                            title: 'Cancelled',
                            value: data.cancelled,
                            description: 'Cancelled requests',
                            icon: '<i class="bi bi-x-circle-fill"></i>'
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
            loadStatcards();
            setInterval(loadStatcards, 10000);
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-view', function () {
                const id = $(this).data('id');

                $.ajax({
                    url: `<?= base_url('api/request/office-supply') ?>/${id}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        if (res && res.data) {
                            const data = res.data;

                            $('#req_office_supply_id').val(data.req_office_supply_id);
                            $('#office_item_name').val(data.office_item_name);
                            $('#office_category').val(data.office_category);
                            $('#office_quantity').val(data.office_quantity);
                            $('#office_employee_name').val(data.office_employee_name);
                            $('#office_status').val(data.office_status);
                            $('#office_createdAt').text(data.office_createdAt);
                            $('#office_updatedAt').text(data.office_updatedAt);

                            const modalEl = document.getElementById('viewReqOfficeSupplyModal');
                            const modalInstance = new bootstrap.Modal(modalEl);
                            modalInstance.show();
                        } else {
                            alert('No data returned from API.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("API error:", error);
                        alert('Failed to fetch request details.');
                    }
                });
            });
        });
    </script>

<?= $this->endSection() ?>
