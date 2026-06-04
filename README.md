# AsprakNotesPAW

## Project Overview

**AsprakNotesPAW** is a comprehensive, enterprise-grade Web Application built with the Laravel framework designed to manage and streamline the workflow for University Teaching Assistants (Asisten Praktikum - "Asprak"). This platform facilitates the complete lifecycle of teaching assistant operations, from module management to attendance tracking and salary distribution (transfers).

### Main Objectives
- **Centralize Information:** Provide a single source of truth for both Administrators (Coordinators/Lecturers) and Teaching Assistants.
- **Automate Attendance:** Simplify the submission and verification of assistant attendance with digital proof.
- **Financial Transparency:** Maintain transparent, auditable records of teaching assistant salaries and fund transfers based on completed modules.

### Business Purpose
To reduce administrative overhead, eliminate paper-based attendance, minimize human error in payroll calculations, and provide a clear communication channel between course coordinators and teaching assistants.

### Technical Purpose
To demonstrate a robust, scalable, and secure MVC architecture utilizing modern PHP practices, Laravel 12 features, automated testing, and a highly responsive TailwindCSS frontend.

---

## Executive Summary

### Problem Solved
Managing dozens of teaching assistants across multiple lab modules requires meticulous record-keeping. Manually verifying attendance, calculating salaries based on specific module rates, and tracking which payments have been processed is error-prone. AsprakNotesPAW solves this by digitizing the entire flow.

### Target Users
1. **Administrators (Admin/Dosen):** Users with elevated privileges who create modules, review attendance submissions, and process financial transfers.
2. **Teaching Assistants (Asprak):** Standard users who view available modules, submit attendance logs with proof, and track their payment status.

### Main Workflows
1. **Module Creation:** Admin creates a module defining the name, description, syllabus (file), and the specific salary rate per attendance.
2. **Attendance Submission:** Asprak submits an attendance record indicating the module taught, the class, and uploads proof (e.g., photo).
3. **Verification:** Admin reviews the attendance and updates its status (`menunggu`, `diproses`, `disetujui`, `ditolak`).
4. **Salary Transfer:** Admin initiates a transfer. The system calculates the payment based on the module's defined salary, and logs the transaction.

### Overall Architecture
The application follows a monolithic MVC (Model-View-Controller) architecture using Laravel. It relies on standard session-based authentication, eager loading to prevent N+1 query problems, and Blade components for reusable UI elements.

---

## Technology Stack

| Layer | Technology | Version | Purpose |
| --- | --- | --- | --- |
| **Backend** | PHP | `^8.2` | Core server-side language |
| **Backend Framework** | Laravel | `^12.0` | Primary application framework |
| **Frontend** | Blade Templates | - | Server-side HTML rendering |
| **Styling** | Tailwind CSS | `^3.1.0` | Utility-first CSS framework |
| **Interactivity** | Alpine.js | `^3.4.2` | Lightweight JavaScript framework for UI components |
| **Database** | SQLite / MySQL | - | Relational Data Storage |
| **Authentication** | Laravel Auth (Breeze-like) | - | Session-based user authentication |
| **Asset Bundler** | Vite | `^6.2.4` | Fast frontend build tool |
| **Testing** | PHPUnit | `^11.5.3` | Automated Unit and Feature Testing |
| **Queue** | Database | - | Asynchronous task processing |
| **Local Dev** | Laravel Sail / Artisan Serve | - | Containerized/Local development environment |

---

## Architecture Overview

### Architectural Pattern
AsprakNotesPAW implements the classic **Model-View-Controller (MVC)** architectural pattern.
- **Models** interact with the database using Eloquent ORM.
- **Views** display the data using Blade templates.
- **Controllers** act as the middleman, processing incoming HTTP requests, interacting with Models, and returning Views.

### Dependency Injection (DI)
The application leverages Laravel's IoC (Inversion of Control) container. Controllers utilize DI in their methods (e.g., `(Request $request, Modul $modul)`) for automatic route model binding and request instantiation.

### Eager Loading
To ensure high performance and prevent the N+1 query problem, eager loading is utilized heavily. For example, in `TransferController`: `Transfer::with('user')->latest()->get();` fetches transfers and the associated user in a maximum of two queries.

