<?php

use App\Components\Helpers\View;
use App\Components\Auth;

?>

<?= View::render('common/header', $params, true) ?>

<div class="container">
    <h1 class="display-4"><?= $page->getTitle() ?></h1>
    <?= $page->getBody(true) ?>
</div>

<?= View::render('common/footer', [], true) ?>
