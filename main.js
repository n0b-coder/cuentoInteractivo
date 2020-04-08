var pilar1 = {
	bgs:['IMGS/His1.jpg','IMGS/His2.jpg','IMGS/p3.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/I1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	pilarStyle:	"background: url('IMGS/Tor1.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 1","info 2","info 3"]
}
var pilar2 = {
	bgs:['IMGS/p1.jpg','IMGS/p4.jpg','IMGS/p5.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/p1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	pilarStyle:	"background: url('IMGS/His1.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 4","info 5","info 6"]
}
var pilar3 = {
	bgs:['IMGS/p5.jpg','IMGS/p2.jpg','IMGS/p3.jpg'],
	runa:'IMGS/Res.png',
	indagacion: ['IMGS/p2.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	pilarStyle:	"background: url('IMGS/His2.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;",
	texto:["info 7","info 8","info 9"]
}
var vida={
	stat:['IMGS/Vidas/full.png','IMGS/Vidas/bar2.png','IMGS/Vidas/bar1.png','IMGS/Vidas/dead.png']
}
var torre = {
	torreBg:"background: url('IMGS/Fres.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"
}
var pilares = [pilar1, pilar2, pilar3];

var validos=['abcd',"efgh"];

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
  	estado:1,
  	idx: 1,
  	section:'page1',
  },
  methods: {
    activar: function (numPag, seccion, s) {
      this.section = seccion;
	  app.pg+=s;
	  app.backs='background-image:url('+app.pilar.bgs[app.pg]+')'
	  this.pilar = pilares[app.pilSect]
    },
    activarPilar: function () {
      this.section = 'acertijo';
	}
  }
  
});
var num = app.idx;

function resolver(){
	if(app.secret==validos[0]){
			app.estado=0;
			app.alOrDe="¡ENHORABUENA!";		
			app.pilSect++;
	}
	else if(this.secret!=validos[0]){
		app.estado++;
		if(app.estado==3){
			app.alOrDe="HAS FRACASADO";
			app.pilSect=0;
		}else{
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
	app.idx=1;
	if(app.estado==3){//la cagó
		this.section='page1';
		app.section='page1'
		app.idx=1;
		app.estado=0;
		app.pg=0;
		s=0;
		app.backs='background-image:url('+app.pilar.bgs[0]+')';
	}
	if(app.estado==0){//ganó, pasa al sig pilar
		if (app.pilSect==3){
			alert('Final 1');
			this.section='respuesta';
			app.section='respuesta'
		}else{
		this.section='page1';
		app.section='page1';
		app.pg=0;	
		s=0;
		app.backs='background-image:url('+app.pilar.bgs[app.pg]+')';
		this.pilar = pilares[app.pilSect]
		}
		app.idx=1;
		app.estado=0;

	}
};