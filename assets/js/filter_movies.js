function filterMovies(genre) {
    // Fetch the film data from the JSON file
    fetch('movies/film.json')
      .then((response) => response.json())
      .then((data) => {
      const movies = data.movies;
    
      const galleryContainer = document.getElementById('gallery-container');
    
      // Clear the existing gallery
      galleryContainer.innerHTML = '';
    
      // Filter movies based on genre
      const filteredMovies = genre === 'All' ? movies : movies.filter((movie) => movie.genres.includes(genre));
    
      // Display filtered movies
      filteredMovies.forEach((movie) => {
        const linkElement = document.createElement('a');
        linkElement.href = `movie_detail.html?id=${movie.id}`;
    
        const imgElement = document.createElement('img');
        imgElement.src = movie.posterUrl;
        imgElement.alt = movie.title;
        imgElement.width = movie.thumbnail_width;
        imgElement.height = movie.thumbnail_height;
        imgElement.classList.add('gallery');
    
        linkElement.appendChild(imgElement);
    
        galleryContainer.appendChild(linkElement);
      });
      })
      .catch((error) => console.error('Error fetching film data:', error));
  }
  
  // Initial fetch for all movies
  filterMovies('All');