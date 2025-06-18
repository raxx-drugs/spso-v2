<?= $this->extend('layout/base') ?>

<?= $this->section('body') ?>

<div class="main-wrapper">
    <header class="header"><?= $this->include('components/header') ?></header>
    <aside class="sidebar"><?= $this->include('components/sidebar') ?></aside>

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
</div>

<?= $this->endSection() ?>
