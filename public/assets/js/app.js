// Mobilne menu: najde tlacidlo a navigaciu v hlavicke.
const navToggle = document.querySelector('[data-nav-toggle]');
const nav = document.querySelector('[data-nav]');

if (navToggle && nav) {
    // Po kliknuti prepne triedu open a tym zobrazi/skryje menu.
    navToggle.addEventListener('click', () => {
        nav.classList.toggle('open');
    });
}
