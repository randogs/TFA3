<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Customer Accounts</h1>
<p class="description">Customer records retrieved from the MySQL database.</p>
<p><a href="<?= site_url('customers/new') ?>">+ New Customer</a></p>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($customers)): ?>
                <tr>
                    <td colspan="6" class="empty">No customer records found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= esc($customer['id']) ?></td>
                        <td><?= esc($customer['full_name']) ?></td>
                        <td><?= esc($customer['email']) ?></td>
                        <td><?= esc($customer['phone'] ?? '') ?></td>
                        <td><?= esc($customer['created_at']) ?></td>
                        <td>
                            <a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>