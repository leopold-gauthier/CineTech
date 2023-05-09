const apikey = 'fbb9472bd2e3a619b71b54604ea7aacc';
const fr = 'language=fr-FR';

const now = document.getElementById('series-container');
const pagination = document.getElementById('pagination');
let page = 1;

// Fonction pour afficher les films en fonction de la page actuelle
function displayMovies(page) {
  // Vide le contenu de la liste des films actuelle
  now.innerHTML = '';
  
  fetch("https://api.themoviedb.org/3/movie/popular?api_key=" + apikey + "&" + fr + "&page=" + page + "&total_results<18")
    .then(response => response.json())
    .then(data => {
      const results = data.results.slice(0,20);
      for (let i = 0; i < results.length; i++) {
        const movie = results[i];
        const title = movie.title;
        const image = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
        const id = movie.id;

        const movieElem = document.createElement('div');
        const titleElem = document.createElement('h3');
        const imageElem = document.createElement('img');

        movieElem.classList.add('media_poster');
        imageElem.classList.add('image_poster');

        titleElem.textContent = title;
        imageElem.src = image;
        imageElem.dataset.id = id;
        
        imageElem.addEventListener('click', function() {
          window.location.href = 'detail.php?id=' + id + '&type=movie';
        });

        movieElem.appendChild(titleElem);
        movieElem.appendChild(imageElem);

        now.appendChild(movieElem);
      }

      // Calcul du nombre total de pages en fonction du nombre total de films et du nombre de films par page
      const totalPages = Math.ceil(data.total_results / data.results.length);
      
      // Supprime les boutons de pagination existants
      pagination.innerHTML = '';

      // Ajoute le bouton "Précédent" s'il y a une page précédente
      if (page > 1) {
        const prevBtn = document.createElement('button');
        prevBtn.textContent = 'Précédent';
        prevBtn.addEventListener('click', function() {
          page--;
          displayMovies(page);
        });
        pagination.appendChild(prevBtn);
      }

      // Ajoute le bouton "Suivant" s'il y a une page suivante
      if (page < totalPages) {
        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Suivant';
        nextBtn.addEventListener('click', function() {
          page++;
          displayMovies(page);
        });
        pagination.appendChild(nextBtn);
      }
    });
}

displayMovies(page);