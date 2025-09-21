const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('toggle-btn');
const toggleIcon = toggleBtn.querySelector("i");

toggleBtn.addEventListener('click', () => {
sidebar.classList.toggle('collapsed');

    // Change icon depending on state
    if (sidebar.classList.contains('collapsed')) {
        toggleIcon.classList.replace("bi-list", "bi-chevron-right"); // arrow when collapsed
    } else {
        toggleIcon.classList.replace("bi-chevron-right", "bi-list"); // bars when expanded
    }
});