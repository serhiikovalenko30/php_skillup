<div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="<?php echo url('main_page'); ?>">Home</a>
    <a class="nav-link" href="<?php echo url('news_list'); ?>">List</a>
    <a class="nav-link" href="<?php echo url('detail'); ?>">Detail</a>
    <a class="nav-link" href="<?php echo url('info'); ?>">Info</a>
    <a class="nav-link" href="<?php echo url('contacts'); ?>">Contacts</a>
    <?php if(isAuthUser()) {?>
        <a class="nav-link fw-bold" href="<?php echo url('profile'); ?>"><?php echo $_SESSION['user']['name'];?></a>
        <a class="nav-link fw-bold" href="<?php echo url('logout'); ?>">[Logout]</a>
    <?php } else { ?>
        <a class="nav-link" href="<?php echo url('auth'); ?>">Profile</a>
    <?php } ?>

</div>