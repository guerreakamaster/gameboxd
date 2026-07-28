document.addEventListener("DOMContentLoaded", async () => {
    
    // 1. Check for SweetAlert messages in the URL 
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');
    const error = urlParams.get('error');


    if (msg === 'login_required') {
        Swal.fire({
            title: 'Unauthorised!',
            text: 'You need to login first before reviewing any games',
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
    }else if (error === 'mismatch') {
        Swal.fire({
            title: 'Password mismatch!',
            text: `The passwords entered weren't the same, try again`,
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
    else if (error === 'taken') {
        Swal.fire({
            title: 'Username taken!',
            text: `The entered username is taken, choose a different one.`,
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
    }else if (error === 'invalid') {
        Swal.fire({
            title: 'Invalid data!',
            text: `The entered data does not match any user, please try again`,
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

})