
<?= $this->extend('layouts/base') ?>

<?= $this->section('body') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/layouts/default.css') ?>?v=1">

    <header ><?= $this->include('components/partials/header') ?></header>
    <aside><?= $this->include('components/partials/sidebar') ?></aside>

    <main class="main" id="content">
        <div class="main-content">
            <div class="main-content-inner">
                <div class="main-content-header">
                    <?= $this->renderSection('sub-page-nav') ?>
                    <?= $this->renderSection('content-header') ?>
                </div>
                <?= $this->renderSection('content-statcard') ?>
                <?= $this->renderSection('content') ?>
                <?= $this->renderSection('content-footer') ?>
            </div>
        </div>
    </main>


<?= $this->endSection() ?>
