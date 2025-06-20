<!-- request page (IT support) -->

<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Request IT Support' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Request IT Support</h3> 
        <div></div>
        <?php 
            $target = '#createReqItSupportModal';
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

    <!-- DataTable container -->
    <div class="table-container" id="table-container">
        <?php
            $tableId = 'reqItSupportTable';
            $columns = ['#', 'Employee Name', 'Description', 'Request Date', 'Status', 'Actions'];
            $dataUrl = base_url('api/request/it-support/list');
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Create Modal -->
    <?= view('components/partials/modal', [
        'modalId' => 'createReqItSupportModal',
        'modalIdLabel' => 'createReqItSupportModalLabel',
        'modalTitle' => 'Add IT Support Request',
        'modalBodyView' => 'components/create_forms/create_req_it_support',
        'formId' => 'reqItSupportForm',
        'api' => 'api/request/it-support/add'
    ]); ?>

    <!-- View Modal -->
    <?= view('components/view_forms/view_req_it_support_modal', [
        'api' => 'api/request/it-support/update'
    ]); ?>

<?= $this->endSection() ?>

<?= $this->section('content-footer') ;?>
<!-- Footer content if any -->
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
                url: "<?= base_url('api/request/it-support/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total Requests',
                            value: data.total,
                            description: 'Total number of IT support requests',
                            icon: '<i class="bi bi-collection-fill"></i>'
                        },
                        {
                            title: 'Resolved',
                            value: data.resolved,
                            description: 'Resolved support tickets',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Pending',
                            value: data.pending,
                            description: 'Pending support tickets',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        {
                            title: 'Cancelled',
                            value: data.cancelled,
                            description: 'Cancelled support requests',
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
            setInterval(loadStatcards, 10000); // Refresh every 10 seconds
        });
    </script>

    <script>
    $(document).ready(function () {
        $(document).on('click', '.btn-view', function () {
            const id = $(this).data('id');

            $.ajax({
                url: `<?= base_url('api/request/it-support') ?>/${id}`,
                method: 'GET',
                dataType: 'json',
                success: function (res) {
                    if (res && res.data) {
                        const data = res.data;

                        $('#req_it_support_id').val(data.req_it_support_id);
                        $('#support_employee_name').val(data.support_employee_name);
                        $('#support_description').val(data.support_description);
                        $('#support_status').val(data.support_status);
                        $('#support_requested_date').val(data.support_requested_date);
                        $('#support_createdAt').text(data.support_createdAt);
                        $('#support_updatedAt').text(data.support_updatedAt);

                        const modalEl = document.getElementById('viewReqItSupportModal');
                        const modalInstance = new bootstrap.Modal(modalEl);
                        modalInstance.show();
                    } else {
                        alert('No data returned from API.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("API error:", error);
                    alert('Failed to fetch support request details.');
                }
            });
        });
    });
    </script>

<?= $this->endSection() ?>
