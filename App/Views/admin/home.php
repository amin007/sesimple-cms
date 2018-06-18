<?php

use App\Components\Helpers\View;
use App\Components\Auth;

?>

<?= View::render('admin/common/header', $params, true) ?>

<div class="container">
    <h1 class="display-4">Sesimple CMS</h1>
    <p>Welcome, <strong><?= Auth::getAuthUser()->getName() ?></strong>.</p>

    <a href="/admin/pages/add" class="btn btn-primary">Create New Page</a>

    <?php if ($pages) : ?>
        <hr>
        <div class="list-group">
            <?php foreach ($pages as $page) : ?>
                <a href="/admin/pages/add?page_id=<?= $page['id'] ?>" class="list-group-item list-group-item-action">
                    <?= $page['title'] ?>
                </a>
            <?php endforeach ?>
        </div>
    <?php endif ?>

</div>

<?= View::render('admin/common/footer', [], true) ?>
