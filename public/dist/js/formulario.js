//console.log('holaaaaa');

const formulario = document.getElementById('contactForm');
const inputs = document.querySelectorAll('#contactForm input');




const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,200}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  telefono: /^\d{7,14}$/, // 7 a 14 numeros.
 // grupo:   /^[1-9]\d{1,3}*$/
  grupo: /^\d{1,2}$/ // 7 a 14 numeros.
}

const campos = {
//	usuario: false,
    nombre: false,
    contenido:false
//password: false,
//	correo: false,
//telefono: false
}

const validarFormulario = (e) => {

    
        //event.preventDefault();
  console.log(e.target.name);
  console.log(e.target.value);
  switch (e.target.name) {
   
    case "materia":
  // console.log(""");
  validarCampo(expresiones.nombre, e.target,'materia');
   
    break;
    

    case "contenido":
      
    validarCampo(expresiones.nombre, e.target,'contenido');
     
      break;

    
    case "plataforma":
        validarCampo(expresiones.nombre, e.target, 'plataforma');
      //  validarPassword2();
    break;
    case "observacion":
     // console.log("estoy aqui");
        validarCampo(expresiones.nombre, e.target, 'observacion');
      //  validarPassword2();
    break;
    case "grupo":
      console.log("funciona");
        validarCampo(expresiones.grupo, e.target, 'grupo');
    break;
    case "correo":
        validarCampo(expresiones.correo, e.target, 'correo');
    break;
    case "telefono":
        validarCampo(expresiones.telefono, e.target, 'telefono');
    break;
   }
}



const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
  	input.addEventListener('blur', validarFormulario);
});

/*
formulario.addEventListener('submit', (e) => {
    e.preventDefault();
 console.log(campos.contenido);
    console.log("eventos de sumbits");
    if(campos.contenido){
        alert("se envio");
    }else{
        alert("no se envio");
        e.preventDefault();
    }
   // console.log(e.target);
});
*/