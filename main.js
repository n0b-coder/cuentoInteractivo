//Info de cada pilar
var pilar1 = {
	bgs:['IMGS/His1.jpg','IMGS/His2.jpg','IMGS/p3.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/I1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	indagaTxt:["Pasado","Presente","Futuro"],
	pilarStyle:	"background: url('IMGS/Tor1.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 1","info 2","info 3"]
}
var pilar2 = {
	bgs:['IMGS/p1.jpg','IMGS/p4.jpg','IMGS/p5.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/p1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	indagaTxt:["Pasado","Presente","Futuro"],
	pilarStyle:	"background: url('IMGS/His1.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 4","info 5","info 6"]
}
var pilar3 = {
	bgs:['IMGS/p5.jpg','IMGS/p2.jpg','IMGS/p3.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/p2.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	indagaTxt:["Pasado","Presente","Futuro"],
	pilarStyle:	"background: url('IMGS/His2.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 7","info 8","info 9"]
}
//vidas
var finales = {
	finalTxt:["Ganaste Pro","Ganaste kk","La has cagado en todos los intentos, moriste"],
	finalBg:["IMGS/p1.jpg","IMGS/p4.jpg","IMGS/p5.jpg"],
	reset:["Has desbloqueado uno de los finales posibles","Has desbloqueado el 2do de los finales posibles", "Has fracasado"],
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
//Array de contraseñas
var validos=['abcd',"efgh","ijkl"];
//___
var app = new Vue({ 
  el: '#app',
  data: {
	secret:'',
	pilar: pilar1,
	pilSect:0,
	pg:0,
	backs:'background-image:url('+pilar1.bgs[0]+')',
	vida,
	torre,
	alOrDe:"REINTENTAR",
	resetBtn:"",
	final:finales,
	estado:0,
  	idx: 1,
	section:'page1',
	counterf:0,
  },
  methods: {
    activar: function (numPag, seccion, s) {
      this.section = seccion;
	  app.pg+=s;
	  app.backs='background-image:url('+app.pilar.bgs[app.pg]+')'
	  this.pilar = pilares[app.pilSect]
	  if(app.section=='final'){
		app.backs='background-image:url('+app.final.finalBg[app.counterf]+')'
	}
	if(app.section=='reset'){
		app.backs='background-image:url('+app.final.resetBg[app.counterf]+')'
	}
    },
    activarPilar: function () {
      this.section = 'acertijo';
	}
  }
  
});
var num = app.idx;

function resolver(){
	if(app.secret==validos[app.pilSect]){
		app.pilSect++;
		app.estado=0;
		if(app.pilSect==3){
			app.counterf=0;
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
			/*app.pilSect=0;
			app.estado=0;
			app.pg=0;
			s=0;	*/
			app.resetBtn="INTENTAR DESDE EL PRINCIPIO";
		}else{
			app.section='reintentar';
			app.alOrDe="REINTENTAR";	
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