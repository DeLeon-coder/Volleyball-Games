<?php
// Include the database connection
include('connect.inc');

// Query the team_table
$query = "SELECT * FROM quarter_points_table";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php')?>
</head>
<body>
    <?php include('nav.php')?> 
    <div class="container">
        <h1 class="mt-5">Quarter Games</h1>
        <table class="table table-striped mt-4 text-white">
            <thead>
                <tr>
                    <th>Match ID</th>
                    <th>Team ID</th>
                    <th>Set 1 Pts</th>
                    <th>Set 2 Pts</th>
                    <th>Set 3 Pts</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    // Fetch data row by row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['match_time_match_id'] . "</td>";
                        echo "<td>" . $row['team_table_team_id'] . "</td>";
                        echo "<td>" . $row['set_1_points'] . "</td>";
                        echo "<td>" . $row['set_2_points'] . "</td>";
                        echo "<td>" . $row['set_3_points'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No teams found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>     
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>