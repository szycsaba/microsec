document.addEventListener('DOMContentLoaded', function() {
    const redirectElement = document.querySelector('[data-redirect-url]');
    if (redirectElement) {
        const redirectUrl = redirectElement.dataset.redirectUrl;
        const delay = redirectElement.dataset.redirectDelay || 3000;

        setTimeout(function() {
            window.location.href = redirectUrl;
        }, delay);
    }
});
