
<?= $this->extend('layouts/default') ?>

<!-- Page Title Section -->
<?= $this->section('title') ?>
    <?= $title ?? 'Attendance Logs' ?>
<?= $this->endSection() ?>

<!-- Optional Head Section for Additional Styles -->
<?= $this->section('head') ;?>
<style>
        h1 {
            font-size: 3rem;
        }
        p {
            font-size: 1.3rem;
        }
        .logo {
            width: 200px;
            margin-bottom: 20px;
        }
    </style>
 
<?= $this->endSection() ;?>

<?= $this->section('content') ;?>
<div class="wip">
    <img src="<?= base_url('assets/images/coming-soon.png') ?>" alt="Logo" class="logo"> <!-- Optional logo -->
    <h1>Coming Soon</h1>
    <p>We're working hard to launch our new system.<br>Stay tuned!</p>
    <p>Absorb to Unlock!!!!</p>
</div>


<?= $this->endSection() ;?>

