<!-- I want this php session for other components -->
<?php 
    if (session()->has('user')): 
        $name = session('user'); 
        $role = session('role'); 
        $title = session('title'); 
        $current_page = session('current_page');
    endif;
;?>
<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Employee Portal' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
    <!-- Custom stylesheet for content header styling -->

<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Employee Portal</h3> 
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
        <?php if($role === 'admin'){?>
         <?php 
            $target = '#employeeModal';
            $btnName = 'Add Employee';
            echo view('components/buttons/add_header_btn', compact('target', 'btnName'));
        ?>
        <?php }?>
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
            $tableId = 'usersTable';
            $columns = ['#', 'Name', 'Email',  'Role', 'Actions'];
            $dataUrl = base_url('api/user/list'); // Endpoint that returns JSON data

            // Load the reusable DataTable view
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Modal Section -->
    <!-- Add modal  -->
    <?= view('components/partials/modal', [
        'modalId' => 'employeeModal',
        'modalIdLabel' => 'employeeModalLabel',
        'modalTitle' => 'Add New User',
        'modalBodyView' => 'components/create_forms/create_user',
        'formId' => 'employeeForm',
        'api' => 'api/user/add'
    ]); ?>

    <!-- View Modal  -->
    <?= view('components/view_forms/view_employee_manage_modal', [
        'modalId' => 'viewEmployeeModal',
        'modalIdLabel' => 'viewEmployeeModalLabel',
        'modalTitle' => 'Employee Modal',
        'formId' => 'viewEmployeeModalForm',
    ]); ?>

   

<?= $this->endSection() ?>

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
                url: "<?= base_url('api/user/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total Announcements',
                            value: data.total,
                            description: 'Total number of user currently active',
                            icon: '<i class="bi bi-megaphone-fill"></i>'
                        }
                        ,
                        {
                            title: 'Total Admin Accounts',
                            value: data.admin,
                            description: 'Number of admin accounts registered',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Total User Accounts',
                            value: data.user,
                            description: 'Number of user accounts registered',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        // {
                        //     title: 'Archived Announcements',
                        //     value: data.archived,
                        //     description: 'Number of announcements archived',
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
            $(document).on('click', '.btn-view', function () {
                const employeeId = $(this).data('id');
                console.log("View button clicked for ID:", employeeId); // ✅ ADD THIS LINE

                $.ajax({
                    url: `<?= base_url('api/user') ?>/${employeeId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        if (res?.data) {
                            const data = res.data;

                            // ✅ Set the form action with the ID
                            $('#viewEmployeeForm').attr('action', `<?= base_url('api/user/update/') ?>${employeeId}`);
                            // $('#download_id').text(data.download_id);
                            // $('#download_file_name').val(data.download_file_name);
                            // $('#download_remarks').val(data.download_remarks);
                            // $('#download_permission').val(data.download_permission);
                            // $('#download_status').val(data.download_status);
                            // $('#download_expiry_date').val(data.download_expiry_date);
                            // $('#download_createdAt').text(data.download_createdAt);
                            // $('#download_updatedAt').text(data.download_updatedAt);


                            new bootstrap.Modal(document.getElementById('viewEmployeeModal')).show();
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
