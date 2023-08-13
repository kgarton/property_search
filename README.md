# Property Search Web Application

This is a simple property search web application built using CakePHP. The application allows users to search for properties based on specific criteria such as location, price range, number of bedrooms, and number of bathrooms.

## Features

- Property search form with customizable search criteria.
- Display of search results based on user input.
- Clear form button to reset the search criteria.
- Responsive layout for a seamless user experience on various devices.

## Requirements

- PHP >= 7.2
- Composer (for installing CakePHP and dependencies)
- A web server (e.g., Apache, Nginx)
- MySQL or other compatible database

## Installation

1. Clone the repository to your local machine:
https://github.com/kgarton/property_search.git

2. Install the required dependencies using Composer:
composer install

3. Configure the database connection in `config/app.php`

4. Run the database migration to set up the properties table:
bin/cake migrations migrate

5. Start Web Server and access the browser

## Usage

1. Visit the homepage of the application.

2. Fill out the property search form with your desired criteria.

3. Click the "Search" button to see the matching properties.

4. To clear the form, click the "Clear Form" button.

5. Search results will be displayed below the form if there are any results.

## Credits
Project created by Keatyn Garton.