<?php

use App\Components\Helpers\View;

?>

<?= View::render('common/header', $params, true) ?>

<div class="container">

    <div class="alert alert-success" role="alert">
        <h1 class="display-4">Sesimple Framework</h1>
        <?= implode(' ', $messages) ?>
        <hr>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
    </div>

    <?php if ($pages) : ?>
        <hr>
        <div class="list-group">
            <?php foreach ($pages as $page) : ?>
                <a href="<?= $page->getUrl() ?>" class="list-group-item list-group-item-action">
                    <?= $page->getTitle() ?>
                </a>
            <?php endforeach ?>
        </div>
    <?php endif ?>

</div>

<?php ob_start(); ?>
    <script>
        $(function () {
            console.log('this is an example how to append script before <body> ends $add_in_foot');
        });
    </script>
<?php $add_in_foot = ob_get_contents(); ob_end_clean(); ?>

<?= View::render('common/footer', [], true) ?>
