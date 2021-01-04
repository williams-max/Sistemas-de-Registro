//console.log('holaaaaa');

const formulario = document.getElementById('contactForm');
const inputs = document.querySelectorAll('#contactForm input');




const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,200}$/, // Letras y espacios, pueden llevar acentos.
  nombre1: /^[a-zA-ZÀ-ÿ-.,\s]{1,200}$/, // Letras y espacios, pueden llevar acentos.
  direccion: /^[a-zA-ZÀ-ÿ-.\s]+[a-zA-Z0-9-.]{1,200}$/, 
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  telefono: /^\d{7,14}$/, // 7 a 14 numeros.
 // grupo:   /^[1-9]\d{1,3}*$/
  grupo: /^\d{1,2}$/ // 7 a 14 numeros.
}

const campos = {
    materia: false,
    fecha: false,
    contenido:false,
    plataforma: false,
   	observacion: false,
    grupo: false
}

const validarFormulario = (e) => {

    
        //event.preventDefault();
  console.log(e.target.name);

  switch (e.target.name) {
   
    case "materia":
  // console.log(""");
  validarCampo(expresiones.nombre, e.target,'materia');
   
    break;

    case "fecha":
      console.log(e.target.value);
     
     //  if(year==2020){
        validarCampoFecha(expresiones.nombre, e.target,'fecha'); 
     //  }
    
 
    break;
    

    case "contenido":
      
    validarCampo(expresiones.nombre1, e.target,'contenido');
     
      break;

    
    case "plataforma":
        validarCampo(expresiones.nombre, e.target, 'plataforma');
      //  validarPassword2();
    break;
    case "observacion":
     // console.log("estoy aqui");
        validarCampo(expresiones.nombre1, e.target, 'observacion');
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

const validarCampoFecha = (expresion, input, campo) => {
	//if(expresion.test(input.value)){
    var fecha=input.value;
    var parts = fecha.split("-");
     console.log(parts);
     var day = parseInt(parts[2]);
     var month = parseInt(parts[1]);
     var year = parseInt(parts[0]);
     console.log(day);
     console.log(month);
     console.log(year);
     
     //if(year==2020){
    if(year>=2020 && year<=2021 && month>=01 && month<=12 && day>=04 && day<=31 ){
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
function verificar(){
  console.log(campos.contenido);
    console.log("eventos de sumbits");
    if(campos.contenido){
        alert("Se Guardo Exitosamente");
        return true;
    }else{
      console.log(campos.contenido);
        alert("Te falta completar algunos campos");
        return false;
      //  e.preventDefault();
    }
    
}
*/