### Authorization & Middleware
Authorization is handled via Laravel Middleware and custom Gates/Policies. A custom role-based access control (RBAC) mechanism is implemented using the `role` column on the `users` table, differentiating between `admin` and `asprak`. The `AuthorizesRequests` trait is used within controllers to enforce these rules.

---

## Complete Folder Structure

```text
AsprakNotesPAW/
├── app/                      # Core application logic
│   ├── Http/                 # HTTP layer (Controllers, Middleware, Requests)
│   ├── Models/               # Eloquent Models representing database tables
│   ├── Providers/            # Service Providers for bootstrapping application services
│   └── View/                 # Blade Component classes
├── bootstrap/                # Application bootstrap scripts and cache
├── config/                   # Configuration files for all Laravel services
├── database/                 # Database migrations, seeders, and SQLite file
│   ├── factories/            # Model factories for testing
│   ├── migrations/           # Version control for database schema
│   └── seeders/              # Initial data population scripts
├── public/                   # Publicly accessible directory (index.php, compiled assets)
├── resources/                # Uncompiled assets, views, and language files
│   └── views/                # Blade templates (UI)
├── routes/                   # Application route definitions (web, api, console)
├── storage/                  # Generated files (logs, uploaded files, cache)
├── tests/                    # Automated tests (Unit and Feature)
├── vendor/                   # Composer dependencies (Backend)
├── node_modules/             # NPM dependencies (Frontend)
├── .env                      # Environment configuration variables
├── composer.json             # PHP dependencies and autoloader config
├── package.json              # JavaScript/CSS dependencies and scripts
└── vite.config.js            # Vite build configuration
```

### Folder Details
- **`app/Http/Controllers/`**: Contains the business logic orchestrating data flow between Models and Views. Key files: `AbsensiController.php`, `ModulController.php`, `TransferController.php`.
- **`resources/views/`**: Contains the visual structure of the app. It is logically grouped by entity (e.g., `modul/`, `absensi/`, `transfer/`). It also includes a `components/` directory for highly reusable UI elements (buttons, inputs, modals).
- **`database/migrations/`**: Defines the exact structure of the database tables across environments ensuring consistent deployment.

---

## Application Modules

### 1. User & Authentication Module
- **Purpose:** Handles user registration, login, profile management, and role differentiation.
- **Business Logic:** Users can register as Teaching Assistants (`asprak`). Admin accounts are usually seeded or manually upgraded.
- **Controllers:** `AuthenticatedSessionController`, `RegisteredUserController`, `ProfileController`, `UserController`.
- **Models:** `User`.
- **Views:** `auth/*`, `profile/*`, `user/index.blade.php`.

### 2. Modul (Module/Course) Module
- **Purpose:** Manages the lab sessions or courses that teaching assistants will handle.
- **Business Logic:** Admins can CRUD modules. Each module has a specific monetary value (`gaji`) per session. Modul files (PDF, images) can be uploaded.
- **Controllers:** `ModulController`.
- **Models:** `Modul`.
- **Views:** `modul/index.blade.php`, `modul/create.blade.php`, `modul/edit.blade.php`, `modul/show.blade.php`.

### 3. Absensi (Attendance) Module
- **Purpose:** Allows Aspraks to report their teaching sessions.
- **Business Logic:** Aspraks select a module, input class details, and upload photographic evidence. Admins review and update the status (`menunggu` -> `disetujui`).
- **Controllers:** `AbsensiController`.
- **Models:** `Absensi`.
- **Views:** `absensi/index.blade.php`, `absensi/create.blade.php`, `absensi/show.blade.php`.

### 4. Transfer (Salary/Payment) Module
- **Purpose:** Handles the financial compensation for teaching assistants.
- **Business Logic:** Admins initiate a transfer based on an approved `Absensi`. The system automatically retrieves the module's `gaji` rate. Alternatively, custom nominal amounts can be transferred.
- **Controllers:** `TransferController`.
- **Models:** `Transfer`.
- **Views:** `transfer/index.blade.php`, `transfer/create.blade.php`.

---

## Database Documentation

The database utilizes Eloquent ORM migrations. Below is the Entity-Relationship breakdown.

### ERD Description

#### Table: `users`
- **Purpose:** Stores all system users (Admins and Assistants).
- **Columns:**
  - `id` (PK, BigInt, Auto-increment)
  - `name` (String)
  - `email` (String, Unique)
  - `role` (String, Default: 'asprak') - Defines authorization level.
  - `password` (String, Hashed)
  - `remember_token` (String)
  - `email_verified_at` (Timestamp)
  - `timestamps` (created_at, updated_at)

