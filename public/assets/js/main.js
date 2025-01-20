let searchParams = new URLSearchParams(window.location.search);
let allMovies = [];
window.onload = function () {
    const lang = sessionStorage.getItem('language') || 'en';
    document.getElementById('langSelect').value = lang;
    searchParams.set('lang', lang);
    if (window.location.pathname !== '/docs') {
        loadTranslations();
    }

    if (window.location.pathname === '/') {
        getMovies(searchParams.toString());
    }
};
function getMovies(params) {
    $.ajax({
        url: `/movies?${params}`,
        method: "GET",
        dataType: "json",
        success: function (response) {
            const movies = response.data;
            if (movies && movies.length > 0) {
                allMovies = movies;
                displayMovies(allMovies);
            } else {
                console.log("Nenhum filme encontrado.");
            }
        }
        ,
        error: function (response) {
            console.log(response);
        }
    });
}

function filterMovies() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const filteredMovies = allMovies.filter(movie =>
        movie.title.toLowerCase().includes(searchTerm)
    );

    displayMovies(filteredMovies);
}

function displayMovies(movies) {
    $('#cards').empty();
    movies.forEach(movie => {
        $('#cards').append(`<div class="cartao card mb-3 text-dark">
       <a class="text-dark text-decoration-none" href="/movie/${movie.film_id}">     
    <div class="card-body" id="episode${movie.episode_id}">
        <p class="card-title font-weight-bold">${translate('episode')}: ${movie.episode_id}</p>
        <p class="card-text font-weight-bold">${movie.title}</p>
        <span class="text-muted h6 font-weight-light">${translate('release_date')} ${movie.release_date}</span>
    </div>
    </a>
</div>`)
    });
}

function search() {
    let params = new URLSearchParams(window.location.search);
    params.set('lang', $('#langSelect').val());
    params.set('sort', $('#sort').val());

    loadTranslations();
    sessionStorage.setItem('language', params.get('lang'));
    history.pushState(null, null, '?' + params.toString());
    getMovies(params.toString());
    window.location.reload();
}

function loadTranslations() {
    let language = document.getElementById('langSelect').value;
    $.ajax({
        url: `/translations?lang=${language}`,
        method: "GET",
        dataType: "json",
        success: function (response) {
            window.TRANSLATIONS = response;
        }
        ,
        error: function (response) {
            console.log(response);
        }
    });
}

function translate(key) {
    return window.TRANSLATIONS[key] || key;
}

