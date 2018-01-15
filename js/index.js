"use strict"

function main(){
    yearDropDown();
    document.getElementById("defaultOpen").click();
}

//Generate a drop down menu that displays the current year and 100 previous years
function yearDropDown(){
    var currentYear = new Date().getFullYear();
    var option = "";
    for (var year = currentYear ; year >= currentYear-100; year--) {
      
        option = document.createElement("option");
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

function signIn(){
    var email = document.getElementById("signinemail").value;
    $.ajax(
    {
        url: './php/signIn.php',
        type: 'POST',
        data: {email: email},
        success: function(data)
        {
            if(data == "success"){
                window.location.href = './php/alumnicard.php';
            }else{
                document.getElementById("errormessage").innerHTML=data;
            }
        }
    });
}

function register(){
    var firstname = document.getElementById("firstname").value;
    var lastname = document.getElementById("lastname").value;
    var email = document.getElementById("registeremail").value;
    var collegeAttended = document.getElementById("collegeAttended").value;
    var nameatgraduation = document.getElementById("nameatgraduation").value;
    var graduationYear = document.getElementById("yearDropDown").value;
    var mailingAddress = document.getElementById("mailingAddress").value;
    var city = document.getElementById("city").value;
    var state = document.getElementById("state").value;
    var zipCode = document.getElementById("zipCode").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    
    if (firstname.length === 0 || lastname.length === 0 || 
        !email.includes("@") || email.length === 0) {
        document.getElementById("registererrormessage").innerHTML="Please accurately fill out all forms.";
    }
    else{//check fields. ajax
        $.ajax(
        {
            url: './php/register.php',
            type: 'POST',
            data: {email: email, firstName:firstname, lastName:lastname,
                   collegeAttended:collegeAttended, nameatgraduation:nameatgraduation,
                   mailingAddress:mailingAddress, graduationYear:graduationYear,
                   city:city, state:state, zipCode:zipCode, phoneNumber:phoneNumber},
            success: function(data)
            {
              if(data == "success"){
                  window.location.href = './selectbackground.html';
              }else{
                 document.getElementById("registererrormessage").innerHTML=data;
              }
            }
        });
    }
}