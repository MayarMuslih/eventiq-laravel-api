# Eventiq – Event Management & Booking Platform

EventIQ is a system for an event management and booking platform.
The platform allows users to discover events, book services, and interact with event providers, while companies can manage their services, venues, and bookings through the system.

The backend is built using Laravel and provides RESTful APIs consumed by a mobile application for users and a web dashboard for administrators and service providers.

## Project Status

This project was developed as a university team project and serves as a backend system for an event management and booking platform. The repository is maintained as a portfolio project demonstrating backend API development using Laravel.

---

## Features

### Authentication & Account Management

* User registration and login
* Password reset functionality
* Account verification using verification codes
* Secure authentication using Laravel Sanctum

### User Profiles

* Create and update user profiles
* Upload profile images
* Manage personal account information

### Events System

* Browse available events
* Admin management of events
* Event image management

### Booking System

Multi-step booking workflow that allows users to:

1. Create a booking
2. Select an event
3. Choose a provider
4. Choose a venue
5. Select services
6. Confirm the booking

Users can also:

* Cancel bookings
* Update service quantities
* Remove services from bookings

### Companies & Providers

Service providers can:

* Create company profiles
* Manage company information and images
* Add services
* Add venues
* Attach events to their company

### Venues & Services

Providers can manage:

* Event venues
* Service offerings
* Service images
* Venue images

### Ratings System

Users can rate companies and view average ratings.

### Notifications

The system supports push notifications using Firebase for user updates and booking notifications.

### Payments

Online payment integration using Stripe Connect allows providers to receive payments for their services.

### Admin Panel Features

Administrators can:

* Manage users and providers
* Review event requests
* Approve or reject event submissions
* Manage events and venues
* Monitor system activity

---

## Tech Stack

Backend Framework:

* Laravel

Programming Language:

* PHP

Database:

* MySQL

Authentication:

* Laravel Sanctum

Payment Integration:

* Stripe Connect

Push Notifications:

* Firebase Cloud Messaging

API Style:

* RESTful APIs

---

## System Architecture

The platform supports multiple types of users:

* Users (mobile app clients)
* Service Providers / Companies (web dashboard)
* Administrators (web dashboard)

The backend API handles all business logic including authentication, booking workflow, payments, and notifications.

---

## API Modules

The backend API includes endpoints for:

* Authentication
* Profile management
* Events
* Companies
* Venues
* Services
* Booking system
* Ratings
* Notifications
* Payment processing

---

## Installation

Clone the repository:

```
git clone https://github.com/MayarMuslih/eventiq-laravel-api.git
```

Install dependencies:

```
composer install
```

Create environment file:

```
cp .env.example .env
```

Generate application key:

```
php artisan key:generate
```

Run migrations:

```
php artisan migrate
```

Start the server:

```
php artisan serve
```

---

## API Testing

The API can be tested using the included Postman collection in the `/postman collections` directory.

---

## Screenshots

pictures of the mobile and dashboard interfaces can be found in the `/front interfaces` directory.

---

## My Role

I collaborated with the team on developing the backend API of the platform using Laravel. My contributions included:

* System architecture
* Database design
* Authentication system
* Booking workflow
* Payment integration with Stripe
* Notifications integration
* REST API development

---

## License

This project was developed as an academic and portfolio project.
