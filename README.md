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

## Installation and Execution Steps

### Prerequisites
- PHP 7.4 or higher
- PostgreSQL 12 or higher
- Web browser (Chrome, Firefox, Safari, etc.)

### Step 1: Clone the Repository
```bash
git clone https://github.com/musadiqqureshi/LMS-Library-Management-System.git
cd LMS-Library-Management-System
```

### Step 2: Set Up PostgreSQL Database
1. Install PostgreSQL if not already installed
2. Start PostgreSQL service
3. Create a new database: `sudo -u postgres createdb library_db`

### Step 3: Configure Environment Variables
Set environment variables for database connection:
```
PGHOST=localhost
PGPORT=5432
PGDATABASE=library_db
PGUSER=postgres
PGPASSWORD=your_password
```
Alternative: Modify `config/db.php` with your database credentials

### Step 4: Import Database Schema and Data
1. Run the create tables script:
   ```bash
   psql -U postgres -d library_db -f sql/create_tables.sql
   ```
2. Import sample data:
   ```bash
   psql -U postgres -d library_db -f sql/insert_data.sql
   ```
3. Alternatively, use the provided Excel data file in the `database_export` folder

### Step 5: Start PHP Server
```bash
php -S 0.0.0.0:5000
```

### Step 6: Access the Application
Open your web browser and navigate to: `http://localhost:5000`

## File Structure

```
├── config
│   └── db.php              # Database connection configuration
├── css
│   └── style.css           # Styling for the application
├── database_export
│   └── library_management_system.xlsx.csv  # Excel-compatible data export
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

## Excel Data File

The repository includes an Excel-compatible CSV file (`database_export/library_management_system.xlsx.csv`) that contains all the data from the database tables in a structured format. This file can be:

1. Opened with Microsoft Excel, Google Sheets, or any spreadsheet application
2. Used to review the sample data structure
3. Imported into a database using database import tools

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

Created as a mini full-stack project to demonstrate PHP and PostgreSQL integration with a focus on database relationships and search functionality.
