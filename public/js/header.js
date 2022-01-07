
function toggleNavBar() {
    let navbarLinks = document.getElementById('navbarLinks');

    if (navbarLinks.className == '')
        navbarLinks.className = 'collapse navbar-collapse';
    else
        navbarLinks.className = '';
}
