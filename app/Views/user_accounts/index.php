<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>User Accounts</h1>
<p class="description">User records retrieved from the MySQL database.</p>
<p><a href="<?= site_url('users/new') ?>">+ New User</a></p>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" class="empty">No user records found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']) ?></td>
                        <td>
                            <?php if (! empty($user['avatar'])): ?>
                                <img src="<?= base_url('uploads/avatars/' . rawurlencode($user['avatar'])) ?>"
                                     alt="Avatar for <?= esc($user['username']) ?>"
                                     width="48" height="48"
                                     style="object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <span aria-label="No avatar"
                                      style="display: inline-flex; width: 48px; height: 48px; align-items: center; justify-content: center; border-radius: 50%; background: #ddd;">?</span>
                            <?php endif; ?>
                        </td>
                        <td><?= esc($user['username']) ?></td>
                        <td><?= esc($user['full_name']) ?></td>
                        <td><?= esc($user['created_at']) ?></td>
                        <td>
                            <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>