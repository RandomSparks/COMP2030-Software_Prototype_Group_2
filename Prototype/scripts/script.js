/*
Scripts used in website to be placed in here
*/

function setMenuSelected()
{
    const menu = document.querySelectorAll("#ul_menu li a");
    for (let opt of menu) {
        if (document.location.href.includes(opt.href)) {
            opt.classList.add("selected");
            break;
        }
    }
}

setMenuSelected();
