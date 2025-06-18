<?php
// Global session redirect logic
if (!session()->has('user')) {
    if (current_url() !== base_url()) {
        header('Location: ' . base_url());
        exit;
    }
} elseif (current_url() === base_url()) {
    header('Location: ' . base_url('dashboard'));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('layout/partials/head_links') ?>
</head>
<body>
    <?= $this->renderSection('body') ?>
    <?= $this->include('layout/partials/script_links') ?>
</body>
</html>
