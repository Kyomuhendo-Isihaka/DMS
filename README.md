# Drug Management System (DMS)

A PHP and MySQL-based drug management application for managing medicines, staff roles and operational records through a simple web interface.

## Overview

This project was built as a practical management system for drug inventory and related administrative workflows. It includes authentication, user-role management and CRUD operations for medicines and staff accounts.

## Features

- User authentication and session-based access
- Manager account management
- Salesperson account management
- Drug creation and editing
- Manufacturing and expiry date tracking
- Drug status management
- User profile updates
- Password hashing with PHP's `password_hash`
- Avatar upload support
- MySQL-backed data storage

## Tech Stack

- **PHP**
- **MySQL / MySQLi**
- **HTML5**
- **CSS**
- **JavaScript**
- **Bootstrap-style frontend assets**

## Project Structure

```text
DMS/
├── index.php          # Login / entry point
├── home.php           # Main application dashboard
├── add.php            # CRUD and account operations
├── login_core.php     # Authentication logic
├── config.php         # Database configuration
├── code.php           # Supporting application logic
├── assets/            # Frontend assets
└── README.md
```

## Local Setup

1. Clone the repository:

```bash
git clone https://github.com/Kyomuhendo-Isihaka/DMS.git
cd DMS
```

2. Create a MySQL database named `dms`.
3. Configure the database connection in `config.php`.
4. Serve the project from a PHP-compatible web server such as XAMPP, WAMP, Laragon or Apache/PHP.
5. Open the project in your browser.

## Security Note

This repository represents an earlier PHP application architecture. Before using it in production, the database queries should be migrated to prepared statements and all request data should be validated and sanitized consistently.

## What This Project Demonstrates

- Building a complete CRUD-based business application in PHP
- Authentication and role-oriented workflows
- Relational database integration with MySQL
- Password hashing and session management
- Managing operational records through an administrative interface

## Developer

**Isihaka Kyomuhendo**  
Software Developer • Backend Engineer • Mobile App Developer

GitHub: [@Kyomuhendo-Isihaka](https://github.com/Kyomuhendo-Isihaka)
