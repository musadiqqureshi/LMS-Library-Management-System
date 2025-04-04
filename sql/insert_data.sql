-- SQL Script to populate the database tables with sample data

-- Insert data into Authors table
INSERT INTO Authors (FirstName, LastName, Country, BirthDate, Bio) VALUES
('Jane', 'Austen', 'United Kingdom', '1775-12-16', 'Jane Austen was an English novelist known primarily for her six major novels, which interpret, critique and comment upon the British landed gentry at the end of the 18th century.'),
('George', 'Orwell', 'United Kingdom', '1903-06-25', 'Eric Arthur Blair, known by his pen name George Orwell, was an English novelist, essayist, journalist and critic.'),
('Agatha', 'Christie', 'United Kingdom', '1890-09-15', 'Dame Agatha Mary Clarissa Christie, Lady Mallowan, was an English writer known for her 66 detective novels and 14 short story collections.'),
('Gabriel', 'García Márquez', 'Colombia', '1927-03-06', 'Gabriel José de la Concordia García Márquez was a Colombian novelist, short-story writer, screenwriter, and journalist, known affectionately as Gabo.'),
('Haruki', 'Murakami', 'Japan', '1949-01-12', 'Haruki Murakami is a Japanese writer. His books and stories have been bestsellers in Japan as well as internationally.'),
('Toni', 'Morrison', 'United States', '1931-02-18', 'Toni Morrison was an American novelist, essayist, book editor, and college professor who won the 1988 Pulitzer Prize and the American Book Award in 1988 for Beloved.'),
('Leo', 'Tolstoy', 'Russia', '1828-09-09', 'Count Lev Nikolayevich Tolstoy, usually referred to in English as Leo Tolstoy, was a Russian writer who is regarded as one of the greatest authors of all time.');

-- Insert data into Publishers table
INSERT INTO Publishers (Name, Country, FoundedYear, ContactEmail) VALUES
('Penguin Random House', 'United States', 1925, 'info@penguinrandomhouse.com'),
('HarperCollins', 'United States', 1817, 'contact@harpercollins.com'),
('Simon & Schuster', 'United States', 1924, 'info@simonandschuster.com'),
('Hachette Book Group', 'United States', 1837, 'contact@hachettebookgroup.com'),
('Macmillan Publishers', 'United States', 1843, 'info@macmillan.com'),
('Oxford University Press', 'United Kingdom', 1586, 'contact@oup.com'),
('Scholastic Corporation', 'United States', 1920, 'info@scholastic.com');

-- Insert data into Books table
INSERT INTO Books (Title, Genre, PublishDate, ISBN, AuthorID, PublisherID) VALUES
('Pride and Prejudice', 'Classic', '1813-01-28', '9780141439518', 1, 1),
('1984', 'Dystopian', '1949-06-08', '9780451524935', 2, 1),
('Murder on the Orient Express', 'Mystery', '1934-01-01', '9780062693662', 3, 2),
('One Hundred Years of Solitude', 'Magical Realism', '1967-05-30', '9780060883287', 4, 2),
('Norwegian Wood', 'Fiction', '1987-09-04', '9780375704024', 5, 3),
('Beloved', 'Historical Fiction', '1987-09-16', '9781400033416', 6, 4),
('War and Peace', 'Historical Fiction', '1869-01-01', '9781400079988', 7, 6),
('Animal Farm', 'Political Satire', '1945-08-17', '9780451526342', 2, 5);

-- Insert data into Categories table
INSERT INTO Categories (Name, Description) VALUES
('Fiction', 'Literary works created from the imagination, not presented as fact, though it may be based on a true story or situation.'),
('Non-Fiction', 'Informational and factual prose concerning real events, people, and information.'),
('Mystery', 'Fiction dealing with the solution of a crime or the unraveling of secrets.'),
('Romance', 'Stories that focus on the relationship and romantic love between two people.'),
('Science Fiction', 'Fiction based on imagined future scientific or technological advances and major social or environmental changes.'),
('Fantasy', 'Fiction featuring magical and supernatural elements that do not exist in the real world.'),
('Historical', 'Fiction or non-fiction set in a previous time period, often with real historical figures as characters.');

-- Insert data into BookCategories junction table
INSERT INTO BookCategories (BookID, CategoryID) VALUES
(1, 1), -- Pride and Prejudice is Fiction
(1, 4), -- Pride and Prejudice is Romance
(2, 1), -- 1984 is Fiction
(2, 5), -- 1984 is Science Fiction
(3, 1), -- Murder on the Orient Express is Fiction
(3, 3), -- Murder on the Orient Express is Mystery
(4, 1), -- One Hundred Years of Solitude is Fiction
(4, 6), -- One Hundred Years of Solitude is Fantasy
(5, 1), -- Norwegian Wood is Fiction
(6, 1), -- Beloved is Fiction
(6, 7), -- Beloved is Historical
(7, 1), -- War and Peace is Fiction
(7, 7), -- War and Peace is Historical
(8, 1), -- Animal Farm is Fiction
(8, 5); -- Animal Farm is Science Fiction
