const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const livresDiv = document.getElementById('livre');

searchBtn.addEventListener('click', async () => {
    const searchTerm = searchInput.value.trim();

    if (searchTerm) {
        try {
            const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${searchTerm}`);
            const data = await response.json();

            if (data.items) {
                livresDiv.innerHTML = data.items.map(livre => `
                    <div class="livre">
                        <h2>${livre.volumeInfo.title}</h2>
                        <img src="${livre.volumeInfo.imageLinks ? livre.volumeInfo.imageLinks.thumbnail : 'https://via.placeholder.com/150'}" alt="${livre.volumeInfo.title} Poster">
                        <br> 
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



    



   

