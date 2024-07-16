## KárVertikál - A Laravel Car Incident History App

This is a Laravel web application to check the incident history of a car by license plate number.

## Database

I used Faker to upload some fake data to the database for testing, but I also added a few records manually.

## Home Page - Guest

- Search - only available after logging in
- Login
- Register

## Home Page - Registered User

- Search
- Search History
- Log out

## Home Page - Admin

- Search
- Search History
- Add Vehicle
- Add Incident
- User Management

The admin user can also edit the vehicles and the incidents, and assign Premium to other users.

## Testing
Open a terminal, run the following commands:
<br><code>npm install</code>
<br><code>php artisan serve</code>
<br>Open the link from the terminal.

- Admin user
Email: jeney.bence@gmail.com
Password: abcd1234

- Basic user
Email: test@example.com
Password: testtest
