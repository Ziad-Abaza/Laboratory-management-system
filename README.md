
# Laboratory Management System

A comprehensive system for managing laboratory operations, clients, tests, orders, and payments.

[Database Schema Diagram](https://github.com/Ziad-Abaza/Laboratory-management-system/blob/main/database/database-4.png)

## Features

- **User Management**
  - Role-based access control (Admin, Partner, LabWorker)
  - User status tracking (Active/Inactive)
  - Secure authentication

- **Client Management**
  - Client demographic tracking
  - Medical notes storage
  - Contact information management

- **Test Management**
  - Test categorization
  - Pricing and unit configuration
  - Reference ranges by age and gender

- **Order System**
  - Test order tracking (Pending/Completed/Overdue)
  - Result entry and tracking
  - Client-order association

- **Payment System**
  - Multi-payment tracking
  - Payment status (Pending/Partially Paid/Fully Paid)
  - Financial reporting

- **Home Service**
  - Mobile sample collection management
  - Prescription image upload
  - Service status tracking

- **System Settings**
  - Configurable key-value settings
  - System-wide parameter management

## Technologies Used

- PHP 8.x
- Laravel 10.x
- MySQL 8.x
- REST API
- Composer

## Database Schema

### Key Tables

| Table Name               | Description                                                                 |
|--------------------------|-----------------------------------------------------------------------------|
| `users`                  | System users with role-based access permissions                             |
| `clients`                | Patient/client demographic and contact information                          |
| `lab_tests`              | Laboratory test configurations and pricing                                  |
| `orders`                 | Client test orders with status tracking                                     |
| `order_has_lab_tests`    | Many-to-many relationship between orders and lab tests                      |
| `payments`               | Financial transactions linked to orders                                     |
| `reference_ranges`       | Medical reference ranges based on age and gender                            |
| `home_service`           | Mobile sample collection requests and tracking                              |
| `system_settings`        | Configurable system parameters                                              |

### Relationships
- Users ↔ Orders (One-to-Many)
- Clients ↔ Orders (One-to-Many)
- Orders ↔ LabTests (Many-to-Many through order_has_lab_tests)
- LabTests ↔ ReferenceRanges (One-to-Many)
- Orders ↔ Payments (One-to-Many)

## Installation

1. **Clone Repository**
   ```bash
   git clone https://github.com/Ziad-Abaza/Laboratory-management-system.git
   cd Laboratory-management-system
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   # Update DB credentials in .env file
   ```

4. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed  # If seeders are available
   ```

5. **Start Server**
   ```bash
   php artisan serve
   ```

## API Documentation

### Example User Endpoints

```http
GET /api/users
POST /api/users
GET /api/users/{id}
PUT /api/users/{id}
DELETE /api/users/{id}
PATCH /api/users/{id}/toggle-status
```

**Sample Request:**
```json
{
  "name": "John Doe",
  "userCode": "LAB123",
  "password": "securepassword",
  "role": "LabWorker",
  "status": "Active",
  "Phone": "+201234567890"
}
```

## Security

- Role-based access control
- Password hashing with bcrypt
- CSRF protection
- API authentication with Sanctum
- Input validation
- Error handling middleware

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

MIT License - See [LICENSE](LICENSE) for details.

