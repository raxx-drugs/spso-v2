<?= $this->extend('layout/base') ?>

<?= $this->section('body') ?>

<?php if (session()->has('user')): ?>
    <div class="header"><?= $this->include('components/header') ?></div>

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
<?php else: ?>
    <main id="content"><?= $this->renderSection('content') ?></main>
<?php endif; ?>

<?= $this->renderSection('footer') ?>

<?= $this->endSection() ?>
