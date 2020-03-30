var pilar1 = {
	indagacion: ['IMGS/I1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	textoIndagacion: "arofuitnaroifunt oiarufnt ioarunf toiarnf",
}
var pilar2 = {
	indagacion: ['IMGS/p1.jpg','IMGS/p2.jpg','IMGS/p3.jpg'],
	textoIndagacion: "info del pilar 2",
}
var page1 = {
	pageTxt: "Info chévere de la página 1 :v",
}
var page2 = {
	pageTxt: "Info chévere de la página 2 :v",
}
var page3 = {
	pageTxt: "Info chévere de la página 3 :v",
}
var vida={
	stat:['IMGS/Vidas/full.png','IMGS/Vidas/bar2.png','IMGS/Vidas/bar1.png','IMGS/Vidas/dead.png']
}
var pilares = [pilar1, pilar2];
var paginas = [page1, page2, page3];
var app = new Vue({ 
  el: '#app',
  data: {
  	pilar: pilar1,
  	pagina:page1,
  	vida,
  	idx: 1,
  	section:'page1',
  },
  methods: {
    activar: function (numPag, seccion) {
      this.section = seccion;
      this.pagina = paginas[numPag]
    },
    activarPilar: function (numPilar) {
      this.section = 'acertijo';
      this.pilar = pilares[numPilar]
    }
  }
});
var num = app.idx; var respuesta=true;
function resolver(){
	if(respuesta==true){
		vida.stat[0];
	}	
}
function nextImg2(){
	num += 1;
	if (num > 2) num = 2;
	app.idx = num;
}
function prevImg2(){

	num -= 1;
	if (num < 0) num = 0;
	app.idx = num;
}

function back2(){
	this.section = 'acertijo';
	app.section='acertijo'
	app.idx=1;
};