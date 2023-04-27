// const apikey = 'fbb9472bd2e3a619b71b54604ea7aacc';
// const fr = 'language=fr-FR';


// function getCategorie(){

//   fetch("https://api.themoviedb.org/3/genre/movie/list?api_key="+ apikey +"&"+ fr)
// .then(response => response.json())
// .then(data => {
//   const genres = data.genres;

//       // Récupérer la liste HTML avec l'id "genre"
//       const genreList = document.getElementById("genre");

//       // Ajouter chaque genre à la liste HTML
//       for (let i = 0; i < genres.length; i++) {
//         const genreName = genres[i].name;

//         // créer un élément <li> pour le genre avec une ancre
//         const genreItem = document.createElement("li");
//         const genreLink = document.createElement("a");
//         genreLink.href = [i];
//         genreLink.textContent = genreName;
//         genreItem.appendChild(genreLink);

//         // ajouter l'élément <li> à la liste <ul>
//         genreList.appendChild(genreItem);
//       }
//     })
//     .catch(error => {
//       console.error("Une erreur est survenue lors de la récupération des genres de films:", error);
//     });
// }

function getAutoCompletion(){
  const search = document.getElementById("search-bar");
  const result = document.getElementById("result");

if (search) {
search.addEventListener("keyup", () => {
result.innerHTML = "";
if (search.value != "") {
  fetch(
    `https://api.themoviedb.org/3/search/multi?api_key=3dba613b1899e55a6567cb728761bb94&language=fr-FR&page=1&include_adult=false&query=${search.value}`
  )
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.results.forEach((element) => {
        let e = document.createElement("p");
        let a = document.createElement("a");
        a.href = `./detail.php?id=${element.id}&type=${element.media_type}`;

        if (element.media_type == "movie") {
          a.innerText = element.title + " (film)";
        } else if (element.media_type == "tv") {
          a.innerText = element.name + " (Serie)";
        } else if (element.media_type == "person") {
          a.innerText = element.name + " (Personne)";
        }
        result.appendChild(e);
        e.appendChild(a);
      });
    });
}
});
}

}

getAutoCompletion();