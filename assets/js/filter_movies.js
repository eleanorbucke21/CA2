function filterMovies(genre) {
  console.log(`Filtering movies by genre: ${genre}`); // Log the genre being filtered

  // Fetch the film data from the JSON file
  fetch('CA2/movies/film.json')
    .then((response) => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then((data) => {
      console.log('Successfully fetched film data:', data); // Log fetched data

      const movies = data.movies;
      console.log(`Total movies fetched: ${movies.length}`); // Log total number of movies

      const galleryContainer = document.getElementById('gallery-container');
      console.log('Gallery container:', galleryContainer); // Log the gallery container element

      // Clear the existing gallery
      galleryContainer.innerHTML = '';

      // Filter movies based on genre
      const filteredMovies = genre === 'All' ? movies : movies.filter((movie) => movie.genres.includes(genre));
      console.log(`Total filtered movies: ${filteredMovies.length}`); // Log total number of filtered movies

      // Display filtered movies
      filteredMovies.forEach((movie) => {
        const linkElement = document.createElement('a');
        linkElement.href = `movie_detail.php?id=${movie.id}`;

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
    .catch((error) => {
      console.error('Error fetching film data:', error); // Log any errors
      galleryContainer.innerHTML = '<p>Error loading movie data. Please check the console for more information.</p>';
    });
}

// Initial fetch for all movies
filterMovies('All');
