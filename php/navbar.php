<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container-fluid" id="navbarContainer">
      <a class="navbar-brand" href="/ca2/php/index.php">
        <i class="fas fa-film"></i> CCT Rental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse show" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
            <li class="nav-item" id="loginButton">
              <a class="btn btn-outline-light ms-2" href="login.php" role="button">Login</a>
            </li>
            <?php else: ?>
            <li class="nav-item" id="profileButton">
              <a class="btn btn-outline-light ms-2" href="profile.php" role="button">My Profile</a>
            </li>
            <li class="nav-item" id="logoutButton">
              <a class="btn btn-outline-light ms-2" href="logout.php" role="button">Logout</a>
            </li>
            <?php endif; ?>
            <!-- Genre DropDown List -->
            <li class="nav-item">
              <div class="btn-group-genre">
                <button type="button" class="btn btn-dark btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Genre
                </button>
                <div class="dropdown-menu dropdown-menu-genre dropdown-menu-end" id="genreDropdown">
                  <!-- Genre options -->
                  <div class="dropdown-menu dropdown-menu-genre dropdown-menu-end" id="genreDropdown">
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Comedy')">Comedy</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Fantasy')">Fantasy</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Crime')">Crime</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Drama')">Drama</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Music')">Music</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Adventure')">Adventure</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('History')">History</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Thriller')">Thriller</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Animation')">Animation</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Family')">Family</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Mystery')">Mystery</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Biography')">Biography</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Action')">Action</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Film-Noir')">Film-Noir</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Romance')">Romance</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Sci-Fi')">Sci-Fi</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('War')">War</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Western')">Western</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Horror')">Horror</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Musical')">Musical</button>
                    <button type="button" class="dropdown-item d-block" onclick="filterMovies('Sport')">Sport</button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</header>
