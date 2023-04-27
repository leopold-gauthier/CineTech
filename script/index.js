const apikey = 'fbb9472bd2e3a619b71b54604ea7aacc';
const fr = 'language=fr-FR';



function getNowMovies() {
    const now = document.getElementById('now');
  
    fetch("https://api.themoviedb.org/3/movie/now_playing?api_key="+ apikey +"&"+ fr +"&")
      .then(response => response.json())
      .then(data => {
        // récupérer les résultats de la page actuelle
        const results = data.results;
        console.log(results)
        // itérer sur les résultats et créer les éléments DOM pour chaque film
        for (let i = 0; i < results.length; i++) {
          const movie = results[i];
          const title = movie.title;
          const image = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
          const id = movie.id;

          // créer l'élément Poster
          const movieElem = document.createElement('div');
          // détail des  films
          const titleElem = document.createElement('h3');
          const imageElem = document.createElement('img');
  
          movieElem.classList.add('movie_poster');
          // titleElem.classList.add('title_poster');
          imageElem.classList.add('image_poster');
  
          // ajouter le contenu
          titleElem.textContent = title;
          imageElem.src = image;
          imageElem.dataset.id = id; // stocker l'ID du film dans un attribut personnalisé
        //   imageElem.dataset.type = type;
          // ajouter un gestionnaire d'événements pour le clic sur l'image
          imageElem.addEventListener('click', function() {
            window.location.href = 'detail.php?id=' + id +'&type=movie'; // rediriger l'utilisateur vers la page détaillée avec l'ID du film dans l'URL
          });
  
          // ajouter les éléments au DOM
          // movieElem.appendChild(titleElem);
          movieElem.appendChild(imageElem);
  
          now.appendChild(movieElem);
        }
  
      });
  }
  
  function getTopMovies() {
    const top = document.getElementById('top');
  
    fetch("https://api.themoviedb.org/3/movie/top_rated?api_key="+ apikey +"&"+ fr)
    .then(response => response.json())
    .then(data => {
      // récupérer les résultats de la page actuelle
      const results = data.results;
      
      // itérer sur les résultats et créer les éléments DOM pour chaque film
      for (let i = 0; i < results.length; i++) {
        const movie = results[i];
    
        const title = movie.title;
        const id = movie.id;
        const image = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
    
        
        // créer l'élément Poster
        const movieElem = document.createElement('div');
        // détail des  films
        const titleElem = document.createElement('h3');
        const imageElem = document.createElement('img');
        
        movieElem.classList.add('movie_poster');
        // titleElem.classList.add('title_poster');
        imageElem.classList.add('image_poster');
        
        // ajouter le contenu
        titleElem.textContent = title;
        imageElem.src = image;
        
        // ajouter les éléments au DOM
        // movieElem.appendChild(titleElem);
        movieElem.appendChild(imageElem);
    
        top.appendChild(movieElem);
        imageElem.dataset.id = id; // stocker l'ID du film dans un attribut personnalisé
  
        // ajouter un gestionnaire d'événements pour le clic sur l'image
        imageElem.addEventListener('click', function() {
          window.location.href = 'detail.php?id=' + id +'&type=movie'; // rediriger l'utilisateur vers la page détaillée avec l'ID du film dans l'URL
        });
  
      }
      
  
    });
    }
  
    function getPopularMovies() {
      const popular = document.getElementById('popular');
    
      fetch("https://api.themoviedb.org/3/movie/popular?api_key="+ apikey +"&"+ fr)
      .then(response => response.json())
      .then(data => {
        // récupérer les résultats de la page actuelle
        const results = data.results;
        
        // itérer sur les résultats et créer les éléments DOM pour chaque film
        for (let i = 0; i < results.length; i++) {
          const movie = results[i];
          const title = movie.title;
          const id = movie.id;
          const image = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
      
          
          // créer l'élément Poster
          const movieElem = document.createElement('div');
          // détail des  films
          const titleElem = document.createElement('h3');
          const imageElem = document.createElement('img');
          
          movieElem.classList.add('movie_poster');
          // titleElem.classList.add('title_poster');
          imageElem.classList.add('image_poster');
          
          // ajouter le contenu
          titleElem.textContent = title;
          imageElem.src = image;
          
          // ajouter les éléments au DOM
          // movieElem.appendChild(titleElem);
          movieElem.appendChild(imageElem);
      
          popular.appendChild(movieElem);

          // stocker l'ID du film dans un attribut personnalisé
          imageElem.dataset.id = id; 
          // ajouter un gestionnaire d'événements pour le clic sur l'image
        imageElem.addEventListener('click', function() {
          window.location.href = 'detail.php?id=' + id +'&type=movie'; // rediriger l'utilisateur vers la page détaillée avec l'ID du film dans l'URL
        });
        }
        
    
      });
      }
  

  
  
  
  getNowMovies();
  getTopMovies();
  getPopularMovies();