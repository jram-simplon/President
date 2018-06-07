function LienOver() {
	var lien = document.getElementsByTagName("a");
	a.style.color = "#999999";
};

function LienOut() {
 	var lien = document.getElementsByTagName("a");
 	a.style.color = "";
};



function toggleForm(){
    // on réccupère l'élément form.
    var newuser = document.getElementById('newuser');
  
    // Condition pour afficher/cacher le formulaire en fonction de son état
    if(newuser.style.display == 'block'){
        newuser.style.display = 'none';
    }else{
        newuser.style.display = 'block';
    }
}

function toggleForm2(){
    // on réccupère l'élément form.
    var userconnection = document.getElementById('userconnection');
  
    // Condition pour afficher/cacher le formulaire en fonction de son état
    if(userconnection.style.display == 'block'){
        userconnection.style.display = 'none';
    }else{
        userconnection.style.display = 'block';
    }
}