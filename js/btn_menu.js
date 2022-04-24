'use strict'

let menu_smart = document.querySelector('.navegacion__links');
let btn_menu = document.querySelector('.contenedor-menu');


window.setInterval( ()=> {
    if(document.documentElement.scrollWidth >= 1024) {
        menu_smart.classList.remove('active');
        enableScroll();
    }
}, 500 )

btn_menu.addEventListener('click', () => {
    
    if(menu_smart.classList.contains('active')){
        menu_smart.classList.remove('active');
        enableScroll();
    }else {
        menu_smart.classList.add('active');
        disableScroll();
    }
    
});


function disableScroll(){  
    let x = window.scrollX;
    let y = window.scrollY;
    window.onscroll = function(){ window.scrollTo(x, y) };
}

function enableScroll(){  
    window.onscroll = null;
}