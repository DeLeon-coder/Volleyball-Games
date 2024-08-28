<?php include('connect.inc')?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="Home.php">Volleyball</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class= "navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="Home.php">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="teams.php">Teams</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Update
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="team_update.php">Update Teams</a>
                    <a class="dropdown-item" href="update.php">Update points</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Insert
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="team_insert.php">Team</a>
                    <a class="dropdown-item" href="insert.php">Points</a>
                    <a class="dropdown-item" href="match_insert.php">Match Venue</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Delete
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="team_delete.php">Delete a team</a>
                    <a class="dropdown-item" href="delete.php">Points</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <!-- Search Form -->
        <form class="form-inline ml-auto" action="search.php" method="GET">
            <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search for a team..." aria-label="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>

    </div>
</nav>