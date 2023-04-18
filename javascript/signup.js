//script para el registro de usuarios
const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

//x siaca xd
form.onsubmit = (e)=>{
    e.preventDefault();
}

//enviar por POST los datos del registro a php/signup.php 
continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;

              //verifica si el back no tubo problemas
              if(data === "success"){
                //te manda a la vista de usuarios. BIENVEnido :3
                location.href="users.php";
              }else{
                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    //recarga el form
    let formData = new FormData(form);
    xhr.send(formData);
}