Features
1. User Authentication

Built using Laravel's built-in authentication system.

Users can:

Register a new account.

Log in and log out.

Reset passwords.

Protected routes for authenticated users only.

2. User Profiles

Each user has a profile containing:

Name, email, profile picture, and bio.

Users can edit their profiles and change profile pictures.

3. Connections (Friends)

Send friend requests to other users.

Accept or reject friend requests.

Display a friends list for each user.

4. Posts

Users can create text posts.

Each post shows:

Author’s name and profile picture.

Post content and creation date.

Number of likes and comments.

Users can edit or delete their own posts.

5. Comments & Likes

Comment on posts.

Like posts.

6. Database Structure

Database stores:

Users, posts, comments, likes, and connections.

Migrations and seeders are used to create and populate tables.

7. Frontend

Built with Blade templates.

User-friendly interface includes:

Profile pages.

News feed for posts.

Post creation and editing.

Interactions with posts (comments & likes).

8. API Authentication

Implemented using Laravel Sanctum.

Users can get an access token via API login or registration.

API endpoints are accessible only to authenticated users.

9. API Endpoints

RESTful API endpoints for:

Users, posts, comments, likes, and connections.

Support CRUD operations for all endpoints.

Uses Resource Controllers for structured handling.

10. Response Formats

API responses are returned in JSON format.

Proper error handling with HTTP status codes:

200 → Success

401 → Unauthorized

404 → Not Found

Consistent and clear response format.

11. API Documentation

API documented using Swagger or Laravel API Documentation Generator.

Each endpoint includes:

Request method (GET, POST, PUT, DELETE)

URL

Request parameters

Response format

Example requests/responses

12. Additional Features

Real-time notifications for:

Friend requests

Post comments

Post likes

##### How to Run the Project

##### Clone the repository
git clone https://github.com/yasersamy-dev/social-connect-laravel.git
cd social-connect-laravel

#####Install dependencies
composer install
npm install
npm run dev
############################
Set up the database

Copy .env.example to .env and update database settings.

Run migrations :

#############
php artisan migrate 
php artisan serve







User search functionality to find and connect with other users.
