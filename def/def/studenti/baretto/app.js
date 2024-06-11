
var  tastoRegistrati;
var n,c, e;
var modificanome,modificacognome,modificaemail,modificapassword;
function registraUtente(n, c, e) {
   
    sessionStorage.setItem('nome', n);
    sessionStorage.setItem('cognome', c);
    sessionStorage.setItem('email', e);
    sessionStorage.setItem('registrato', true);
    sessionStorage.setItem('appenaRegistrato',1);
}
function eliminaUtente() {
   //alert("AO");
   
                 setTimeout(function() {
                // Effettua il reindirizzamento alla pagina logout.php
                window.location.href = 'logout.php';
            }, 3000);
   document.getElementById("hiddenField2").value = sessionStorage.getItem('email');
    sessionStorage.setItem('nome', "");
    sessionStorage.setItem('cognome', "");
    sessionStorage.setItem('email', "");
    sessionStorage.setItem('registrato', false);
    sessionStorage.setItem('appenaRegistrato',0);

     
          
    
}
function modificaUtente(c, n, e) {
   //alert("patonza");
   if(n!=""){
    sessionStorage.setItem('nome', n);
}
if(c!=""){
    sessionStorage.setItem('cognome', c);
}
if(e!=""){
    sessionStorage.setItem('email', e);
}
    sessionStorage.setItem('registrato', true);
    
}


function logout(){
    
  
    if(document.getElementById("R")!=null){
        document.getElementById("R").innerHTML = "Registrati";
        }
        if(document.getElementById("I")!=null){
        document.getElementById("I").innerHTML=' <legend>Inserisci le tue informazioni per completare la registrazione:</legend><ol><li><label for="nome">Nome:</label><input type="text" name="nome" id="nome" autofocus></li><li><label for="cognome">Cognome:</label><input type="text" name="cognome" id="cognome" autofocus></li><li><label for="email">Contatto email:</label><input type="email" name="email" id="email"></li><li><label for="password">password</label><input type="password" name="pwd" id="password"></li><li><input type="submit" value="Registra"><input type="reset" value="Reset"></li></ol><legend >Sei già registrato? <a href="formaccesso.php">Accedi</a>!</legend>';
        }

        if(document.getElementById("P")!=null){
            document.getElementById("P").innerHTML='<li> <label for="nome">Nome:</label><input type="text" name="nome" id="nome" autofocus></li><li> <label for="cognome">Cognome:</label> <input type="text" name="cognome" id="cognome" autofocus> </li><li><label for="email">Contatto email per eventuali cominicazioni relative alla prenotazione e per rimanere sempre aggiornato sui nostri prodotti</label> <input type="email" name="email" id="email"></li><br>';
         }
         sessionStorage.setItem('nome',"");
         sessionStorage.setItem('cognome',"");
         sessionStorage.setItem('email',"");
    sessionStorage.setItem('registrato',0);
    sessionStorage.setItem('appenaRegistrato',null);
      
                // Effettua il reindirizzamento alla pagina logout.php
                window.location.href = 'logout.php';
            
}

function modificaNome(){
  //  alert(modificanome);
    if(modificanome!=null&&modificanome==true){
    document.getElementById("NOME").innerHTML='<label for="nome">Nome:</label><b>'+n+"</b>";
    modificanome=false;
    }
    else if(modificanome==null||modificanome!=true){
    document.getElementById("NOME").innerHTML='<label for="nome">Nome:</label><input type="text" name="nome" id="nome" autofocus>';
modificanome=true;
    }
   
      
        

   
}
function modificaCognome(){
 //   alert(modificanome);
    if(modificacognome!=null&&modificacognome==true){
    document.getElementById("COGNOME").innerHTML='<label for="cognome">Cognome:</label><b>'+c+"</b>";
    modificacognome=false;
    }
    else if(modificanome==null||modificacognome!=true){
    document.getElementById("COGNOME").innerHTML='<label for="cognome">Cognome:</label><input type="text" name="cognome" id="cognome" autofocus>';
modificacognome=true;
    }
   
      
        

   
}
function modificaEmail(){
   // alert(modificanome);
    if(modificaemail!=null&&modificaemail==true){
    document.getElementById("EMAIL").innerHTML='<label for="email">Contatto email:</label><b>'+e+"</b>";
    modificaemail=false;
    }
    else if(modificaemail==null||modificaemail!=true){
    document.getElementById("EMAIL").innerHTML='<label for="email">Contatto email:</label><input type="email" name="email" id="email">';
modificaemail=true;
    }
   
      
        

   
}
function modificaPassword(){
   // alert(modificanome);
    if(modificapassword!=null&&modificapassword==true){
    document.getElementById("PASSWORD").innerHTML='<label for="password">Password:</label><b>'+"****"+"</b>";
    modificapassword=false;
    }
    else if(modificapassword==null||modificapassword!=true){
    document.getElementById("PASSWORD").innerHTML='<label for="password">Password:</label><input type="password" name="pwd" id="password">';
modificapassword=true;
    }
   
      
        

   
}
function mailAttuale(){
  //  alert("AO");
    document.getElementById("hiddenField").value = sessionStorage.getItem('email');
}

