//finales definidos dentro del Js
var finales = {
	reset:["JS Has fracasado","JS Has descubierto el mejor final posible","JS Has descubierto el final secundario de la historia", ],
}
//Vidas desde la carpeta IMG_NEW
var vida={
	stat:['IMG_NEW/Vidas/full.png','IMG_NEW/Vidas/bar2.png','IMG_NEW/Vidas/bar1.png','IMG_NEW/Vidas/dead.png']
}
//
var game_data = {
	"historia":[
		[
		   {
			  
		   }
		]
	 ],
	 "pilares":{
	 }
}

//vue

//________________________
var app = new Vue({
  el: '#app',
  data: {
	secret:'',
	game_data: game_data,
	pilSect:0,
	pg:0,
	id:1,
	vida,
	nVidas:3,//número de intentos que tiene, podría ser desde la base de datos con el # de vidas
	intentos:9,
	alOrDe:"REINTENTAR",
	resetBtn:"",
	final:finales,
	estado:0,
  	idx: 1,
	section:'base',
	counterf:1,
	//
  },
  computed: {
	  //
	
	  //
    backs: function () {
      	if(this.section=='final'){
			return 'background-image:url("'+this.game_data.finales[this.counterf][0].imagen_fondo+'")';
		} else if(this.section=='reset'){
			//fslta pantalla de reset en DB
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
	imagenes: function (){
		if (this.section=='indagar'){
			return this.game_data.indagacion[this.pilSect][this.idx].imagen_fondo;
		}
		return 'background-image:url("'+this.game_data.pilares[this.id].imagen_acertijo+'")';
	},
	//Imagen monitor
	monitor:function (){
		return this.game_data.historia[this.pilSect][this.ids].imagen_fondo;
	},
	//Pantalla redirección a index
	reset:function (){
		//return this.game_data.finales[this.counterf][0].texto; algo así pero con reset :V
	},
	//Texto final
	finalT:function (){
		return this.game_data.finales[this.counterf][this.pg].texto;
	},
	pass: function(){
		return this.secret.toLowerCase();
	},
	total: function(){
		return Object.keys(this.game_data.pilares).length;
	},
	paginas: function(){
		if(this.section=='final'){
			return Object.keys(this.game_data.finales[this.counterf]).length;
		} else {
		return Object.keys(this.game_data.historia[this.pilSect]).length;
		}
	},
  },
  methods: {
	  
	  //siguiente página
    activar: function (seccion, s) {
      this.section = seccion;
	  this.pg+=s;
	  if (this.section=='base'){
		if (this.pg==this.paginas){
			this.section='acertijo';
		}
	}
	if (this.section=='final'){
		if (this.pg==this.paginas){
			this.section='reset';
		}
	}
	},
	//Página Torres
    activarPilar: function (seccion) {
      this.section = seccion;
	},
	//Resolver acertijo
	resolver: function (){
		var validos=this.game_data.pilares[this.id].solucion;
		this.pg=0;
		if(this.pass==validos){
			this.pilSect++;
			this.estado=0;
			if(this.pilSect==this.total){
				if(this.intentos>=Math.round(this.total*3*0.9)){
					this.counterf=1;
				}
				else if (this.intentos<Math.round(this.total*3*0.9) && this.intentos>=Math.round(this.total*3*0.6)){
					this.counterf=2;
				}
				else {
					this.counterf=3; //para el final no tan bueno (final 4)
				}
				this.resetBtn="JUGAR DE NUEVO Y DESCUBRIR MÁS JS";
				this.activar('final',0);
			}else{
				this.section='reintentar';
				this.alOrDe="¡ENHORABUENA! JS";
			}			
		}
		//si se equivoca
		else if(this.pass!=validos){
			this.estado++;
			if(this.estado==3){
				this.counterf=0;
				this.pg==0
				this.section='final';	
				this.resetBtn="INTENTAR DESDE EL PRINCIPIO JS";
			}else{
				this.section='reintentar';
				this.alOrDe="REINTENTAR JS";
				this.intentos--;
			}
		}
		this.secret='';
	},
	nextImg: function (){
		this.idx += 1;
		if (this.idx  > 2) this.idx  = 2;
	},
	prevImg: function (){
		this.idx -= 1;
		if (this.idx < 0) this.idx = 0;
	},
	back: function (){
		this.section = 'acertijo';
		this.idx=1;
	},
	again: function (){
		this.section = 'acertijo';
		if(this.estado==0){//ganó, pasa al sig pilar
			this.section='base';//pagina 1 del siguiente pilar
			this.id++;
			this.pg=0;
			s=0;
			this.idx=1;
			this.estado=0;
		}
	},

  }
});

const request = new Request('set.json');

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
	app.admin_data = response;

  }).catch(error => {
    console.error(error);
  });

  //:src="item.imagen"