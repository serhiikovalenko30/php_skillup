<?php
use App\Auth;
?>

<div class="navbar-nav">
    <a class="nav-link active" aria-current="page" href="<?php echo url('main_page'); ?>">Home</a>
    <a class="nav-link" href="<?php echo url('news_list'); ?>">List</a>
    <a class="nav-link" href="<?php echo url('detail'); ?>">Detail</a>
    <a class="nav-link" href="<?php echo url('info'); ?>">Info</a>
    <a class="nav-link" href="<?php echo url('contacts'); ?>">Contacts</a>
    <?php if(Auth::isAuth()) {?>
        <a class="nav-link fw-bold" href="<?php echo url('profile'); ?>"><?php echo Auth::user()->login; ?></a>
        <a class="nav-link fw-bold" href="<?php echo url('logout'); ?>">[Logout]</a>
    <?php } else { ?>
        <a class="nav-link" href="<?php echo url('login'); ?>">Profile</a>
    <?php } ?>

</div>