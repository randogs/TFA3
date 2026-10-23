<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>
<p><a href="<?= site_url('user-accounts') ?>">Back to User Accounts</a></p>

<form action="<?= site_url($formAction ?? 'users') ?>"
      method="post"
      enctype="multipart/form-data"
      novalidate>
    <?= csrf_field() ?>

    <p>
        <label for="username">Username *</label><br>
        <input id="username" name="username"
               value="<?= esc($values['username'] ?? '') ?>" maxlength="50">
        <?php if (isset($errors['username'])): ?>
            <br><small><?= esc($errors['username']) ?></small>
        <?php endif; ?>
    </p>

    <p>
        <label for="full_name">Full name *</label><br>
        <input id="full_name" name="full_name"
               value="<?= esc($values['full_name'] ?? '') ?>" maxlength="100">
        <?php if (isset($errors['full_name'])): ?>
            <br><small><?= esc($errors['full_name']) ?></small>
        <?php endif; ?>
    </p>

    <?php if (isset($formAction)): ?>
        <?php if (! empty($values['avatar'])): ?>
            <p>
                Current avatar:<br>
                <img src="<?= base_url('uploads/avatars/' . rawurlencode($values['avatar'])) ?>"
                     alt="Current avatar" width="80" height="80">
            </p>
        <?php endif; ?>

        <p>
            <label for="avatar">Avatar (optional; JPG or PNG, up to 2 MB)</label><br>
            <input type="file" id="avatar" name="avatar"
                   accept="image/jpeg,image/png">
            <?php if (isset($errors['avatar'])): ?>
                <br><small><?= esc($errors['avatar']) ?></small>
            <?php endif; ?>
        </p>
    <?php endif; ?>

    <button type="submit">Save User</button>
</form>

<?= $this->endSection() ?>