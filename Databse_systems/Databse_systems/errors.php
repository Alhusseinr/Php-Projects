<?php if(count($errors) > 0) : ?>
<div class="alert-danger" style="border-radius: 5px; margin-bottom: 1em;">
    <?php foreach ($errors as $error) : ?>
    <p style="padding: 5px 0 5px 10px; margin-bottom: 0px; ">
        <?php echo $error ?>
    </p>
    <?php endforeach; ?>
</div>
<?php endif ?>
