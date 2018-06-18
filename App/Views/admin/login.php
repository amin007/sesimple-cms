<?php

use App\Components\Helpers\View;
use App\Components\UrlHelper;

$add_in_body_class = ' text-center ';

?>

<?php ob_start(); ?>
<style media="screen">
html,
body {
    height: 100%;
}

body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
}
.form-signin .checkbox {
    font-weight: 400;
}
.form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
.form-signin .form-control:focus {
    z-index: 2;
}
.form-signin input[name="username"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
.form-signin input[name="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
</style>
<?php $add_in_head = ob_get_contents(); ob_end_clean(); ?>

<?= View::render('admin/common/header', array_merge($params, [
    'no_header' => true
]), true) ?>

<form class="form-signin" method="post">
    <div class="display-4">
        Sesimple
    </div>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <?php if ($messageError = UrlHelper::getFlashSession('messageError')) : ?>
        <div class="alert alert-danger">
            <?= $messageError ?>
        </div>
    <?php endif ?>

    <?php if ($message = UrlHelper::getFlashSession('message')) : ?>
        <div class="alert alert-info">
            <?= $message ?>
        </div>
    <?php endif ?>

    <label for="inputUsername" class="sr-only">Username</label>
    <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
    <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?></p>
</form>

<?= View::render('admin/common/footer', [
    'no_footer' => true
], true) ?>
