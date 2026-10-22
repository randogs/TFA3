<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
</head>
<body>
    <h1><?= esc($title) ?></h1>
    <p><a href="<?= site_url('user-accounts') ?>">Back to User Accounts</a></p>

    <form action="<?= site_url('users') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username *</label><br>
        <input id="username" name="username" value="<?= esc($values['username']) ?>" maxlength="50"><br>
        <?php if (isset($errors['username'])): ?>
            <small><?= esc($errors['username']) ?></small><br>
        <?php endif; ?>

        <br><label for="full_name">Full name *</label><br>
        <input id="full_name" name="full_name" value="<?= esc($values['full_name']) ?>" maxlength="100"><br>
        <?php if (isset($errors['full_name'])): ?>
            <small><?= esc($errors['full_name']) ?></small><br>
        <?php endif; ?>

        <br><button type="submit">Save User</button>
    </form>
</body>
</html>