#### Table: `modul`
- **Purpose:** Catalogs the teaching modules/courses.
- **Columns:**
  - `id` (PK, BigInt)
  - `nama` (String)
  - `deskripsi` (Text)
  - `gambar` (String, Nullable) - Path to uploaded syllabus/image.
  - `gaji` (Decimal 12,2) - Remuneration per session.
  - `timestamps`

#### Table: `absensis`
- **Purpose:** Records teaching assistant attendance.
- **Columns:**
  - `id` (PK, BigInt)
  - `user_id` (FK -> users.id, Cascade Delete)
  - `modul_id` (FK -> modul.id, Cascade Delete)
  - `kelas` (String) - e.g., "IF-44-01"
  - `bukti_absensi` (String, Nullable) - Path to image proof.
  - `status` (Enum: 'menunggu', 'diproses', 'disetujui', 'ditolak', Default: 'menunggu')
  - `tanggal` (Date)
  - `timestamps`

#### Table: `transfers`
- **Purpose:** Records salary disbursements.
- **Columns:**
  - `id` (PK, BigInt)
  - `user_id` (FK -> users.id, Cascade Delete) - The recipient.
  - `absensi_id` (FK -> absensis.id, Nullable, Set Null on delete) - The related attendance record.
  - `nominal` (Decimal 12,2) - Amount paid.
  - `keterangan` (String, Nullable) - Notes.
  - `tanggal` (Date)
  - `status` (Enum: 'selesai', Default: 'selesai')
  - `timestamps`

---

## Models Documentation

### `User` Model
- **Traits:** `HasFactory`, `Notifiable`.
- **Fillable:** `name`, `email`, `password`, `role`.
- **Hidden:** `password`, `remember_token`.
- **Casts:** `password` (hashed), `email_verified_at` (datetime).
- **Relationships:**
  - `absensis()`: `hasMany` (A user can have many attendance records).

### `Modul` Model
- **Table:** Explicitly defined as `modul`.
- **Fillable:** `nama`, `deskripsi`, `gambar`, `gaji`.
- **Relationships:**
  - `absensis()`: `hasMany` (A module is taught in many sessions).

### `Absensi` Model
- **Fillable:** `user_id`, `modul_id`, `kelas`, `bukti_absensi`, `status`, `tanggal`.
- **Relationships:**
  - `user()`: `belongsTo` (An attendance belongs to an Asprak).
  - `modul()`: `belongsTo` (An attendance refers to a specific module).
  - `transfer()`: `hasOne` (An attendance can result in one transfer payment).

### `Transfer` Model
- **Fillable:** `user_id`, `absensi_id`, `nominal`, `keterangan`, `tanggal`, `status`.
- **Relationships:**
  - `user()`: `belongsTo` (A transfer is made to a user).
  - `absensi()`: `belongsTo` (A transfer is tied to a specific attendance record).

---

## Controllers Documentation

### `AbsensiController`
- **`index()`**: Fetches attendance history. Checks user role; Admin sees all, Asprak sees only their own. Implements eager loading (`with('user', 'modul')`).
- **`create()`**: Renders the submission form for Aspraks.
- **`store(Request $request)`**: Validates inputs, handles `bukti_absensi` file uploads, and saves the record.
- **`show(Absensi $absensi)`**: Admin only. Displays detailed view of an attendance submission.
- **`update(Request $request, Absensi $absensi)`**: Admin only. Updates the workflow status of an attendance record.

### `ModulController`
- **`index()`**: Retrieves all modules.
- **`show(Modul $modul)`**: Displays specific module details.
- **`create()`, `store()`, `edit()`, `update()`, `destroy()`**: Standard CRUD operations restricted to Admins via `$this->authorize('admin')`. Handles file uploads for module materials.

### `TransferController`
- **`index()`**: Retrieves transfer history based on user role.
- **`create()`**: Admin only. Prepares data for a new transfer, specifically fetching `Absensi` records that haven't been fully transferred yet.
- **`store(Request $request)`**: Validates and processes the payment. If an `absensi_id` is selected, it automatically queries the related `Modul` to populate the `nominal` amount securely on the backend, preventing client-side price manipulation.

