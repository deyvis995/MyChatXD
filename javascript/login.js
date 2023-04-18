const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              //alert("paso 1");
              //si todo el back funciono bien.. ntonces :3
              if(data === "success"){
                //alert("gaaaaaaa");
                //location.href = "users.php";
                //Esto te envia a la pagina del usuario logueado
                //***ESTA PARTE DEL CODIGO ANDA DANDO ERROR(responsable del logeo malo xd) */
                location.href = "users.php";
                window.location.reload();
              }else{
                //alert("salio error");//borrar

                location.href = "users.php";//borrar

                errorText.style.display = "block";
                errorText.textContent = data;
              }
          }
      }
    }
    //recarga el formulario
    let formData = new FormData(form);
    xhr.send(formData);
}