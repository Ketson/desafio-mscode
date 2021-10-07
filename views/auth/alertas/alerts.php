<?php if (isset($_SESSION['erro'])) { ?>
    <div class="alert alert-danger" role="alert">
       <?= $_SESSION['erro'] ?>
    </div>

    <?php unset($_SESSION['erro']) ?>

<?php } ?>

<?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
    </div>

    <?php unset($_SESSION['success']) ?>

<?php } ?>