### `ProfileController` & Auth Controllers
- Standard Laravel Breeze/Starter-kit controllers handling secure password hashing, email verification, session regeneration, and profile updates.

---

## Routes Documentation

All routes are heavily protected by middleware.

| Group/Middleware | Method | URI | Controller | Action |
| --- | --- | --- | --- | --- |
| `guest` | GET/POST | `/login`, `/register`, etc. | `Auth\*Controller` | Standard Auth |
| `auth, verified` | GET | `/dashboard` | Closure | Renders Dashboard |
| `auth, verified` | Resource | `/modul` | `ModulController` | CRUD Modules |
| `auth, verified` | Resource | `/absensi` | `AbsensiController` | CRUD Attendance |
| `auth, verified` | GET/PATCH | `/profile` | `ProfileController` | Manage Profile |
| `auth, verified` | GET | `/transfer` | `TransferController` | List Transfers |
| `can:admin` | GET/POST | `/transfer/create`, `/transfer` | `TransferController` | Admin Create Transfer|
| `can:admin` | Resource | `/users` | `UserController` | Admin User Management |

---

## Middleware & Authorization

### Middleware
- **`auth`**: Ensures the user is logged into the system. Redirects to `/login` otherwise.
- **`verified`**: Ensures the user has verified their email address before accessing the system.
- **`throttle`**: Rate limiting applied to authentication routes to prevent brute-force attacks.

### Authorization (Gates/Policies)
The application relies on the `AuthorizesRequests` trait within controllers.
`$this->authorize('admin');` is used extensively in `ModulController`, `TransferController`, and `AbsensiController` to abruptly halt execution (403 Forbidden) if the authenticated user's `role` is not `admin`.

---

## Frontend Documentation

The frontend is a beautifully crafted, highly responsive Single Page Application-like experience built with Server-Side Rendered Blade Templates.

### Architecture
- **Layouts (`resources/views/layouts/`)**: Contains the master layouts (`app.blade.php` for authenticated users, `guest.blade.php` for public pages).
- **Components (`resources/views/components/`)**: A vast library of reusable UI components based on TailwindCSS. Includes buttons (`primary-button`, `danger-button`), form inputs (`text-input`, `input-error`), modals, and navigation links.
- **Tailwind CSS (`vite.config.js` & `package.json`)**: Configured with Vite for Hot Module Replacement (HMR). Utility classes are used exclusively over custom CSS for highly maintainable styling.
- **Alpine.js**: Used for lightweight JavaScript interactions like dropdown menus and modals without the overhead of Vue or React.

---

## Dependency Analysis

### Backend Dependencies (`composer.json`)
| Package | Version | Purpose |
| --- | --- | --- |
| `laravel/framework` | `^12.0` | Core framework |
| `laravel/tinker` | `^2.10.1` | REPL for interacting with the Laravel app |
| `laravel/breeze` | `^2.3` | Scaffolding for authentication (Dev) |
| `phpunit/phpunit` | `^11.5.3` | Testing framework (Dev) |

### Frontend Dependencies (`package.json`)
| Package | Version | Purpose |
| --- | --- | --- |
| `vite` | `^6.2.4` | Fast frontend bundler and dev server |
| `tailwindcss` | `^3.1.0` | Utility-first CSS framework |
| `alpinejs` | `^3.4.2` | Minimal JavaScript framework for UI components |
| `axios` | `^1.8.2` | Promise-based HTTP client |
| `@tailwindcss/vite` | `^4.0.0` | Tailwind integration for Vite |

---

## Configuration Documentation

Key configuration files found in `config/`:
- **`database.php`**: Defaults to SQLite for immediate development but is fully ready to scale to MySQL/PostgreSQL based on `.env`.
- **`filesystems.php`**: Configured to use the `local` driver. Uploaded files (`bukti_absensi`, `modul`) are stored in `storage/app/public` and linked to `public/storage`.
- **`session.php`**: Sessions are stored in the `database`, allowing for scalable session management across multiple servers.

---

## Security Analysis

