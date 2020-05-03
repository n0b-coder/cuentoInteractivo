//Info de cada pilar

//vidas
var finales = {
	//
	reset:["JS Has fracasado","JS Has descubierto el mejor final posible","JS Has descubierto el final secundario de la historia", ],
}
var vida={
	stat:['IMGS/Vidas/full.png','IMGS/Vidas/bar2.png','IMGS/Vidas/bar1.png','IMGS/Vidas/dead.png']
}
//torre de cada pilar
var torre = {
	torreBg:"background: url('IMGS/Fres.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"
}
//Array de pilares
//Contraseñas :O
var _0xfd70=["\x61\x62\x63\x64","\x65\x66\x67\x68","\x69\x6A\x6B\x6C"];
eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('5 4=[3[0],3[1],3[2]]',6,6,'|||_0xfd70|validos|var'.split('|'),0,{}))
//___

//var portada = {"texto":"texto portada"}


var game_data = {
	"historia":[
		[
		   {
			  
		   }
		]
	 ],
}
//vue
var app = new Vue({
  el: '#app',
  data: {
	secret:'',
	game_data: game_data,
	pilSect:0,
	pg:0,
	id:1,
	total:3*3,
	vida,
	torre,
	alOrDe:"REINTENTAR",
	resetBtn:"",
	final:finales,
	estado:0,
  	idx: 1,
	section:'intro1',
	counterf:1,
  },
  computed: {
    backs: function () {
      	if(this.section=='final'){
			  var game_data=game_data;
			return 'background-image:url("'+this.game_data.finales[this.counterf][0].imagen_fondo+'")';
		} else if(this.section=='reset'){
			return 'background-image:url("'+this.game_data.finales[this.counterf][0].imagen_fondo+'")';
		} else if(this.section=='resolver'){
			return 'background-image:url("'+this.game_data.pilares[this.id].fondo_acertijo+'")';
		} else if(this.section=='acertijo'){
			return 'background-image:url("'+this.game_data.pilares[this.id].torre+'")';
		} else if(this.section=='indagar'){
			return 'background-image:url("'+this.game_data.indagacion[this.pilSect].imagen_fondo+'")';
		} else if(this.section=='reintentar'){
			return 'background-image:url("'+this.game_data.pilares[this.id].fondo_acertijo+'")';
		}
		else {			
      		return 'background-image:url("'+this.game_data.historia[this.pilSect][this.pg].imagen_fondo+'")';
		}
    },
	//imágenes acertijo
	imagenes(){
		if (this.section=='indagar'){
			return this.game_data.indagacion[this.pilSect][this.idx].imagen_fondo;
		}
		return 'background-image:url("'+this.game_data.pilares[this.id].imagen_acertijo+'")';
	},
	monitor(){
		//return 'background-image:url('+game_data algo con monitor+')';
	},
	reset(){
		var game_data=game_data;
		if(this.section=='reset'){
			return 'background-image:url("'+this.game_data.historia[this.counterf][0].imagen_fondo+'")';
		}
	},
	finalT(){
		return this.game_data.finales[this.counterf][0].texto;
	}
  },
  methods: {
    activar: function (seccion, s) {
      this.section = seccion;
	  app.pg+=s;
	  //this.pilar = pilares[app.pilSect];
    },
    activarPilar: function (seccion) {
      this.section = seccion;
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
			if(app.total>=Math.round(3*3*0.6)){
				app.counterf=1;
			}
			else{
				app.counterf=2;
			}
			app.section='final';
			app.resetBtn="JUGAR DE NUEVO Y DESCUBRIR MÁS JS";
		}else{
			app.section='reintentar';
			app.alOrDe="¡ENHORABUENA! JS";
		}
		
	}
	else if(this.secret!=validos[app.pilSect]){
		app.estado++;
		if(app.estado==3){
			app.counterf=0;
			app.section='final';

			app.resetBtn="INTENTAR DESDE EL PRINCIPIO JS";
		}else{
			app.section='reintentar';
			app.alOrDe="REINTENTAR JS";
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
		app.id++;
		app.pg=0;
		s=0;
		app.idx=1;
		app.estado=0;
	}
};
