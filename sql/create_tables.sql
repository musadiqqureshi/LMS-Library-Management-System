-- SQL Script to create the tables for Library Management System for PostgreSQL

-- Create Authors table
CREATE TABLE IF NOT EXISTS Authors (
    AuthorID SERIAL PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Country VARCHAR(50),
    BirthDate DATE,
    Bio TEXT
);

-- Create Publishers table
CREATE TABLE IF NOT EXISTS Publishers (
    PublisherID SERIAL PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Country VARCHAR(50),
    FoundedYear INT,
    ContactEmail VARCHAR(100)
);

-- Create Books table
CREATE TABLE IF NOT EXISTS Books (
    BookID SERIAL PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    Genre VARCHAR(50),
    PublishDate DATE,
    ISBN VARCHAR(20) UNIQUE,
    AuthorID INT,
    PublisherID INT,
    FOREIGN KEY (AuthorID) REFERENCES Authors(AuthorID) ON DELETE SET NULL,
    FOREIGN KEY (PublisherID) REFERENCES Publishers(PublisherID) ON DELETE SET NULL
);

-- Create Categories table
CREATE TABLE IF NOT EXISTS Categories (
    CategoryID SERIAL PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Description TEXT
);

-- Create BookCategories junction table
CREATE TABLE IF NOT EXISTS BookCategories (
    BookID INT,
    CategoryID INT,
    PRIMARY KEY (BookID, CategoryID),
    FOREIGN KEY (BookID) REFERENCES Books(BookID) ON DELETE CASCADE,
    FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID) ON DELETE CASCADE
);

-- Create indexes for better search performance
CREATE INDEX idx_book_title ON Books(Title);
CREATE INDEX idx_book_genre ON Books(Genre);
CREATE INDEX idx_author_name ON Authors(LastName, FirstName);
