/*<?php


$consulta= "SELECT * FROM Administradores WHERE email ='$Email'";
$result = mysqli_query( $conn,$consulta);//
$filas = mysqli_num_rows($result);


SELECT * FROM imagenes WHERE pilar='0'";
$result = mysqli_query( $conn,$consulta);

id 1= His1-kk

end php
?>*/

/**/

//const request = new Request('https://www.mozilla.org/datosCuento.php?id_pilar=5");
//Info de cada pilar


var pilar1 = {
	bgs:["IMGS/His1.jpg",'IMGS/His2.jpg','IMGS/p3.jpg','IMGS/His2.jpg','IMGS/p3.jpg'],//orden n pilar 0, fondo de cadapágina
	texto:[
	"info 1 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua",
	"info 2",
	"info 3",
	"info 4",
	"info 5"],//narrativa de cada página
	runa:'IMGS/Res.png',//imagen amarilla :v
	indagacion: ['IMGS/I1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],//imágenes de monitor
	indagaTxt:["Pasado","Presente","Futuro"],//texto del monitor

	pilarStyle:	"background: url('IMGS/Tor1.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"
}
var pilar2 = {
	bgs:['IMGS/p1.jpg','IMGS/p4.jpg','IMGS/p5.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/p1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	indagaTxt:["Pasado","Presente","Futuro"],
	pilarStyle:	"background: url('IMGS/His1.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 6","info 7","info 8"]
}
var pilar3 = {
	bgs:['IMGS/p5.jpg','IMGS/p2.jpg','IMGS/p3.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/p2.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	indagaTxt:["Pasado","Presente","Futuro"],
	pilarStyle:	"background: url('IMGS/His2.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 9","info 10","info 11"]
}
//vidas
var finales = {
	finalTxt:["Final 1: Ganaste de la mejor forma posible.","Final 2: Ganaste pero pudo ser mejor.","Todos tus intentos fueron fallidos, el mundo fue destruido."],
	finalBg:["IMGS/p1.jpg","IMGS/p4.jpg","IMGS/p5.jpg"],
	reset:["Has descubierto el mejor final posible","Has descubierto el final secundario de la historia", "Has fracasado"],
	resetBg:["IMGS/p1.jpg", "IMGS/p4.jpg", "IMGS/Fail.png"],
}
var vida={
	stat:['IMGS/Vidas/full.png','IMGS/Vidas/bar2.png','IMGS/Vidas/bar1.png','IMGS/Vidas/dead.png']
}
//torre de cada pilar
var torre = {
	torreBg:"background: url('IMGS/Fres.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"
}
//Array de pilares
var pilares = [pilar1, pilar2, pilar3];
//Contraseñas :O
var _0xfd70=["\x61\x62\x63\x64","\x65\x66\x67\x68","\x69\x6A\x6B\x6C"];
eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('5 4=[3[0],3[1],3[2]]',6,6,'|||_0xfd70|validos|var'.split('|'),0,{}))
//___

//var portada = {"texto":"texto portada"}

/*
var game_data = {
	"historia": {
		"1": {
			"1": {
				"texto": "ESTA ES LA PAGINA #1",
				"imagen_fondo": "IMG_NEW/historia/S1-H-p1.png",
				"imagen_personaje": null
			}
		}
	}
}*/
//vue
var app = new Vue({
  el: '#app',
  data: {
	secret:'',
	game_data: '',
	pilar: pilar1,
	pilSect:1,
	pg:1,
	//portada:portada,
	total:pilares.length*3,
	vida,
	torre,
	alOrDe:"REINTENTAR",
	resetBtn:"",
	final:finales,
	estado:0,
  	idx: 1,
	section:'intro1',
	counterf:0,
  },
  computed: {
    // a computed getter
    backs: function () {
      // `this` points to the vm instance
      	if(this.section=='final'){
			return 'background-image:url('+this.final.finalBg[this.counterf]+')';
		} else if(this.section=='reset'){
			return 'background-image:url('+this.final.resetBg[this.counterf]+')';
		} else {
      		return 'background-image:url('+this.game_data.historia[this.pilSect][this.pg].imagen_fondo+')';
      	}
    },
    pilarStyle: function() {
    	var game_data = this.game_data;
    	var url = this.game_data.pilares[this.pilSect].torre;
		return "background: url('" + url + "') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"
    }

  },
  methods: {
    activar: function (numPag, seccion, s) {
      this.section = seccion;
	  app.pg+=s;
	  this.pilar = pilares[app.pilSect];
    },
    activarPilar: function () {
      this.section = 'acertijo';
	}
  }

});


const request = new Request('set.php');

fetch(request)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {

    app.game_data = response;

  }).catch(error => {
    console.error(error);
  });

//
var num = app.idx;

function resolver(){
	if(app.secret==validos[app.pilSect]){
		app.pilSect++;
		app.estado=0;
		if(app.pilSect==3){
			if(app.total>=Math.round(3*pilares.length*0.6)){
				app.counterf=0;
			}
			else{
				app.counterf=1;
			}
			app.section='final';
			app.resetBtn="JUGAR DE NUEVO Y DESCUBRIR MÁS";
		}else{
			app.section='reintentar';
			app.alOrDe="¡ENHORABUENA!";
		}
	}
	else if(this.secret!=validos[app.pilSect]){
		app.estado++;
		if(app.estado==3){
			app.counterf=2;
			app.section='final';

			app.resetBtn="INTENTAR DESDE EL PRINCIPIO";
		}else{
			app.section='reintentar';
			app.alOrDe="REINTENTAR";
			app.total--;
		}
	}
	app.secret='';
}
function nextImg(){
	num += 1;
	if (num > 2) num = 2;
	app.idx = num;
}
function prevImg(){
	num -= 1;
	if (num < 0) num = 0;
	app.idx = num;
}

function back(){
	this.section = 'acertijo';
	app.section='acertijo'
	app.idx=1;
};

function again(){
	this.section = 'acertijo';
	app.section='acertijo'
	if(app.estado==0){//ganó, pasa al sig pilar
		this.section='page1';
		app.section='page1';
		app.pg=0;
		s=0;
		app.backs='background-image:url('+app.pilar.bgs[app.pg]+')';
		this.pilar = pilares[app.pilSect]
		app.idx=1;
		app.estado=0;
	}
};
