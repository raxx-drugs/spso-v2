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
    <?= $title ?? 'Download' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ?>
    
<?= $this->endSection() ?>

<!-- Content Header Section -->
<?= $this->section('content-header') ?>
    <div class="main-content-page-header">
        <h3>Download</h3> 
        <div></div>
        <?php if($role === 'admin'){?>
        
        <?php 
            $target = '#createDownloadModal';
            $btnName = 'Add new File';
            echo view('components/buttons/add_header_btn', compact('target', 'btnName'));
        ?>
         <?php }?>
    </div>
    <hr>
<?= $this->endSection() ?>

<!-- Stat Card Section -->
<?= $this->section('content-statcard') ?>
    <div class="statcard-container" id="statcard-container"></div>
<?= $this->endSection() ?>

<!-- Main Content Section -->
<?= $this->section('content') ?>
    <div class="table-container" id="table-container">
        <?php
            $tableId = 'downloadTable';
            $columns = ['#', 'Filename', 'File Type', 'Remarks', 'Permission', 'Status','Expiry Date', 'Actions'];
            $dataUrl = base_url('api/download/list');
            echo view('components/partials/datatable', compact('tableId', 'columns', 'dataUrl'));
        ?>
    </div>

    <?= view('components/partials/modal', [
        'modalId' => 'createDownloadModal',
        'modalIdLabel' => 'createDownloadModalLabel',
        'modalTitle' => 'Add New Download',
        'modalBodyView' => 'components/create_forms/create_download',
        'formId' => 'downloadForm',
        'api' => 'api/download/add'
    ]); ?>

    <?= view('components/view_forms/view_download_modal', [
        'modalId' => 'viewDownloadModal',
        'modalIdLabel' => 'viewDownloadModalLabel',
        'modalTitle' => 'Download',
        'formId' => 'viewDownloadForm',
    ]); ?>
<?= $this->endSection() ?>

<!-- Content Footer Section -->
<?= $this->section('content-footer') ?>
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
                url: "<?= base_url('api/announcement/stats') ?>",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    const cards = [
                        {
                            title: 'Total Downloads',
                            value: data.total,
                            description: 'Total number of downloads uploaded',
                            icon: '<i class="bi bi-collection-fill"></i>'
                        },
                        {
                            title: 'Available Downloads',
                            value: data.active,
                            description: 'Number of currently available downloads',
                            icon: '<i class="bi bi-check-circle-fill"></i>'
                        },
                        {
                            title: 'Expired Downloads',
                            value: data.expired,
                            description: 'Number of downloads that have expired',
                            icon: '<i class="bi bi-exclamation-triangle-fill"></i>'
                        },
                        {
                            title: 'Archived Downloads',
                            value: data.archived,
                            description: 'Number of downloads archived',
                            icon: '<i class="bi bi-archive-fill"></i>'
                        }
                    ];

                    const container = $('#statcard-container');
                    container.empty();

                    cards.forEach(card => {
                        container.append(`
                            <div class="statcard-body">
                                <div class="statcard-header"><h5>${card.title}</h5></div>
                                <div class="statcard-value"><h3>${card.value}</h3></div>
                                <div class="statcard-description"><p>${card.description}</p></div>
                                <div class="statcard-icon">${card.icon}</div>
                            </div>
                        `);
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
                const downloadId = $(this).data('id');
                console.log("View button clicked for ID:", downloadId); // ✅ ADD THIS LINE

                $.ajax({
                    url: `<?= base_url('api/download') ?>/${downloadId}`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (res) {
                        if (res?.data) {
                            const data = res.data;

                            // ✅ Set the form action with the ID
                            $('#viewDownloadForm').attr('action', `<?= base_url('api/download/update/') ?>${downloadId}`);
                            $('#download_id').text(data.download_id);
                            $('#download_file_name').val(data.download_file_name);
                            $('#download_remarks').val(data.download_remarks);
                            $('#download_permission').val(data.download_permission);
                            $('#download_status').val(data.download_status);
                            $('#download_expiry_date').val(data.download_expiry_date);
                            $('#download_createdAt').text(data.download_createdAt);
                            $('#download_updatedAt').text(data.download_updatedAt);

                            $('#filePreview').attr('src', `<?= base_url('api/download/viewFile/') ?>${data.download_id}`);
                            $('#downloadOriginalBtn').attr('href', `<?= base_url('api/download/originalFile/') ?>${data.download_id}`);

                            new bootstrap.Modal(document.getElementById('viewDownloadModal')).show();
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
