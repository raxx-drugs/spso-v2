<div class="dropdown">

    <button class="btn " type="button" data-bs-toggle="dropdown">
        <span>Manage</span>
        <i class="action-btn-dropdown bi bi-gear"></i>
    </button>

    <ul class="dropdown-menu dropdown-actions">
        <?php if(isset($view)){ ?>
            <li>
                <a href="<?= esc($view) . '' . esc($id) ?>" 
                    class="dropdown-item btn-view" 
                    data-id="<?= esc($id) ?>" 
                    data-url="<?= esc($view) . '' . esc($id) ?>"
                    data-modal="<?= esc($viewModalId) ?>"
                    >
                    <i class="fa fa-eye me-1"></i> View
                </a>
            </li>
        <?php }?>

        <?php if(isset($edit)){ ?>
            <li>
                <a href="" class="dropdown-item btn-edit" data-id="">
                    <i class="fa fa-pen me-1"></i> Edit
                </a>
            </li>
        <?php }?>


        <?php if(isset($delete)){ ?>
            <li>
                <form action="<?= esc($delete)?>" method="post" onsubmit="return confirm('Are you sure you want to delete this file?');" style="display:inline; " >
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="dropdown-item d-flex justify-content-start" type="submit" style="outline: none; box-shadow: none; border:none">
                        <i class="fa fa-trash me-1"></i> Delete
                    </button>
                </form>
            </li>

        <?php }?>

        <?php if(isset($archive)){ ?>

            <li>
                <form action="<?= esc($archive)?>" method="post" onsubmit="return confirm('Are you sure you want to archive this file?');" style="display:inline; " >
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="dropdown-item d-flex justify-content-start" type="submit" style="outline: none; box-shadow: none; border:none">
                        <i class="fa fa-archive me-1"></i> Archive
                    </button>
                </form>
            </li>
        <?php }?>

   
    </ul>

</div>



<script>
    function showToast(message, type = 'success') {
        const alertHtml = `
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
                <div class="toast align-items-center text-white bg-${type} border-0 show" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>`;
        $('body').append(alertHtml);

        setTimeout(() => {
            $('.toast').remove();
        }, 3000);
    }

    $(document).on('click', '.btn-delete', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        console.log( $(this).attr('href'));
        console.log("wtf");

        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function (response) {
                    // 👇 You can show the toast here
                    showToast(response.message || 'Deleted successfully!');
                    
                    // Optional: Reload after short delay
                    setTimeout(() => location.reload(), 1500);
                },
                error: function (xhr) {
                    showToast('Error deleting item.', 'danger');
                }
            });
        }
    });
</script>


<script>
    $(document).on('click', '.btn-archive', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        const url = $(this).attr('href');

        if (confirm('Are you sure you want to archive this item?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error archiving item');
                }
            });
        }
    });
</script>

<script>
    $(document).on('click', '.btn-view', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const modalId = $(this).data('modal');
        console.log('View button clicked', id,modalId);


    });
</script>

