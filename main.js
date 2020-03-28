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
