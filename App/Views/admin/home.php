<?php

use App\Components\Helpers\View;
use App\Components\Auth;

?>

<?= View::render('admin/common/header', $params, true) ?>

<div class="container">
    <h1 class="display-4">Sesimple CMS</h1>
    <p>Welcome, <strong><?= Auth::getAuthUser()->getName() ?></strong>.</p>
</div>

<?= View::render('admin/common/footer', [], true) ?>
