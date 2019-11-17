window.onscroll = function () {
    scrollHandler();
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function scrollHandler() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}
