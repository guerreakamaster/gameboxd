let games = [];

//just debug 
console.log("Is the user logged in?", isLoggedIn);
console.log("User role: ", userRole);

async function loadGames() {
    const res = await fetch("../api/load_games.php");
    if (!res.ok) throw new Error("HTTP " + res.status);
    games = await res.json();
};

document.addEventListener("DOMContentLoaded", async () => {

    const input = document.getElementById("searchInput");
    const btn = document.getElementById("searchBtn");
    const resultsDiv = document.getElementById("results");

    //get msg and show pretty alerts
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');
    const error = urlParams.get('error');   
    
    if (msg === 'review_saved') {
        Swal.fire({
            title: 'Game Logged!',
            text: 'Your review has been saved to your profile.',
            icon: 'success',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
        window.history.replaceState(null, null, window.location.pathname);
    }else if (msg === 'loggedout') { 
        Swal.fire({
            title: 'See you around!',
            text: 'You successfully logged out.',
            icon: 'warning',
            background: '#161a22',
            color: '#fff',
            timer: 2500, 
            showConfirmButton: false,
            toast: true, 
            position: 'top' 
        });
    }else if (msg === 'game_added') {
        Swal.fire({
            title: 'Game Added!',
            text: 'The new game has been added to the Gameboxd Database',
            icon: 'success',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
    }else if (msg === 'game_updated') {
        Swal.fire({
            title: 'Game Updated!',
            text: 'The game data has been updated successfully',
            icon: 'success',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
    }else if (msg === 'game_deleted') {
        Swal.fire({
            title: 'Game deleted!',
            text: 'The game has been deleted from the database',
            icon: 'success',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
    }else if (msg === 'registered') {
        Swal.fire({
            title: 'Success!',
            text: 'Successfully registered. Enjoy Gameboxd!',
            icon: 'success',
            background: '#161a22', //matching colors with the page theme
            color: '#fff',
            timer: 2500, // disappears automatically after 2.5 seconds
            showConfirmButton: false,
            toast: true, //makes it small and sleek
            position: 'top' // position = top right
        });
        // Clean the URL so it doesn't trigger again on refresh
        window.history.replaceState(null, null, window.location.pathname);
    }else if (error === 'save_failed') {
        Swal.fire({
            title: 'Could not save!',
            text: 'Something went wrong, please try again.',
            icon: 'error',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
        window.history.replaceState(null, null, window.location.pathname);
    }else if (error === 'unauthorised') {
        Swal.fire({
            title: 'Unauthorised!',
            text: 'You do not have permission to access that, rat!',
            icon: 'error',
            background: '#161a22', //matching colors with the page theme
            color: '#fff',
            timer: 2500, // disappears automatically after 2.5 seconds
            showConfirmButton: false,
            toast: true, //makes it small and sleek
            position: 'top' // position = top right
        });
        // Clean the URL so it doesn't trigger again on refresh
        window.history.replaceState(null, null, window.location.pathname);
    }else if (error === 'game_not_found') {
        Swal.fire({
            title: 'Game not Found!',
            text: 'The game you are trying to review does not exist in Gameboxd.',
            icon: 'error',
            background: '#161a22', //matching colors with the page theme
            color: '#fff',
            timer: 2500, // disappears automatically after 2.5 seconds
            showConfirmButton: false,
            toast: true, //makes it small and sleek
            position: 'top' // position = top right
        });
        // Clean the URL so it doesn't trigger again on refresh
        window.history.replaceState(null, null, window.location.pathname);
    }

    //render games into the list
    function render(list) {
        if (list.length === 0) {
            resultsDiv.innerHTML = "<p>No results.</p>";
            return;
        }

        resultsDiv.innerHTML = list
            .map(g => {
                // Check if we have and image, otherwise use a placeholder
                const imageUrl = g.image_url ? g.image_url : 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=original';
                const reviewButton = isLoggedIn ? `<a href="add_review.php?game_id=${g.id}" style="display: inline-block; margin-top: 8px; padding: 5px 10px; background: var(--accent); color: white; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold;">+</a>` : ``;
                const editButton = userRole === `admin` ? `<a href="edit_game.php?type=game&id=${g.id}" style="display: inline-block; margin-top: 8px; margin-left: 5px; padding: 5px 10px; background: #444; border: 1px solid #666; color: white; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold;">✏️</a>` : ``;

                // Return the HTML for the card
                html = `
                <div class="game-card">
                    <img src="${imageUrl}" alt="${g.title} cover" class="game-cover">
                    <div class="game-info">
                        <h4>${g.title}</h4>
                        ${reviewButton}
                        ${editButton}
                    </div>
                </div>`;


                return html;
            })
            .join("");
    }

    //search the games in the search bar
    function doSearch() {
        const q = input.value.trim().toLowerCase();

        // Si está vacío, puedes decidir: mostrar todo o nada
        if (q === "") {
            render(games);
            return;
        }

        const filtered = games.filter(g =>
            g.title.toLowerCase().includes(q) || String(g.release_year).includes(q)
        );

        render(filtered);
    }

    //load games from php (mini api functionality)
    try {
        await loadGames();
        render(games);
    } catch (err) {
        console.error(err);
        resultsDiv.innerHTML = "<p>Error loading games from PHP.</p>";
    }

/*
3 options to run the search games:
    1. using the button
    2. wait 300ms
    3. pressing enter
*/
    // 1) 
    btn.addEventListener("click", doSearch);

    // 2) 
    let timer = null;
    input.addEventListener("input", () => {
        clearTimeout(timer);
        timer = setTimeout(doSearch, 300); //wait 300ms without typing
    });

    // 3)
    input.addEventListener("keydown", (e) => {
        if (e.key === "Enter") doSearch();
    });

});