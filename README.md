# Expense Tracker App

A robust web application built with Laravel for managing personal and business finances.

## Features

- 📊 Expense Tracking: Categorize and monitor all your expenses in one place
- 💰 Income Management: Record and track multiple income sources
- 📈 Financial Analytics: Get detailed insights into spending habits
- 🔒 Secure Authentication: Protected user accounts and data

## Prerequisites

- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL or SQLite

## Installation

1. Clone the repository:
```bash
git clone https://github.com/byiringiroaimefils/Expense-Tracker-App
cd expense-tracker-app
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install and compile frontend dependencies:
```bash
npm install
npm run build
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Expense_Tracker_App
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations:
```bash
php artisan migrate
```

7. Start the development server:
```bash
php artisan serve
```

8. Create Admin User:
```bash
php artisan tinker
```
Then run these commands in tinker:
```php
$admin = new App\Models\register();
$admin->username = 'Admin User';
$admin->email = 'admin@example.com';
$admin->password = Hash::make('admin123');
$admin->role = 'admin';
$admin->save();
```

## Admin Access

The application includes an administrator role with enhanced privileges:

- **Default Admin Credentials**:
  - Email: admin@example.com
  - Password: admin123

Admin users have additional capabilities:
- Manage user accounts
- View all users' transactions
- Create/modify expense categories
- Generate system-wide reports
- Modify user permissions

> **Important**: Please change the admin password immediately after first login for security purposes.

## Usage

1. Register a new account at `/register`
2. Log in to your account at `/login`
3. Start tracking your expenses and income
4. View financial reports and analytics

## Project Structure

- `app/` - Contains the core code of the application
- `resources/views/` - Contains blade template views
- `routes/` - Contains all route definitions
- `database/migrations/` - Contains database migrations
- `public/` - Contains publicly accessible files

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

Copyright © 2025 ExpenseTracker. All rights reserved.

## Contact

For support or queries, please reach out through the contact form on our website.