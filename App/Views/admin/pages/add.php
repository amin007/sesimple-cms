<?php

use App\Components\Helpers\View;
use App\Components\Auth;

?>

<?= View::render('admin/common/header', $params, true) ?>

<div class="container">
    <h1 class="display-4">Sesimple CMS</h1>
    <p>Welcome, <strong><?= Auth::getAuthUser()->getName() ?></strong>.</p>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
            <li class="breadcrumb-item <?= @$pageData['id'] ? '' : 'active' ?>" aria-current="page"><?= @$pageData['id'] ? 'Update Page' : 'Create New Page' ?></li>
            <?php if (@$pageData['id']) : ?>
                <li class="breadcrumb-item active" aria-current="page"><?= @$pageData['id'] ?></li>
            <?php endif ?>
        </ol>
    </nav>

    <form method="post">

        <div class="form-group">
            <input name="title" type="text" class="form-control input-lg" id="input-title" placeholder="Title" value="<?= @$pageData['title'] ?>" autofocus required>
        </div>

        <div class="form-group">
            <textarea name="body" class="form-control form-control--input-body" rows="8" cols="80" placeholder="Body" required><?= @$pageData['body'] ?></textarea>
        </div>

        <input type="hidden" name="page_id" value="<?= @$pageData['id'] ?>">
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">

        <div class="clearfix">
            <button type="submit" class="btn btn-primary"><?= @$pageData['id'] ? 'Update Page' : 'Create Page' ?></button>
            <?php if (@$pageData['id']) : ?>
                <a href="/admin/pages/add?page_id=<?= @$pageData['id'] ?>&action=remove" class="btn btn-danger">Remove Page</a>
            <?php endif ?>
            <a href="/admin" class="btn btn-outline-primary float-right">Back to Dashboard</a>
        </div>
    </form>

</div>

<?php ob_start(); ?>
    <script>
    var simplemde = new SimpleMDE({
        element: $('.form-control--input-body')[0]
    });
    </script>
<?php $add_in_foot = ob_get_contents(); ob_end_clean(); ?>
<?= View::render('admin/common/footer', [], true) ?>
