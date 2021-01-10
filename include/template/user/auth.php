<h1>Auth</h1>
<div class="row mb-3">
    <div class="col-md-4 offset-4">
        <form method="post" action="<?php echo url('auth')?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if($arData['error']) { ?>
            <div class="alert alert-danger mt-3" role="alert"><?php echo $arData['error']; ?></div>
        <?php } ?>
    </div>
</div>