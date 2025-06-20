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

<!-- I want this php session for other components -->
<?php 
    if (session()->has('user')): 
        $name = session('user'); 
        $role = session('role'); 
        $title = session('title'); 
        $current_page = session('current_page');
    endif;
;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->include('layouts/partials/head_links') ?>
</head>
<body>
    <?= $this->renderSection('body') ?>
    <?= $this->include('layouts/partials/script_links') ?>
</body>
</html>
