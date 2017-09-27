"use strict"

function main(){
	yearDropDown();
	//openCity(event, "signIn");
	document.getElementById("defaultOpen").click();
}

function yearDropDown(){
	var currentYear = new Date().getFullYear();
    var option = "";
    for (var year = currentYear ; year >= currentYear-100; year--) {
      
        var option = document.createElement("option");
        option.text = year;
        option.value = year;
        
        document.getElementById("yearDropDown").appendChild(option)  
    }
    document.getElementById("yearDropDown").value = currentYear;
}

function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}