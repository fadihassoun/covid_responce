
//double click to enlarge
enl = 0;

function resize(){
    if (enl==0){         
    document.getElementById("img-body").style.width = "110%";
    enl = 1;
}
else if (enl==1) {
    document.getElementById("img-body").style.width = "60%";
    enl = 0;
}
}

// book_pcr functions

var limassol = ["Neapolis","Ypsonas"];
var nicosia = ["Trachonas","Strovolos",];


//change center based on user selection for city
function city_func(val) {
    citye = document.getElementById("city");
    center_array = [];
    if(citye.value == "Limassol"){
        center_array = limassol;

     } else if(citye.value == "Nicosia") {
       center_array = nicosia;
        }
    center = document.getElementById("center") 
    center.innerHTML="" // reset options
 

    def_center = document.createElement("option");
    def_center.innerHTML = 'Select Center';
    def_center.selected ='selected';
    def_center.disabled='disabled';
    center.options.add(def_center);
    // for loop to append options
    for (i=0; i<center_array.length; i++) {
        opt = document.createElement("option");
        opt.innerHTML = center_array[i];
        opt.value = center_array[i];
        center.options.add(opt);
    }


 }

//change available dates based on user selection for center
function center_func(str) {

    //make an xmlhttp connection to send the center selected to the server and get a response in form of an array of dates
    
    if (str == "") {
    document.getElementById("dates").innerHTML = "";
    return;
    }
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("dates").innerHTML = this.responseText;
        }
    };
    xhr.open("GET", "getpcr-dates.php?q="+str, true);
    xhr.send();
}
    
//change available times based on user selection for dates
function day_func(str){
    if (str == "") {
    document.getElementById("time").innerHTML = "";
    return;
    }
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("time").innerHTML = this.responseText;
         }
    };
    center = document.getElementById("center").value;
    xhr.open("GET", "getpcr-dates.php?r="+str+"&q="+center, true);
    xhr.send();

}

//client-side validation
function validate_js() {
    city = document.getElementById("city");
    center = document.getElementById("center");
    day = document.getElementById("day");
    fname = document.getElementById("fname");
    lname = document.getElementById("lname");
    ident = document.getElementById("ident");
    email = document.getElementById("email");
    byear = document.getElementById("byear");
    bmonth = document.getElementById("bmonth");
    bday = document.getElementById("bday");
    tel = document.getElementById("tel");

    elements = [city, center, fname, lname, ident, email, byear, bmonth, bday, tel];
    ufName = ['City', 'Center', 'First Name', 'Last Name', 'ID', 'Email', 'Birth Year', 'Birth Month', 'Birth Day', 'Mobile Number']

    error = "" ;
    for (i=0; i<elements.length; i++) {
        if ((elements[i].value == "N") || (elements[i].value == "") ) {
            error += '\n'+ufName[i]  ;
            focus = elements[i].focus();
        } 
    }
    

    if (error !=="") {
    alert("Please complete the missing information " +error);
        }
    

    }
    


// end of script for book_pcr functions


//client-side validation for report positive result
function validateAntigen_js() {
    fname = document.getElementById("fname");
    lname = document.getElementById("lname");
    email = document.getElementById("email");
    byear = document.getElementById("byear");
    bmonth = document.getElementById("bmonth");
    bday = document.getElementById("bday");
    tel = document.getElementById("tel");
    elements = [fname, lname, email, byear, bmonth, bday, tel];
    ufName = ['First Name', 'Last Name', 'Email', 'Birth Year', 'Birth Month', 'Birth Day', 'Mobile Number']

    error = "" ;
    for (i=0; i<elements.length; i++) {
        if (elements[i].value == "") {
        error += '\n'+ufName[i]  ;
        focus = elements[i].focus();
     } 
    }
    if (error !=="") {
        alert("Please complete the missing information: "+error);
        }
}


