<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?>    
        <?php
        // Check if form was submitted
        if(isset($_GET['query'])) {
            $search_query = trim($_GET['query']); // Get and sanitize the user input
            
            require('connect.inc'); // Connect to the database
            
            // Perform the search
            $search_query = mysqli_real_escape_string($conn, $search_query);
            $q = "SELECT * FROM team_table WHERE team_name LIKE '%$search_query%'";
            $r = mysqli_query($conn, $q);
            
            if($r && mysqli_num_rows($r) > 0) {
                // Display search results
                echo "<h2>Search Results:</h2>";
                echo "<ul class='list-group'>";
                while($row = mysqli_fetch_assoc($r)) {
                    echo "<li class='list-group-item'>Team Name: " . htmlspecialchars($row['team_name']) . " | Team ID: " . htmlspecialchars($row['team_id']) . " | Wins: " . htmlspecialchars($row['wins']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p class='text-danger'>No teams found matching your search query.</p>";
            }
            
            mysqli_close($conn); // Close the database connection
        }
        ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
</body>
</html>
