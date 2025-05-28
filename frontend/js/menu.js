
//DESPLIGUE DEL NAVEGADOR AL DAR CLICK EN EL MENU
$(document).ready(function()
{
    //Correccion de bug: Nav en none al usar menu Hamburguesa y regresar a pantalla grande
    function adjustMenu()   //Pone en display: block el nav si esta en pantalla grande
    {
        if ($(window).width() > 768) 
        {
            $('.nav').css('display', 'block').show();
        } 
        else 
        {
            $('.nav').css('display', 'none');
        }
    }
    
    $(window).resize(function(){  //Si cambia el tamaño de la pantalla corrige el menu
        adjustMenu();
    });

    $('.menu-resp').click(function(){
        if ($(window).width() <= 768) {
            $('.nav').slideToggle();
        }
    });
});

//ROTACIÓN DEL MENU
var menuHam = document.querySelector('.menu-resp');
menuHam.addEventListener('click', () =>
{
    menuHam.classList.toggle('rotated');
});