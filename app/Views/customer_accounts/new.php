<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1><?= esc($title) ?></h1>
<p><a href="<?= site_url('customer-accounts') ?>">Back to Customer Accounts</a></p>

<form action="<?= site_url($formAction ?? 'customers') ?>" method="post" novalidate>
    <?= csrf_field() ?>

    <p>
        <label for="full_name">Full name *</label><br>
        <input id="full_name" name="full_name"
               value="<?= esc($values['full_name'] ?? '') ?>" maxlength="100">
        <?php if (isset($errors['full_name'])): ?>
            <br><small><?= esc($errors['full_name']) ?></small>
        <?php endif; ?>
    </p>

    <p>
        <label for="email">Email *</label><br>
        <input type="email" id="email" name="email"
               value="<?= esc($values['email'] ?? '') ?>" maxlength="100">
        <?php if (isset($errors['email'])): ?>
            <br><small><?= esc($errors['email']) ?></small>
        <?php endif; ?>
    </p>

    <p>
        <label for="phone">Phone (optional)</label><br>
        <input type="tel" id="phone" name="phone"
               value="<?= esc($values['phone'] ?? '') ?>" maxlength="20">
        <?php if (isset($errors['phone'])): ?>
            <br><small><?= esc($errors['phone']) ?></small>
        <?php endif; ?>
    </p>

    <button type="submit">Save Customer</button>
</form>

<?= $this->endSection() ?>