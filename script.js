const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const livresDiv = document.getElementById('livre');
const favoriteLivresDiv = document.getElementById('favoriteLivres');
let favorites = JSON.parse(localStorage.getItem('favorites')) || [];


searchBtn.addEventListener('click', async () => {
    const searchTerm = searchInput.value.trim()

    if (searchTerm) {
        try {
            const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${searchTerm}`);
            const data = await response.json();

            if (data.items) {
                livresDiv.innerHTML = data.items.map(livre => `
                    <div class="livre">
                        <img src="${livre.volumeInfo.imageLinks ? livre.volumeInfo.imageLinks.thumbnail : 'https://via.placeholder.com/150'}" alt="${livre.volumeInfo.title} Poster">
                        <h5>${livre.volumeInfo.title}</h5>
                        <h2>${livre.volumeInfo.authors}</h1>
                        <button class="favoriteBtn" data-imdbid="${livre.id}">Favoris</button></br>
                    </div>
                `).join('');
            } else {
                livresDiv.innerHTML = '<p>pas de livres trouvés</p>';
            }
        } catch (error) {
            console.error('Erreur', error);
        }
    }
});

livresDiv.addEventListener('click', async (event) => {
    if (event.target.classList.contains('favoriteBtn')) {
        const imdbID = event.target.getAttribute('data-imdbid');
        toggleFavorite(imdbID);
    }
});

function toggleFavorite(imdbID) {
    const index = favorites.indexOf(imdbID);
    if (index === -1) {
        // Ajouter le livre aux favoris
        favorites.push(imdbID);
        localStorage.setItem('favorites', JSON.stringify(favorites));
    } else {
        // Retirer le livre des favoris
        favorites.splice(index, 1);
        localStorage.setItem('favorites', JSON.stringify(favorites));
    }
    displayFavorites();
}

async function displayFavorites() {
    
    favoriteLivresDiv.innerHTML = '';

    for (const imdbID of favorites) {
        try {
            const response = await fetch(`https://www.googleapis.com/books/v1/volumes/${imdbID}`);
            const data = await response.json();
            const livreInfo = data.volumeInfo;

            const imgSrc = livreInfo.imageLinks ? livreInfo.imageLinks.thumbnail : 'https://via.placeholder.com/150';

            favoriteLivresDiv.innerHTML += `
                <div class="favoriteLivres">
                    <img src="${imgSrc}" alt="${livreInfo.title} Poster">
                    <h2>${livreInfo.title}</h2>
                    <p>Auteur: ${livreInfo.authors ? livreInfo.authors.join(', ') : 'Inconnu'}</p>
                    <button class="enleverBtn" data-imdbid="${imdbID}">Retirer des favoris</button>
                </div>
                
            `;
        } catch (error) {
            console.error('Erreur', error);
        }
    }

    const enleverBtns = document.querySelectorAll('.enleverBtn');
    enleverBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const imdbID = btn.getAttribute('data-imdbid');
            toggleFavorite(imdbID);
        });
    });

    



}




