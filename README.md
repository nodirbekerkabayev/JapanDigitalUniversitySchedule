# Lesson Schedule API

## 📌 Overview
Lesson Schedule API is a Laravel-based RESTful API for managing lesson schedules in Japan Digital University. This API allows users to authenticate, manage subjects, groups, rooms, and retrieve lesson schedules.

## ⚙️ Requirements
- PHP 8.3+
- Laravel 11
- Composer
- MySQL / PostgreSQL / SQLite
- Laravel Passport (for authentication)
- Docker (optional, for containerized setup)

## 🚀 Installation & Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/nodirbekerkabayev/JapanDigitalUniversitySchedule.git
   cd JapanDigitalUniversitySchedule
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Copy the example environment file and configure it:
   ```bash
   cp .env.example .env
   ```
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Configure database settings in `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lesson_schedule
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```
6. Run migrations and seed database:
   ```bash
   php artisan migrate --seed
   ```
7. Start the application:
   ```bash
   php artisan serve
   ```

## 🔐 Authentication
Lesson Schedule API uses Laravel Passport for authentication.
- Register a new user:
  ```bash
  curl -X POST {{base_uri}}/auth/register -F "name=John Doe" -F "email=john@example.com" -F "password=secret" -F "password_confirmation=secret"
  ```
- Login and get token:
  ```bash
  curl -X POST {{base_uri}}/auth/login -F "email=john@example.com" -F "password=secret"
  ```
- Use the token for authenticated requests:
  ```bash
  curl -H "Authorization: Bearer {your_token}" {{base_uri}}/user
  ```

## 📡 API Endpoints
| Method | Endpoint            | Description                   |
|--------|--------------------|-------------------------------|
| POST   | /auth/register     | Register a new user          |
| POST   | /auth/login        | Authenticate user            |
| POST   | /auth/logout       | Logout user                  |
| GET    | /user              | Get authenticated user info  |
| GET    | /subjects          | List all subjects            |
| POST   | /subjects          | Create a new subject         |
| GET    | /subjects/{id}     | Get subject details          |
| PUT    | /subjects/{id}     | Update subject               |
| DELETE | /subjects/{id}     | Delete subject               |
| GET    | /groups            | List all groups              |
| GET    | /rooms             | List all rooms               |

For a full API documentation, refer to the Postman Collection.

## 📄 Postman Collection
View the full API documentation here: [Lesson Schedule API Documentation](https://documenter.getpostman.com/view/40394802/2sAYdfpVyZ)

## 📌 Notes
- Ensure that the `.env` file is properly configured.
- Make sure to run `php artisan passport:install` after migrations.
- API authentication requires Bearer token in headers.

## 📞 Support
For any issues, feel free to create an issue on the GitHub repository.

---
🚀 **Happy Coding!**

