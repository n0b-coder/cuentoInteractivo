
const request = new Request('pruebasjs.php');

//const request = new Request('https://www.mozilla.org/datosCuento.php?id_pilar=5");

fetch(request)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {
      /*
      response = {
            dato1: valor1,
            dato2: valor2,
            dato3: valor3,
          }
          */
		 console.debug(response);
		 // ...
	   }).catch(error => {
		 console.error(error);
	  });