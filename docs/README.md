# Smart Event Booking Pro

ICT203 Web Application Development - Assessment 3  
Full-Stack Web Application with Responsible AI Integration

## Group Members

| Name | Student ID | Role |
|---|---|---|
| Cheki Dorji | CIHE250699 | Team Lead / Scrum Master and Documentation/QA |
| Sonam Dechen | CIHE231620 | Front-End Lead and UI/UX Testing |
| Subodh Dhungel | CIHE231762 | Back-End Lead and Database/Security |

## Project Overview

Smart Event Booking Pro is a secure, responsive, database-driven web application for a local events organiser. Standard users can register, log in, browse events, search/filter events and submit ticket booking requests. Administrators can manage events, review bookings, manage users and check activity records.

## Technology Stack

- Front end: HTML, CSS, JavaScript, Bootstrap
- Back end: PHP 8+
- Database: MySQL
- Database access: PDO prepared statements
- Authentication: PHP sessions, password_hash and password_verify
- Local server: XAMPP

## Core Features

- User registration and login
- Role-based access: Admin and Standard User
- Event CRUD
- Booking CRUD / booking status management
- Search, filter and pagination for events
- Client-side and server-side validation
- Responsive UI
- Activity logging and timestamps
- Responsible AI Help Assistant using curated FAQ responses

## Local Installation Guide

1. Install XAMPP.
2. Start Apache and MySQL from XAMPP Control Panel.
3. Copy the project folder `smart_event_booking_pro` into `xampp/htdocs/`.
4. Open phpMyAdmin.
5. Create a database named `smart_event_booking_pro`.
6. Import `database.sql` from the project folder.
7. Open this link in the browser:

```text
http://localhost/smart_event_booking_pro/
```

## Demo Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@example.com | Admin123 |
| Standard User | user@example.com | User123 |

Update these credentials if your project uses different seed users.

## AI Use Statement

Generative AI was used as an assistant for planning, wording, code review ideas, test-case drafting and documentation structure. The group reviewed, edited, tested and accepted responsibility for the final work. The application AI feature is a low-risk Smart Help Assistant that uses curated FAQ content and includes human review principles. No sensitive personal data should be sent to public AI tools.

## Security Features

- Password hashing using PHP password_hash
- Password verification using password_verify
- PDO prepared statements
- Server-side validation
- Client-side validation
- Role-based access checks
- Session protection
- Escaped output to reduce XSS risk
- Created/updated timestamps and activity logging

## GitHub Workflow Evidence

The repository should show:

- Meaningful commit history
- Branches such as `frontend`, `backend`, `documentation-testing`
- Pull requests before merging to `main`
- `/docs` folder with documentation, test evidence and screenshots
- `database.sql` included in the root folder

## Folder Structure

```text
smart_event_booking_pro/
│-- assets/
│-- admin/
│-- includes/
│-- docs/
│-- database.sql
│-- index.php
│-- login.php
│-- register.php
│-- events.php
│-- bookings.php
│-- ai_help.php
│-- README.md
```
