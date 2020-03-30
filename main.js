var pilar1 = {
	indagacion: ['IMGS/I1.jpg','IMGS/I2.jpg','IMGS/I3.jpg'],
	textoIndagacion: "arofuitnaroifunt oiarufnt ioarunf toiarnf",
	background: "url('IMGS/p4.jpg')",
}

var pilar2 = {
	indagacion: ['IMGS/p1.jpg','IMGS/p2.jpg','IMGS/p3.jpg'],
	textoIndagacion: "info del pilar 2",
	acertijoStyle:{
		background: "url('IMGS/p5.jpg')"
	}
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

var pilares = [pilar1, pilar2];
var paginas = [page1, page2, page3];
var app = new Vue({ 
  el: '#app',
  data: {
  	pilar: pilar1,
  	pagina:page1,
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

function resolver(){
	app.idx = 0;
}
function nextImg2(){
	var num = app.idx;
	num += 1;
	if (num > 2) num = 2;
	app.idx = num;
}
function prevImg2(){
	var num = app.idx;
	num -= 1;
	if (num < 0) num = 0;
	app.idx = num;
}

var back=true;
function back2(){
	this.section = 'acertijo';
	app.section='acertijo'
	app.idx=1;
};
/*
var back=true;
function back2(){
	this.section = 'acertijo';
	app.section='acertijo'
	app.idx=1;
};

var images=['IMGS/I1','IMGS/I2','IMGS/I3'];
var c=2;

function nextImg(){
	if(c<3){
		c++;
	}else{
		c=3;
	}
	box.innerHTML="<img src="+images[c-1]+".jpg>";
};
function prevImg(){
	if(c>1){
		c--;
	}else {
		c=1;
	}
	box.innerHTML="<img src="+images[c-1]+".jpg>";
};
var back=true;
function back(){
	c=2;
};


$(document).ready(function(){
	$('.secciones section').hide();
	$('.secciones section:first').show();

	$('ul.sig li a').click(function(){
		var activePage=$(this).attr('href');
		$('.secciones section').hide();
		$(activePage).show();
		return false;
	});
});
*/