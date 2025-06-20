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
    <?= $title ?? 'Announcement' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
<?= $this->endSection() ;?>

<?= $this->section('content-header') ;?>
    <div class="main-content-page-header">
        <h3>Announcement</h3> 
        <div></div> <!-- Optional placeholder for buttons/filters/etc -->
    
        <?php if($role === 'admin'){?>
         <?php  
            $target = '#announcementModal';
            $btnName = 'Add new Announcement';
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
            $tableId = 'announcementTable';
            $columns = ['#','Title', 'Category/Type', 'Status', 'Expiry Date','Actions'];
            $dataUrl = base_url('api/announcement/list'); // Endpoint that returns JSON data

            // Load the reusable DataTable view
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <!-- Add modal  -->
    <?= view('components/partials/modal', [
        'modalId' => 'announcementModal',
        'modalIdLabel' => 'announcementModalLabel',
        'modalTitle' => 'Add New Announcement',
        'modalBodyView' => 'components/create_forms/create_announcement',
        'formId' => 'announcementForm',
        'api' => 'api/announcement/add'
    ]); ?>

    <!-- View Modal  -->
    <?= view('components/view_forms/view_announcement_modal', [
        'modalId' => 'viewAnnouncementModal',
        'modalIdLabel' => 'viewAnnouncementModalLabel',
        'modalTitle' => 'Announcement',
        'formId' => 'viewAnnouncementForm',
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
                            title: 'Total Announcements',
                            value: data.total,
                            description: 'Total number of announcements created',
                            icon: '<i class="bi bi-megaphone-fill"></i>'
                        },
                        {
                            title: 'Active Announcements',
                            value: data.active,
                            description: 'Number of currently active announcements',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Expired Announcements',
                            value: data.expired,
                            description: 'Number of announcements that have expired',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        {
                            title: 'Archived Announcements',
                            value: data.archived,
                            description: 'Number of announcements archived',
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
        const announcementId = $(this).data('id');
        console.log(`<?= base_url('api/announcement') ?>/${announcementId}`);

        $.ajax({
        url: `<?= base_url('api/announcement') ?>/${announcementId}`,
        method: 'GET',
        dataType: 'json',
        success: function (res) {
            if (res && res.data) {
            const data = res.data;

            $('#viewAnnouncementForm').attr('action', `<?= base_url('api/announcement/update/') ?>${announcementId}`);

            // Populate modal fields
            $('#announcement_id').text(data.announcement_id);
            $('#announcement_title').val(data.announcement_title);
            $('#announcement_description').val(data.announcement_description);
            $('#announcement_category').val(data.announcement_category);
            $('#announcement_attachment').val(data.announcement_attachment);
            $('#announcement_status').val(data.announcement_status);
            $('#announcement_expiry_date').text(data.announcement_expiry_date);
            $('#announcement_createdAt').text(data.announcementcreatedAt);
            $('#announcement_updatedAt').text(data.announcement_updatedAt);

            $('#filePreview').attr('src', `<?= base_url('api/announcement/viewFile/') ?>${data.announcement}`);


            // Show modal
            const modalEl = document.getElementById('viewAnnouncementModal');
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

