var pilar1 = {
	indagacion: ['IMGS/I1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	pilarStyle:	"background: url('IMGS/Tor1.png'); background-size: cover"
}
var pilar2 = {
	indagacion: ['IMGS/p1.jpg','IMGS/p2.jpg','IMGS/p3.jpg'],
	pilarStyle:	"background: url('IMGS/p5.jpg'); background-size: cover"
}
var page1 = {
	pageTxt: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
}
var page2 = {
	pageTxt: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.",
}
var page3 = {
	pageTxt: "Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?",
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
  	estado:2,
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
var num = app.idx;
function resolver(){
	app.estado=3;
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