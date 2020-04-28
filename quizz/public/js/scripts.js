const inputs = document.getElementsByTagName("input");
for(input of inputs ){
     input,addEventListener("keyup",function(e){
         if(e.target.hasAttribute("error")){
            var idDivError= e.target.getAttribute("error");
            document.getElementById(idDivError).innerText=""
         }
     })
}

function load_file(avatar){
    let image=document.getElementById("imguser");
    image.src=window.URL.createObjectURL(avatar.files[0]);
}

document.getElementById("form-signup").addEventListener("submit",function(e){


  var error=false;
  for(input of inputs){
      
    if (input.hasAttribute("error")) {
            var idDivError= input.getAttribute("error");
                if (!input.value) { 
                        document.getElementById(idDivError).innerText="Ce champ est obligatoire"
                        error=true;
                    }
                    
    }
  }
  var idpwd=document.getElementById('pwd').value;
  var idpwd1=document.getElementById('pwd1').value;

  if (idpwd!=idpwd1) {
      document.getElementById('error-4').innerText="Les Mots de passe sont differents";
    alert("Errror Mot de Passe");
      error=true;
  }

  
  if (error) {
    e.preventDefault();
    return false;
  }
   
});