document.addEventListener("DOMContentLoaded",function() {
    if(sessionStorage.getItem('appenaRegistrato')!=null){
    // alert("ce sto");
    if(sessionStorage.getItem('appenaRegistrato')==1){
            MuoviScritta();
            if(document.getElementById("scrittaLogin")!=null){
            sessionStorage.setItem('appenaRegistrato',null);}
    }
}      




   // alert("ao");
    n=sessionStorage.getItem('nome');
    c=sessionStorage.getItem('cognome');
    e=sessionStorage.getItem('email');
    if(n!=null&&c!=null&&e!=null&&n!=""&&c!=""&&e!=""){

   // alert("ci sono");
  
   // alert('tastoRegistrati '+sessionStorage.getItem('nome') + " " + sessionStorage.getItem('cognome') + "<br>" + sessionStorage.getItem('email'));
tastoRegistrati=n + " " + c;   
if(document.getElementById("R")!=null){
    document.getElementById("R").innerHTML = tastoRegistrati;
}
   // alert(sessionStorage.getItem('nome') + " " + sessionStorage.getItem('cognome') + "<br>" + sessionStorage.getItem('email')+"<br>")
    if(document.getElementById("I")!=null){
      //  alert("ciaoux");
document.getElementById("I").innerHTML="<h2>"+n + " " + c + "<br>" + e+'<br></h2><button onclick="logout()" >Logout</button><br></form><form method="post"  action="elimina.php"><input type="hidden" name="emailattuale"  id="hiddenField2"><input type="submit"  onclick="eliminaUtente()" value="Elimina Account"> </form><br><a href="formmodifica.php">Modifica Dati!</a><br>';
}

if(document.getElementById("P")!=null){
    document.getElementById("P").innerHTML="<h2>"+n + " " + c + "<br>" + e+'<br></h2><button onclick="logout()" >Logout</button><br><a href="formmodifica.php">Modifica Dati!</a><br>';

}


if(document.getElementById("NOME")!=null){
    if(!(modificanome!=null&&modificanome==true)){

    document.getElementById("NOME").innerHTML='<label for="nome">Nome:</label><b>'+n+"</b>";
}
}
if(document.getElementById("COGNOME")!=null){
    if(!(modificacognome!=null&&modificacognome==true)){

    document.getElementById("COGNOME").innerHTML='<label for="cognome">Cognome:</label><b>'+c+"</b>";
}
}
if(document.getElementById("EMAIL")!=null){
    if(!(modificaemail!=null&&modificaemail==true)){

    document.getElementById("EMAIL").innerHTML='<label for="email">Contatto email:</label><b>'+e+"</b>";
}
}
if(document.getElementById("PASSWORD")!=null){
    if(!(modificapassword!=null&&modificapassword==true)){

    document.getElementById("PASSWORD").innerHTML='<label for="password">Password:</label><b>***</b>';
}
}
    }

else{
    
    if(document.getElementById("R")!=null){
    document.getElementById("R").innerHTML = "Registrati";
    }
    if(document.getElementById("I")!=null){
    document.getElementById("I").innerHTML=' <legend>Inserisci le tue informazioni per completare la registrazione:</legend><ol><li><label for="nome">Nome:</label><input type="text" name="nome" id="nome" autofocus></li><li><label for="cognome">Cognome:</label><input type="text" name="cognome" id="cognome" autofocus></li><li><label for="email">Contatto email:</label><input type="email" name="email" id="email"></li><li><label for="password">password</label><input type="password" name="pwd" id="password"></li><li><input type="submit" value="Registra"><input type="reset" value="Reset"></li></ol><legend >Sei già registrato? <a href="formaccesso.php">Accedi</a>!</legend>';
    }
    if(document.getElementById("P")!=null){
        document.getElementById("P").innerHTML='<li> <label for="nome">Nome:</label><input type="text" name="nome" id="nome" autofocus></li><li> <label for="cognome">Cognome:</label> <input type="text" name="cognome" id="cognome" autofocus> </li><li><label for="email">Contatto email per eventuali cominicazioni relative alla prenotazione e per rimanere sempre aggiornato sui nostri prodotti</label> <input type="email" name="email" id="email"></li><br>';
     }
}
});

function  ResettaLogin(){
    document.getElementById("scrittaLogin").classList.remove("login");
       document.getElementById("scrittaLogin").classList.add("invisibile");
}
function MuoviScritta(){
  // alert("AO IO MUOVO");
   //if( document.getElementById("scrittaLogin")!=null){
   //alert(tipo_panino);
   if( document.getElementById("scrittaLogin")!=null){
       document.getElementById("scrittaLogin").classList.remove("invisibile");
      document.getElementById("scrittaLogin").classList.add("login");
    setTimeout(ResettaLogin,3000);//dopo 500ms richiama ResettaPanino() dando in input tipo_panino
//}
}
       
}