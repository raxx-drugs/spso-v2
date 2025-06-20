<!-- I want this php session for other components -->
<?php 
    if (session()->has('user')): 
        $name = session('user'); 
        $role = session('role'); 
        $title = session('title'); 
        $current_page = session('current_page');
    endif;
;?>
<!-- Custom Styles -->
<link href="<?= base_url('assets/css/partials/sidebar.css') ?>" rel="stylesheet">

<div class="sidebar-container">
    <div class="sidebar-header">
        <div class="sidebar-user">
            <div class="sidebar-user-circle">
                <img src="<?= base_url('assets/images/astignatiger.png') ?>" alt="User Image" class="user-image">
            </div>
        </div>
        <?php if($role === 'admin'){?>
            <span>ADMIN</span>
        <?php }?>
        <?php if($role != 'admin'){?>
            <span>USER</span>
        <?php }?>
        <div class="sidebar-user-name">
            <span><?php echo $name?></span>
        </div>
    </div>
    <ul class="sidebar-menu">
        <?php if($current_page === 'employee-portal'){?>
            <li></i><span><strong>Portal</strong></span></li><hr>
            <?php if($role === 'admin'){?>
                <a class="nav-link spa-link"  href="<?= base_url('portal/employee-portal') ?>"><li><i class="bi bi-person-lines-fill"></i><span>Employees</span></li></a>  
            <?php }?>
            <a class="nav-link spa-link"  href="<?= base_url('portal/announcement') ?>"><li><i class="bi bi-megaphone-fill"></i><span>Announcement</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('portal/information') ?>"><li><i class="bi bi-info-circle-fill"></i><span>Information</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('portal/download') ?>"><li><i class="bi bi-file-earmark-arrow-down-fill"></i><span>Download</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('portal/inventory') ?>"><li><i class="bi bi-tools"></i><span>Equipment</span></li></a>  
        <?php }?>

        <?php if($current_page === 'request'){?>
            <li></i><span><strong>Request</strong></span></li><hr>
            <a class="nav-link spa-link"  href="<?= base_url('request/it-equipment') ?>"><li><i class="bi bi-person-lines-fill"></i><span>It Equipment</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('request/office-supply') ?>"><li><i class="bi bi-person-lines-fill"></i><span>Office Supply</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('request/leave') ?>"><li><i class="bi bi-person-lines-fill"></i><span>Leave</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('request/it-support') ?>"><li><i class="bi bi-person-lines-fill"></i><span>It Support</span></li></a>   
        <?php }?>
        <?php if($current_page === 'attendance'){?>
            <li></i><span><strong>Attendance</strong></span></li><hr>
            <a class="nav-link spa-link"  href="<?= base_url('attendance/manage-attendance') ?>"><li><i class="bi bi-person-lines-fill"></i><span>Manage</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('attendance/attendance-logs') ?>"><li><i class="bi bi-person-lines-fill"></i><span>Attendance Logs</span></li></a>  
        <?php }?>
        <?php if($current_page === 'inventory'){?>
            <li></i><span><strong>Inventory</strong></span></li><hr>
            <a class="nav-link spa-link"  href="<?= base_url('inventory/it-equipment') ?>"><li><i class="bi bi-person-lines-fill"></i><span>It Equipment</span></li></a>  
            <a class="nav-link spa-link"  href="<?= base_url('inventory/office-supply') ?>"><li><i class="bi bi-person-lines-fill"></i><span>Office Supply</span></li></a>  
        <?php }?>

    </ul>
    <!-- <div class="sidebar-footer">
        <a href="<?= base_url('auth/logout') ?>" class="logout"><i class="bi bi-box-arrow-left"></i><span>Logout</span></a>
    </div> -->

    <button onclick="toggleSidebar()" class="btn btn-sm sidebar-toggle-btn">
        <i class="bi bi-list"></i>
    </button>

</div>

<script>
    
</script>


