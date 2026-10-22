<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'POS System') ?></title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }

        nav {
            padding: 18px 30px;
            background: #111827;
        }

        nav strong {
            margin-right: 30px;
            color: white;
        }

        nav a {
            margin-right: 18px;
            color: #d1d5db;
            text-decoration: none;
        }

        nav a:hover {
            color: white;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1 {
            margin-bottom: 5px;
        }

        .description {
            margin-top: 0;
            color: #6b7280;
        }

        .table-container {
            margin-top: 25px;
            overflow-x: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #2563eb;
            color: white;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f9fafb;
        }

        .empty {
            padding: 30px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav>
        <strong>POS System</strong>
        <a href="<?= site_url('customer-accounts') ?>">Customer Accounts</a>
        <a href="<?= site_url('user-accounts') ?>">User Accounts</a>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>
</body>
</html>