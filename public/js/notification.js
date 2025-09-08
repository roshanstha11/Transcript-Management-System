// Set a timer for how long the toast should be visible
const VISIBLE_DURATION = 3000; // 3 seconds

const toast = document.getElementById('success-toast');

if (toast) {
    // Set a timeout to start the fade-out process
    setTimeout(() => {
        toast.style.opacity = '0'; // Start fading out

        // After the fade-out animation completes, set display to 'none'
        setTimeout(() => {
            toast.style.display = 'none';
        }, 500); // This 500ms should match the CSS transition duration
        
    }, VISIBLE_DURATION);
}