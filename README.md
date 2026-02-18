
---
---
# SmartReact — E-commerce Backend

This is the **Laravel backend** for the **E-commerce System (SmartReach)**.
It provides **REST APIs** for managing **users, products, carts, and orders**, integrates with a **React frontend**, and follows **modern Laravel development best practices**.

---

---

## Project Overview

### Key Features

* **Admin Panel**

  * Search, add, update, and delete products
  * Manage orders and track payments
* **User Panel**

  * Register and log in
  * Search and view products
  * Add products to cart, update quantities
  * Place orders and view order history
* **API Integration**

  * Provides REST endpoints consumed by React frontend
  * Standardized JSON responses for all operations
* **Environment Configuration**

  * Simple `.env` setup for database and app key

---

---

## Tech Stack & Versions

| Technology            | Version |
| --------------------- | ------- |
| **PHP**               | 8.2.12  |
| **Laravel Framework** | 10.50.2 |
| **Composer**          | 2.9.5   |
| **Apache Server**     | 2.4.58  |
| **MySQL (via XAMPP)** | 8.x     |

> All versions are listed in `composer.json` and `.env`.

---

---

## Project Structure

```
app/
 └── Http/
      └── Controllers/
           ├── ProductController.php
           ├── UserController.php
           ├── CartController.php
           └── OrderController.php
routes/
 └── api.php
database/
 └── migrations/
      ├── create_users_table.php
      ├── create_products_table.php
      ├── create_carts_table.php
      ├── create_orders_table.php
      └── create_order_items_table.php
```

* Controllers handle validation, business logic, and JSON responses.
* Migrations define table schemas automatically for quick setup.

---

---

## Setup Instructions

### 1. Clone the Repository

```bash
git clone <backend-repo-url>
cd backend-project-directory
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Copy `.env.example` to `.env` and set database configuration:

```bash
cp .env.example .env
```

In `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Run Migrations

```bash
php artisan migrate
```

* Creates `users`, `products`, `carts`, `orders`, and `order_items` tables.

### 5. Start the Server

```bash
php artisan serve
```

* Backend runs at `http://127.0.0.1:8000`
* API endpoints are accessible at `http://127.0.0.1:8000/api`

---

---

## Authentication & Roles

| Role      | Description                                          |
| --------- | ---------------------------------------------------- |
| **Admin** | Created manually in database (`user_role = "admin"`) |
| **User**  | Registered users (`user_role = "user"`)              |

### Validations

* Email format and password strength validation
* Duplicate registration prevention

---

---

## API Development Flow

### HTTP Methods Used

| Method | Purpose                     |
| ------ | --------------------------- |
| GET    | Fetch data (list or detail) |
| POST   | Create new records          |
| PUT    | Update existing records     |
| DELETE | Delete records              |

### Example – Fetch Product List

**Route definition (routes/api.php):**

```php
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'getAllProducts']);
```

**Controller method (ProductController.php):**

```php
public function getAllProducts(){
    $products = Product::all();
    return response()->json($products);
}
```

**Frontend fetch example (React):**

```js
fetch(`${environment.serverUrl}/products`)
  .then((res) => res.json())
  .then((data) => console.log(data));
```

---

---

## Application Features

### Admin Features

* Search products
* View product list
* Add/update/delete products (with image support)
* Manage orders

### User Features

* Register/login
* Search/view products
* Add to cart and adjust quantities
* Place orders and generate invoices
* View past orders

### Cart & Order Functionality

* Each user has own cart stored in `carts` table
* Orders are stored in `orders` and `order_items`
* Frontend uses this data for cart display, order history, and invoices

---

---

## Best Practices Followed

* Built-in Laravel validation for all requests
* Pagination for large datasets
* Controllers handle business logic; Eloquent handles database queries
* REST API principles: resource-based endpoints, consistent JSON responses
* Proper storage paths for images/files

---

---

## Testing

* APIs tested with Postman for responses, status codes, and validation errors
* Integrated with React frontend after testing for smooth communication

---

---

## Future Enhancements

* Add advanced filtering and sorting for products
* Implement JWT-based authentication
* Unit testing for APIs
* Dockerize backend for deployment
* Rate limiting and caching for large datasets

---

---

### Author

* **Name:** Muhammad Rehan Khalid
* **Email:** [muhammadrehan02@gmail.com](mailto:muhammadrehan02@gmail.com)
* **GitHub:** [[https://github.com/mRehan-khalid](https://github.com/mRehan-khalid)]

---

Do you want me to create that `.docx` file?
