<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "<?= esc($message) ?>",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
});
</script>
