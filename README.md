# TFA2 – CodeIgniter POS Accounts

This project displays Customer Accounts and User Accounts stored in a MySQL database. The pages retrieve records through CodeIgniter models.

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL (XAMPP can be used)

## Local setup

1. Run `composer install` in the project folder.
2. Start MySQL in XAMPP.
3. In phpMyAdmin, create a database named `pos_db`.
4. Import `database/pos_db.sql` into `pos_db`.
5. Create a `.env` file beside `spark` and set:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = pos_db
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

   Change the username, password, or port if your MySQL setup differs.

6. Run `php spark serve`.

## Pages

- Customer Accounts: http://localhost:8080/customer-accounts
- User Accounts: http://localhost:8080/user-accounts

Each page displays records from its MySQL table. Editing a record in the database and refreshing the page displays the updated value.