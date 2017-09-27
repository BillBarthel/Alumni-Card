"use strict"

function main(){
	yearDropDown();
}

function yearDropDown(){
	var currentYear = new Date().getFullYear()
    var max = currentYear + 10
    var option = "";
    for (var year = currentYear ; year >= currentYear-100; year--) {
      
        var option = document.createElement("option");
        option.text = year;
        option.value = year;
        
        document.getElementById("yearDropDown").appendChild(option)  
    }
    document.getElementById("yearDropDown").value = currentYear;
}
