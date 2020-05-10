var panel_data = {
	"historia":[
		[
		   {
			  
		   }
		]
	 ]  
}

var gallery = {
  "images":[

  ]
}

var app = new Vue({
    el: '#panelApp',
    data: {
      panel_data: panel_data,
      //galería
      gallery:gallery,
      popUp: false
    },
    methods: {
      activar: function (item){
        //console.log(Object.keys(this.panel_data));
        this.panel_data.current_selection = item;
        console.log(item);
      },
      newImg:function(item){
        this.panel_data.current_selection.imagen_fondo = item.Imag_link;
      },
      save: function (item){
        console.log(item);
        fetch('cuentoid.php', {
            method: 'POST',
            body: JSON.stringify(item)
        });
      },
    }
});


const request = new Request('set.php');
const imgs = new Request('imgs.json');

fetch(request)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {

	app.panel_data = response;

  }).catch(error => {
    console.error(error);
  });

  fetch(imgs)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {

	app.gallery = response;

  }).catch(error => {
    console.error(error);
  });