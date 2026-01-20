# Matrimony Site - Complete Laravel Application

A comprehensive matrimony/matchmaking website built with Laravel 10, featuring separate admin and user authentication guards, complete profile management, messaging, interests, and advanced search functionality.

## Features

### User Features
- ✅ User Registration & Login with Email Verification
- ✅ Complete Profile Management (Personal, Family, Education, Occupation details)
- ✅ Partner Preference Settings
- ✅ Advanced Search with Multiple Filters
- ✅ Send/Receive Interest Requests
- ✅ Private Messaging System
- ✅ Photo Gallery Management
- ✅ Profile Visibility Controls
- ✅ Subscription Plans (Free, Silver, Gold, Platinum)
- ✅ Success Stories

### Admin Features
- ✅ Separate Admin Panel with Admin Guard
- ✅ Admin Dashboard with Statistics
- ✅ User Management (View, Edit, Suspend, Delete)
- ✅ Profile Approval/Rejection System
- ✅ Verify Profiles
- ✅ Monitor Interests and Messages
- ✅ Subscription Management
- ✅ Success Stories Moderation

## Technology Stack

- **Backend:** Laravel 10.x
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Font Awesome
- **Authentication:** Laravel Guards (Admin & User)
- **File Storage:** Laravel Storage (Local/S3)

## Database Schema

### Tables Created:
1. **users** - User accounts with basic information
2. **admins** - Admin accounts with role management
3. **profiles** - Detailed user profiles
4. **partner_preferences** - Partner search preferences
5. **interests** - Interest requests between users
6. **messages** - Private messaging system
7. **photos** - User photo gallery
8. **subscriptions** - Subscription plans
9. **success_stories** - Success stories

## Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd spn
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=matrimony
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

This will create all tables and seed an admin account:
- **Admin Email:** admin@matrimony.com
- **Admin Password:** admin123
- **Moderator Email:** moderator@matrimony.com
- **Moderator Password:** moderator123

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Default Credentials

### Admin Panel
- URL: `http://localhost:8000/admin/login`
- Email: admin@matrimony.com
- Password: admin123

### User Panel
- URL: `http://localhost:8000/user/register`
- Register a new account or create test users

## Routes Structure

### Public Routes
- `/` - Homepage
- `/user/register` - User Registration
- `/user/login` - User Login

### User Routes (Requires Authentication)
- `/user/dashboard` - User Dashboard
- `/user/profile` - View/Edit Profile
- `/user/partner-preference/edit` - Partner Preferences
- `/user/search` - Search Profiles
- `/user/interests` - Interest Management
- `/user/messages` - Messaging
- `/user/photos` - Photo Gallery

### Admin Routes (Requires Admin Authentication)
- `/admin/login` - Admin Login
- `/admin/dashboard` - Admin Dashboard
- `/admin/users` - User Management
- `/admin/profiles` - Profile Management

## Key Features Implementation

### 1. Dual Authentication Guards
The application uses separate authentication guards for admin and users:
- **Admin Guard:** `config/auth.php` - Uses `admins` table
- **User Guard:** Default `web` guard - Uses `users` table

### 2. Profile Management
Users can create detailed profiles including:
- Personal Information (Height, Weight, Complexion, etc.)
- Family Details (Father, Mother, Siblings)
- Education & Occupation
- Religious & Cultural Information
- About Me & Hobbies

### 3. Partner Preferences
Users can set detailed partner preferences:
- Age Range
- Height Range
- Location
- Education Level
- Occupation
- Religion & Caste
- Marital Status

### 4. Search System
Advanced search with filters:
- Gender
- Age Range
- Marital Status
- Religion
- Education
- Occupation
- Location (Country, State, City)

### 5. Interest System
- Send interest requests with optional messages
- Accept/Reject interests
- View sent and received interests
- Cancel sent interests

### 6. Messaging System
- Private messaging between users
- Real-time message status (Read/Unread)
- Conversation threads
- Message history

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── UserController.php
│   │   │   └── ProfileController.php
│   │   └── User/
│   │       ├── AuthController.php
│   │       ├── DashboardController.php
│   │       ├── ProfileController.php
│   │       ├── InterestController.php
│   │       ├── MessageController.php
│   │       └── SearchController.php
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Kernel.php
├── Models/
│   ├── Admin.php
│   ├── User.php
│   ├── Profile.php
│   ├── PartnerPreference.php
│   ├── Interest.php
│   ├── Message.php
│   ├── Photo.php
│   ├── Subscription.php
│   └── SuccessStory.php
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php
│   │   └── admin.blade.php
│   ├── admin/
│   │   ├── auth/login.blade.php
│   │   ├── dashboard.blade.php
│   │   ├── users/index.blade.php
│   │   └── profiles/index.blade.php
│   └── user/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard.blade.php
│       └── search/index.blade.php
```

## Security Features

- CSRF Protection on all forms
- Password Hashing using bcrypt
- XSS Protection
- SQL Injection Prevention via Eloquent ORM
- File Upload Validation
- Session Management
- Route Middleware Protection

## Future Enhancements

- Email Verification
- SMS Notifications
- Payment Gateway Integration
- Video Call Integration
- Mobile App (React Native / Flutter)
- Advanced Matchmaking Algorithm
- Horoscope Matching
- Background Verification
- Wedding Planning Services

## Support

For issues and questions, please open an issue in the repository.

## License

This project is open-sourced software licensed under the MIT license.

---

**Note:** Make sure to configure your `.env` file properly before running migrations. Update the database credentials, mail settings, and other environment-specific configurations.
