<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Global Script: Fullscreen Button Handler -->
<script>
document.getElementById('fullscreenBtn')?.addEventListener('click', function () {
    const iframe = document.getElementById('filePreview');
    if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
    } else if (iframe.webkitRequestFullscreen) {
        iframe.webkitRequestFullscreen();
    } else if (iframe.msRequestFullscreen) {
        iframe.msRequestFullscreen();
    } else {
        alert('Fullscreen not supported in this browser.');
    }
});
</script>

<!-- Page-specific scripts -->
<?= $this->renderSection('scripts') ?>
