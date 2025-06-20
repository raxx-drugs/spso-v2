<!-- request page (Leave Requests) -->

<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Request Leave' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>

<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Request Leave</h3> 
        <div></div>
        <?php 
            $target = '#createReqLeaveModal';
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
            $tableId = 'reqLeaveTable';
            $columns = ['#', 'Employee Name', 'Leave Type', 'Date',  'Status', 'Actions'];
            $dataUrl = base_url('api/request/leave/list');
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Create Modal -->
    <?= view('components/partials/modal', [
        'modalId' => 'createReqLeaveModal',
        'modalIdLabel' => 'createReqLeaveModalLabel',
        'modalTitle' => 'Add Leave Request',
        'modalBodyView' => 'components/create_forms/create_req_leave',
        'formId' => 'reqLeaveForm',
        'api' => 'api/request/leave/add'
    ]); ?>

    <!-- View Modal -->
    <?= view('components/view_forms/view_req_leave_modal', [
        'api' => 'api/request/leave/update'
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
                url: "<?= base_url('api/request/leave/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total Requests',
                            value: data.total,
                            description: 'Total number of leave requests',
                            icon: '<i class="bi bi-collection-fill"></i>'
                        },
                        {
                            title: 'Approved',
                            value: data.approved,
                            description: 'Approved leave requests',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Pending',
                            value: data.pending,
                            description: 'Pending leave requests',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        {
                            title: 'Denied',
                            value: data.denied,
                            description: 'Denied leave requests',
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
                    url: `<?= base_url('api/request/leave') ?>/${id}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        if (res && res.data) {
                            const data = res.data;

                            $('#req_leave_id').val(data.req_leave_id);
                            $('#leave_employee_name').val(data.leave_employee_name);
                            $('#leave_type').val(data.leave_type);
                            $('#leave_start_date').val(data.leave_start_date);
                            $('#leave_end_date').val(data.leave_end_date);
                            $('#leave_status').val(data.leave_status);
                            $('#leave_createdAt').text(data.leave_createdAt);
                            $('#leave_updatedAt').text(data.leave_updatedAt);

                            const modalEl = document.getElementById('viewReqLeaveModal');
                            const modalInstance = new bootstrap.Modal(modalEl);
                            modalInstance.show();
                        } else {
                            alert('No data returned from API.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("API error:", error);
                        alert('Failed to fetch leave request details.');
                    }
                });
            });
        });
    </script>

<?= $this->endSection() ?>
