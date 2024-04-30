//for tabs toopen and close
function productTabs(evt, tabname) {
    // Declare all variables
    var i, tabcontent, tablinks;
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    if (window.innerWidth > 575) {
        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabname).style.display = "block";
        evt.currentTarget.classList.add("active");
    } else {
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabname).style.display = "block";
        evt.currentTarget.classList.add("active");
        // Open as side pane
        openNav(tabname);
    }
}
//open box from right side
function openNav(idName) {
    var elements = document.getElementById(idName);
    if (elements) {
        elements.style.width = "0";
        // Delay to ensure width change takes effect before transition
        setTimeout(function() {
            elements.style.width = "calc(100% - 20px)";
            elements.style.transition = "width 0.5s ease"; // Add ease transition
        }, 50);
    }
}