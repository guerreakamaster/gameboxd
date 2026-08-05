document.addEventListener("DOMContentLoaded", async () => {

    // 1. Check for SweetAlert messages in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    if (error === 'duplicate') {
        Swal.fire({
            title: 'Game already exists!',
            text: `That title is already in the catalogue for that release year.`,
            icon: 'error',
            background: '#161a22', //matching colors with the page theme
            color: '#fff',
            timer: 2500, // disappears automatically after 2.5 seconds
            showConfirmButton: false,
            toast: true, //makes it small and sleek
            position: 'top' // position = top right
        });
        // Clean the URL so it doesn't trigger again on refresh
        window.history.replaceState(null, null, window.location.pathname + window.location.search.replace(/[?&]error=[^&]*/, ''));
    }else if (error === 'save_failed') {
        Swal.fire({
            title: 'Could not save!',
            text: `Something went wrong saving the game, please try again.`,
            icon: 'error',
            background: '#161a22',
            color: '#fff',
            timer: 2500,
            showConfirmButton: false,
            toast: true,
            position: 'top'
        });
        window.history.replaceState(null, null, window.location.pathname + window.location.search.replace(/[?&]error=[^&]*/, ''));
    }

})
