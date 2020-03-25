/*const { defaultView } = document;
const { documentElement } = document;
const handler = evt => requestAnimationFrame(() => {
  const hitBottom = (() => (defaultView.innerHeight + defaultView.pageYOffset) >= documentElement.offsetHeight)();
  hitBottom
    ? alert("bottom")
    : console.log('nope')
});
document.addEventListener('scroll', handler);
*/
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