1. **Authentication:** Standardized, battle-tested Laravel session authentication. Passwords are encrypted using Bcrypt (12 rounds).
2. **Authorization:** Strict Role-Based Access Control (RBAC) enforced at the Controller level preventing privilege escalation.
3. **CSRF Protection:** All forms include the `@csrf` Blade directive, mitigating Cross-Site Request Forgery.
4. **Mass Assignment:** Eloquent Models strictly use the `$fillable` array to prevent malicious injection of sensitive database columns.
5. **Validation:** Form Requests and controller-level validation (`$request->validate()`) ensure data integrity and prevent XSS (by validating string lengths and formats).
6. **SQL Injection:** Eloquent ORM utilizes PDO parameter binding entirely, rendering SQL injection virtually impossible.
7. **Business Logic Security:** In `TransferController::store`, the salary `nominal` is determined securely on the backend based on the `absensi_id` referencing the `Modul`, rather than trusting user input.

---

## Performance Considerations

1. **Eager Loading:** Implemented (`with('user', 'modul')`) across all major queries to prevent the N+1 problem, drastically reducing database load.
2. **Indexing:** Foreign keys (`user_id`, `modul_id`) inherently act as indexes in relational databases, speeding up table joins.
3. **Asset Optimization:** Vite compiles, minifies, and versions CSS/JS assets, ensuring fast frontend load times and robust browser caching.

**Recommendations:**
- As the application grows, switch `CACHE_STORE` and `SESSION_DRIVER` from `database` to `redis` for memory-speed read/writes.
- Implement database indexing on high-traffic queries like `absensis.status`.

---

## Deployment Guide

### Local Development
```bash
# 1. Clone repository
git clone <repo-url>
cd AsprakNotesPAW

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Database Setup (Creates SQLite DB if not exists, runs migrations & seeders)
php artisan migrate --seed

# 5. Link Storage for File Uploads
php artisan storage:link

# 6. Run Dev Servers
# Run this command which uses concurrently to run PHP Serve, Queue, and Vite
npm run dev
```

### Production Server (Linux VPS / Nginx)
```bash
# Pull code
git pull origin main

# Install production dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run Migrations
php artisan migrate --force

# Set Permissions
sudo chown -R www-data:www-data storage bootstrap/cache
```

---

## Environment Variables

| Variable | Default/Example | Purpose |
| --- | --- | --- |
| `APP_NAME` | Laravel | Name of the application |
| `APP_ENV` | local | Environment (local, production, testing) |
| `APP_KEY` | base64:... | Encryption key for sessions/cookies |
| `APP_DEBUG` | true | Show detailed error pages (Disable in Prod!) |
| `DB_CONNECTION`| mysql/sqlite | Database driver |
| `SESSION_DRIVER`| database | Where to store user sessions |
| `QUEUE_CONNECTION`| database | Where to store background jobs |
| `FILESYSTEM_DISK`| local | Where to store uploaded files |

---

## Testing Documentation

The application is configured to use **PHPUnit**. Tests are located in the `tests/` directory.

- **Feature Tests:** Test HTTP endpoints, authentication flows, and database interactions (e.g., `tests/Feature/Auth/RegistrationTest.php`).
- **Unit Tests:** Test isolated class methods and logic.

**Running Tests:**
```bash
php artisan test
```

---

## Troubleshooting Guide

- **Images/Uploads Not Showing:**
  - *Issue:* 404 Not Found on images.
  - *Solution:* Run `php artisan storage:link` to create a symbolic link from `public/storage` to `storage/app/public`.
- **Database 'Table Not Found' Error:**
  - *Issue:* Querying non-existent tables.
  - *Solution:* Ensure you have run `php artisan migrate`. If using SQLite, ensure `database/database.sqlite` exists.
- **Vite/CSS Not Loading:**
  - *Issue:* Unstyled HTML page.
  - *Solution:* Run `npm run dev` in a separate terminal or run `npm run build` for production.

---

## Future Improvements

1. **Repository Pattern / Service Layer:** Extract heavy business logic from Controllers (e.g., complex Transfer calculations) into dedicated Service classes to keep Controllers slim.
2. **Event-Driven Architecture:** Dispatch Laravel Events (e.g., `AbsensiApproved`) when an admin approves attendance, and use Listeners to automatically trigger notifications or prepare Transfer records.
3. **Automated Notifications:** Integrate email or Telegram notifications to alert Aspraks when their attendance is approved or salary is transferred.

---

## Contributor Guide

- **Coding Standards:** Adhere to PSR-12 coding standards.
- **Git Workflow:** Create a feature branch (`feature/your-feature-name`) from `main`. Commit often with descriptive messages.
- **Pull Requests:** Ensure all PHPUnit tests pass and new features are covered by tests before submitting a PR.

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
