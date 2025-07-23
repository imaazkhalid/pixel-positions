# Pixel Positions

Pixel Positions is a modern job board web application built with Laravel. It enables employers to post open positions and job seekers to search for their next role, filter by tags, and view featured listings. The project is crafted with a focus on maintainability, modularity, and a clean user experience.

---

## Table of Contents

- [Features](#features)
- [Architecture Overview](#architecture-overview)
- [Technology Stack](#technology-stack)
- [Setup and Installation](#setup-and-installation)
- [S3 & Storage Configuration](#s3--storage-configuration)
- [Usage](#usage)
- [Testing](#testing)
- [Production & Deployment Recommendations](#production--deployment-recommendations)
- [Potential Improvements](#potential-improvements)

---

## Features

- User authentication and registration
- Employer profile and company logo support
- Job creation with title, salary, location, schedule, and external URL
- Featured job listings (highlighted)
- Tagging system (max 3 tags per job)
- Full-text job search
- Browse jobs by tag
- Responsive, modern UI using Blade components and Tailwind CSS
- Laravel-based backend with Eloquent ORM and robust validation
- **Native Amazon S3 Storage Support**

---

## Architecture Overview

Pixel Positions is built using Laravel's MVC structure:
- **Controllers** manage business logic (e.g., `JobController`, `TagController`, `RegisteredUserController`).
- **Models** represent domain entities: `Job`, `User`, `Employer`, `Tag`.
- **Blade Components** deliver a modular, reusable frontend (e.g., Job Card, Tag, Layout).
- **Routes** are defined in `routes/web.php` for clean separation of concerns.
- Uses Laravel's authentication scaffolding for secure user flows.
- Database migrations and seeders ensure consistent schema and development data.

---

## Technology Stack

- **Backend:** PHP 8+, Laravel Framework
- **Frontend:** Blade, Tailwind CSS, Vite
- **Database:** SQLite (can be replaced with PostgreSQL or MySQL)
- **Storage:** Local filesystem or Amazon S3 (configurable)
- **Testing:** Pest
- **Other:** Composer, PNPM, Laravel Eloquent ORM

---

## Setup and Installation

### Prerequisites

- PHP 8.1+
- Composer
- Node.js & NPM/PNPM
- Git

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/imaazkhalid/pixel-positions.git
   cd pixel-positions
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   # or
   pnpm install
   ```

4. **Copy and Configure Environment**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` and set your database credentials and `APP_URL`.

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

   This seeds example jobs, tags, and employers.

7. **Build Frontend Assets**
   ```bash
   npm run build
   # or
   pnpm build
   ```

8. **Run the Development Server**
   ```bash
   php artisan serve
   ```

   Visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## S3 & Storage Configuration

Pixel Positions supports both local storage and Amazon S3 for file uploads (such as company logos). You can switch between these options by configuring your `.env` file.

### Using Local Storage (Recommended for Local Development)

1. In your `.env`, set:
   ```
   FILESYSTEM_DISK=public
   ```
2. Run the following command to create a symbolic link for storage access:
   ```bash
   php artisan storage:link
   ```
3. Uploaded files will be stored in `storage/app/public` and served via `/storage`.

### Using Amazon S3 (For Production or S3-backed Local Development)

1. In your `.env`, set:
   ```
   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=your-access-key-id
   AWS_SECRET_ACCESS_KEY=your-secret-access-key
   AWS_DEFAULT_REGION=your-aws-region
   AWS_BUCKET=your-bucket-name
   ```
2. Make sure your AWS IAM user has permission to put/get objects in your specified bucket.
3. No need to run `php artisan storage:link` for S3 usage.

**Switching storage backends is as simple as changing the `FILESYSTEM_DISK` value and providing the relevant credentials.**

---

## Usage

- **Register** as a new user (employer) and upload your company logo.
- **Create a Job:** Fill in job details, salary, location, schedule, and up to 3 tags.
- **Browse Jobs:** The home page lists featured and recent jobs. Use the search bar and tags to filter.
- **Job Details:** Click on any job to view more information or apply via the external URL.

---

## Testing

Pixel Positions uses Pest and PHPUnit for automated testing.

To run the tests:

```bash
php artisan test
# or
vendor/bin/pest
```

---

## Production & Deployment Recommendations

- **Environment Variables:** Never commit `.env` to version control. Configure production secrets securely.
- **Caching:** Enable config, route, and view caching for performance:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- **Database:** Use managed MySQL/PostgreSQL with regular backups.
- **Queue & Email:** Configure a robust queue driver (e.g., Redis) and mail service (SES, Postmark, Mailgun).
- **Logging:** Use daily or remote logging, monitor logs for errors.
- **Storage:** Use S3-compatible storage for logos in production.
- **HTTPS:** Enforce HTTPS and set `APP_URL` accordingly.
- **Vulnerability Scanning:** Regularly audit dependencies (`composer audit`, `npm audit`).
- **Rate Limiting/Abuse Protection:** Consider Laravel’s built-in rate limiters and security middleware.

---

## Potential Improvements

- **Job Expiration:** Auto-remove or hide expired jobs.
- **Advanced Search:** Filter by location, salary range, schedule type.
- **User Roles:** Separate employer and job seeker roles, with tailored dashboards.
- **Job Application Tracking:** Allow users to apply directly and track applications.
- **Notifications:** Email or Slack notifications for new jobs or applications.
- **Admin Panel:** For moderation and analytics.
- **API Support:** Expose a REST API for jobs, tags, and employers.
- **CI/CD:** Integrate automated tests and deployment pipelines.
- **Accessibility:** Further enhance accessibility and ARIA compliance.
- **Localization:** Support for multiple languages.
- **Performance:** Optimize database queries and frontend assets.
- **Production Hardening:** Implement proper security headers, CSRF/XSS protections, and audit policies.
