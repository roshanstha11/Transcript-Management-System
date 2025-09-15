// JS scripts
// Bootstrap JS with Popper
    
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    showMessage('This is a demo login page - no actual authentication occurs');
});

function showMessage(message) {
    // Create and show a Bootstrap toast
    const toastHtml = `
        <div class="toast align-items-center text-white bg-info border-0 position-fixed top-0 end-0 m-3" role="alert" style="z-index: 9999;">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-info-circle me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', toastHtml);
    const toast = new bootstrap.Toast(document.querySelector('.toast:last-child'));
    toast.show();
    
    // Remove toast element after it's hidden
    setTimeout(() => {
        const toastElement = document.querySelector('.toast:last-child');
        if (toastElement) {
            toastElement.remove();
        }
    }, 5000);
}

// Add some interactive effects
document.querySelectorAll('.form-control').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.style.transform = 'scale(1.02)';
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.style.transform = 'scale(1)';
    });
});