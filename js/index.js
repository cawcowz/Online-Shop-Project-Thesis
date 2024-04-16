


//Menu toggle
let menu = document.querySelector('.menu-icon');
let navbar = document.querySelector('.navbar');

menu.addEventListener("click",toggle);

function toggle(){
    navbar.classList.toggle("active");
    menu.classList.toggle("move");
    cart.classList.remove('active');
    login.classList.remove('active');
}

//Cart toggle
let cart = document.querySelector(".cart");

document.querySelector('#cart-icon').onclick =()=>{
    cart.classList.toggle('active');
    menu.classList.remove('move')
    navbar.classList.remove("active");
    login.classList.remove('active');
}

//Login Form
let login = document.querySelector(".login-form");

document.querySelector('#user-icon').onclick =()=>{
    login.classList.toggle('active');
    menu.classList.remove('move')
    navbar.classList.remove("active");
    cart.classList.remove('active');
}

// Change Header Background and shadow on scroll
// let header = document.querySelector('header');

// window.addEventListener("scroll", ()=>{
//     header.classList.toggle('shadow',window.scrollY > 0);
// });

//scroll top

let scrolltop = document.querySelector(".scroll-top");
window.addEventListener('scroll',()=>{
    scrolltop.classList.toggle('active', window.scrollY > 0);
})

//remove toggles when scrolls
window.addEventListener('scroll',()=>{
    menu.classList.remove('move')
    navbar.classList.remove("active");
    login.classList.remove('active');

})

//remove toggle login 

