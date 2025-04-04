# Library Management System

A full-stack web application for managing and searching a library's book collection. This system allows users to search for books by author or genre and displays detailed information about each book, including its author, publisher, and categories.

## Features

- **Search Functionality**: Search books by author name or genre
- **Relational Database**: PostgreSQL database with properly normalized tables
- **Responsive Design**: Mobile-friendly interface that works on all device sizes
- **Client-Side Validation**: JavaScript validation for search form inputs

## Technology Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: PostgreSQL
- **Data Processing**: PDO for database operations

## Database Schema

The application uses the following database tables:

1. **Books**: Contains book details (title, genre, publish date, ISBN)
2. **Authors**: Information about book authors
3. **Publishers**: Information about book publishers
4. **Categories**: Book categories and descriptions
5. **BookCategories**: Junction table for many-to-many relationship between books and categories

## Installation

1. Clone this repository
2. Set up a PostgreSQL database
3. Configure environment variables for database connection:
   - PGHOST
   - PGPORT
   - PGDATABASE
   - PGUSER
   - PGPASSWORD
4. Import the SQL scripts from the `sql` folder to create and populate the database tables
5. Start a PHP server: `php -S localhost:5000`
6. Access the application in your browser at `http://localhost:5000`

## File Structure

```
├── config
│   └── db.php              # Database connection configuration
├── css
│   └── style.css           # Styling for the application
├── js
│   └── validation.js       # Client-side form validation
├── sql
│   ├── create_tables.sql   # SQL for creating database tables
│   └── insert_data.sql     # SQL for inserting sample data
├── index.php               # Main page with search form
└── search.php              # Search results page
```

## Usage

1. On the main page, select whether you want to search by author or genre
2. Enter your search term in the text field
3. Click the "Search" button to see matching results
4. Results will display detailed information about each book, including its author, publisher, and categories

## Screenshots

(Screenshots will be added in the future)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

Created as a mini full-stack project to demonstrate PHP and PostgreSQL integration with a focus on database relationships and search functionality.