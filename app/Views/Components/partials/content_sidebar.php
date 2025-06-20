<!-- I want this php session for other components -->
<?php 
    if (session()->has('user')): 
        $sub_page = session('sub_page');
    endif;
;?>
<!-- Custom Styles -->
<link href="<?= base_url('assets/css/sidebar.css') ?>" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="sidebar-container">
    <ul class="sidebar-menu">
        <?php if($sub_page === 'information'){?>
            <a class="nav-link spa-link"  href="#"><li><span>Personal Informationv</span></li></a>  
            <a class="nav-link spa-link"  href="#"><li><span>Family Background</span></li></a>  
            <a class="nav-link spa-link"  href="#"><li><span>Education</span></li></a>  
            <a class="nav-link spa-link"  href="#"><li><span>Eligibility</span></li></a>  
            <a class="nav-link spa-link"  href="#"><li><span>Work Experience</span></li></a>  
        <?php }?>

    </ul>

</div>

<script>
    
</script>


