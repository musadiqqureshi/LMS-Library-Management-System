<?php
/**
 * Search results page for the Library Management System
 * This file processes search queries and displays results from the database
 */

// Include database connection
require_once 'config/db.php';

// Initialize variables
$searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';
$searchQuery = isset($_GET['searchQuery']) ? trim($_GET['searchQuery']) : '';
$results = [];
$error = '';

// Process search if query is not empty
if (!empty($searchQuery)) {
    try {
        // Prepare base query - join all necessary tables
        $sql = "SELECT b.BookID, b.Title, b.Genre, b.PublishDate, b.ISBN, 
                CONCAT(a.FirstName, ' ', a.LastName) AS AuthorName, 
                a.Country AS AuthorCountry, 
                p.Name AS PublisherName, 
                p.Country AS PublisherCountry,
                STRING_AGG(c.Name, ', ') AS Categories
                FROM Books b
                LEFT JOIN Authors a ON b.AuthorID = a.AuthorID
                LEFT JOIN Publishers p ON b.PublisherID = p.PublisherID
                LEFT JOIN BookCategories bc ON b.BookID = bc.BookID
                LEFT JOIN Categories c ON bc.CategoryID = c.CategoryID";
        
        // Add WHERE clause based on search type
        if ($searchType === 'author') {
            $sql .= " WHERE CONCAT(a.FirstName, ' ', a.LastName) LIKE :query";
        } elseif ($searchType === 'genre') {
            $sql .= " WHERE b.Genre LIKE :query";
        } else {
            throw new Exception("Invalid search type");
        }
        
        // Add GROUP BY clause to handle the STRING_AGG function
        $sql .= " GROUP BY b.BookID, b.Title, b.Genre, b.PublishDate, b.ISBN, AuthorName, AuthorCountry, PublisherName, PublisherCountry";
        
        // Prepare and execute the query
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':query', '%' . $searchQuery . '%', PDO::PARAM_STR);
        $stmt->execute();
        
        // Fetch results
        $results = $stmt->fetchAll();
        
    } catch(Exception $e) {
        $error = "Error performing search: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Library Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Library Management System</h1>
        </div>
    </header>
    
    <div class="container">
        <!-- Search Form Section -->
        <section class="search-container">
            <h2>Search Books</h2>
            <form id="searchForm" action="search.php" method="GET" class="search-form">
                <div class="search-options">
                    <div class="search-option">
                        <input type="radio" id="authorSearch" name="searchType" value="author" <?php echo $searchType === 'author' ? 'checked' : ''; ?>>
                        <label for="authorSearch">Search by Author</label>
                    </div>
                    <div class="search-option">
                        <input type="radio" id="genreSearch" name="searchType" value="genre" <?php echo $searchType === 'genre' ? 'checked' : ''; ?>>
                        <label for="genreSearch">Search by Genre</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="searchQuery">Search Term:</label>
                    <input type="text" id="searchQuery" name="searchQuery" class="form-control" 
                           value="<?php echo htmlspecialchars($searchQuery); ?>" 
                           placeholder="<?php echo $searchType === 'genre' ? 'Enter genre...' : 'Enter author name...'; ?>">
                    <div id="searchError" class="error"></div>
                </div>
                
                <button type="submit" class="btn">Search</button>
            </form>
        </section>
        
        <!-- Results Section -->
        <section class="results-container">
            <h2>Search Results</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php elseif (empty($searchQuery)): ?>
                <div class="no-results">Please enter a search term to find books.</div>
            <?php elseif (empty($results)): ?>
                <div class="no-results">No books found matching your search criteria.</div>
            <?php else: ?>
                <p>Found <?php echo count($results); ?> book(s) matching your search for 
                   <strong>"<?php echo htmlspecialchars($searchQuery); ?>"</strong> 
                   in <strong><?php echo $searchType === 'author' ? 'Author' : 'Genre'; ?></strong>.</p>
                
                <table class="results-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Categories</th>
                            <th>Publisher</th>
                            <th>ISBN</th>
                            <th>Publish Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $book): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($book['Title']); ?></td>
                                <td><?php echo htmlspecialchars($book['AuthorName']); ?> 
                                    <small>(<?php echo htmlspecialchars($book['AuthorCountry']); ?>)</small>
                                </td>
                                <td><?php echo htmlspecialchars($book['Genre']); ?></td>
                                <td><?php echo htmlspecialchars($book['Categories']); ?></td>
                                <td><?php echo htmlspecialchars($book['PublisherName']); ?> 
                                    <small>(<?php echo htmlspecialchars($book['PublisherCountry']); ?>)</small>
                                </td>
                                <td><?php echo htmlspecialchars($book['ISBN']); ?></td>
                                <td><?php 
                                    $date = new DateTime($book['PublishDate']);
                                    echo $date->format('M d, Y'); 
                                ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <div style="margin-top: 20px">
                <a href="index.php" class="btn" style="background-color: #7f8c8d;">Return to Home</a>
            </div>
        </section>
    </div>
    
    <script src="js/validation.js"></script>
</body>
</html>
