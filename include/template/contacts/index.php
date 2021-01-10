<h1>CONTACTS</h1>
<div class="row mb-3">
    <div class="col-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex hic in minima, officiis sequi voluptas.
            Accusantium, asperiores autem dolore eum fugit, iure magni neque nisi, perferendis repellendus
            reprehenderit sed voluptatem!</p>
        <h4>Our contacts</h4>
        <ul class="mb-3">
            <li>Adress: ...</li>
            <li>Telephone: ...</li>
            <li>Email: ...</li>
        </ul>
        <h4>Call our</h4>

        <form method="post" action="<?php echo url('contacts_send_form')?>">
            <div class="mb-3">
                <label for="contact_name" class="form-label">Your name</label>
                <input type="text" class="form-control" id="contact_name" name="contact_name" value="<?= $_POST['contact_name'] ?? ''; ?>" required>
            </div>
            <?php if(isset($name) and !checkName($name)) {?>
                <div class="alert-danger"><?php echo 'incorrect input' ;?></div>
            <?php } ?>
            <div class="mb-3">
                <label for="contact_email" class="form-label">Your email </label>
                <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="name@example.com" value="<?= $_POST['contact_email'] ?? ''; ?>" required>
            </div>
            <?php if(isset($email) and !checkEmail($email)) {?>
                <div class="alert-danger"><?php echo 'incorrect input' ;?></div>
            <?php } ?>
            <div class="mb-3">
                <label for="contact_phone" class="form-label">Your phone</label>
                <input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="<?= $_POST['contact_phone'] ?? ''; ?>" required>
            </div>
            <?php if(isset($phone) and !checkPhone($phone)) {?>
                <div class="alert-danger"><?php echo 'incorrect input' ;?></div>
            <?php } ?>
            <div class="mb-3">
                <label for="contact_massage" class="form-label">Your text</label>
                <textarea class="form-control" id="contact_massage" name="contact_massage" rows="3" required><?= $_POST['contact_massage'] ?? ''; ?></textarea>
            </div>
            <?php if(isset($message) and !checkMassage($message)) {?>
                <div class="alert-danger"><?php echo 'incorrect input' ;?></div>
            <?php } ?>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Send text</button>
            </div>

            <?php if(isset($_SESSION['mail_form'])) { ?>
                <div class="alert alert-<?php echo $_SESSION['mail_form']['status'] == 1 ? 'success' : 'danger'; ?>" role="alert">
                    <?php echo $_SESSION['mail_form']['feedback_text']; ?>
                </div>
                <?php
                unset($_SESSION['mail_form']);
            } ?>
        </form>
    </div>

    <div class="col-4">
        <?php includeBlock('right_news'); ?>
    </div>

</div>