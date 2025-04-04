<?php
/**
 * Main page of the Library Management System
 * This file displays the search form and handles search requests
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
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
                        <input type="radio" id="authorSearch" name="searchType" value="author" checked>
                        <label for="authorSearch">Search by Author</label>
                    </div>
                    <div class="search-option">
                        <input type="radio" id="genreSearch" name="searchType" value="genre">
                        <label for="genreSearch">Search by Genre</label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="searchQuery">Search Term:</label>
                    <input type="text" id="searchQuery" name="searchQuery" class="form-control" placeholder="Enter author name...">
                    <div id="searchError" class="error"></div>
                </div>
                
                <button type="submit" class="btn">Search</button>
            </form>
        </section>
        
        <!-- Introduction Section -->
        <section class="results-container">
            <h2>Welcome to Our Library</h2>
            <p>Our library contains a rich collection of books from various genres and authors. Use the search form above to find books by your favorite author or genre.</p>
            
            <h3 style="margin-top: 20px;">Library Statistics</h3>
            <div style="margin-top: 15px;">
                <?php
                // Include database connection
                require_once 'config/db.php';
                
                // Get counts from database
                try {
                    // Count books
                    $stmt = $conn->query('SELECT COUNT(*) as count FROM Books');
                    $bookCount = $stmt->fetch()['count'];
                    
                    // Count authors
                    $stmt = $conn->query('SELECT COUNT(*) as count FROM Authors');
                    $authorCount = $stmt->fetch()['count'];
                    
                    // Count publishers
                    $stmt = $conn->query('SELECT COUNT(*) as count FROM Publishers');
                    $publisherCount = $stmt->fetch()['count'];
                    
                    // Count categories
                    $stmt = $conn->query('SELECT COUNT(*) as count FROM Categories');
                    $categoryCount = $stmt->fetch()['count'];
                    
                    // Display statistics
                    echo "<p><strong>Total Books:</strong> {$bookCount}</p>";
                    echo "<p><strong>Total Authors:</strong> {$authorCount}</p>";
                    echo "<p><strong>Total Publishers:</strong> {$publisherCount}</p>";
                    echo "<p><strong>Total Categories:</strong> {$categoryCount}</p>";
                    
                } catch(PDOException $e) {
                    echo "<p>Error retrieving library statistics: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </section>
    </div>
    
    <script src="js/validation.js"></script>
</body>
</html>
