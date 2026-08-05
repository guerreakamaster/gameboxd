document.addEventListener("DOMContentLoaded", async () => {

    // 1. Check for SweetAlert messages in the URL 
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');
    const error = urlParams.get('error');

    if (msg === 'loggedin') {
        Swal.fire({
            title: 'Welcome Back!',
            text: 'You are successfully logged in.',
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
    } else if (msg === 'review_deleted') {
        Swal.fire({
            title: 'Deleted!',
            text: 'Your review has been removed successfully.',
            icon: 'info',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top' // Matches your index.js positioning
        });
        window.history.replaceState(null, null, window.location.pathname);
    } else if (msg === 'review_updated') {
        Swal.fire({
            title: 'Updated!',
            text: 'Your review has been updated successfully.',
            icon: 'success',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
        window.history.replaceState(null, null, window.location.pathname);
    } else if (error === 'save_failed') {
        Swal.fire({
            title: 'Could not save!',
            text: 'Something went wrong with your review, please try again.',
            icon: 'error',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
        window.history.replaceState(null, null, window.location.pathname);
    } else if (error === 'not_allowed') {
        Swal.fire({
            title: 'Not yours!',
            text: "That review doesn't belong to you, or doesn't exist.",
            icon: 'error',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
        window.history.replaceState(null, null, window.location.pathname);
    }

    // fetch and render the user's games
    const resultsDiv = document.getElementById("results");

    try {
        const res = await fetch("../api/load_profile_reviews.php");
        if (!res.ok) throw new Error("HTTP error " + res.status);

        const reviews = await res.json();

        // If they have no games, show a friendly message
        if (reviews.length === 0) {
            resultsDiv.innerHTML = "<p>You haven't logged any games yet! Go to the home page to find some.</p>";
            return;
        }

        // Loop through the data and build the HTML cards
        resultsDiv.innerHTML = reviews.map(r => {
            const imageUrl = r.image_url ? r.image_url : 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg?utm_source=commons.wikimedia.org&utm_campaign=index&utm_content=original';

            const stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);

            let shortText = r.rating_text ? r.rating_text.substring(0, 50) : "";
            if (r.rating_text && r.rating_text.length > 50) shortText += "...";

            const editButton = `<a href="edit_review.php?type=review&id=${r.review_id}" style="display: inline-block; margin-top: 8px; padding: 5px 10px; background: #444; border: 1px solid #666; color: white; text-decoration: none; border-radius: 4px; font-size: 12px; font-weight: bold;">✏️</a>`;

            return `
            <div class="game-card">
                <img src="${imageUrl}" alt="${r.title} cover" class="game-cover">
                <div class="game-info">
                    <h4>${r.title}</h4>
                    <p style="color: var(--accent); font-size: 14px; margin: 4px 0;">${stars}</p>
                    <p style="font-style: italic; font-size: 11px; margin-bottom: 4px;">"${shortText}"</p>
                    <p style="font-style: italic; font-size: 11px; margin-bottom: 8px;">Time played: ${r.played_hours ? r.played_hours : '...'}h</p>
                    ${editButton}
                </div>
            </div>`;
        }).join("");

    } catch (err) {
        console.error("Error loading profile data:", err);
        resultsDiv.innerHTML = "<p>Error loading your profile.</p>";
    }
});