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
      unique:false,
      section:'historia',
      //galería
      gallery:gallery,
      image:'',
      popUp: false,
      selected:0
    },
    methods: {
      seccion:function(actSeccion){        
        this.section=actSeccion;
      },
      activar: function (item){
        //console.log(Object.keys(this.panel_data));
        this.panel_data.current_selection = item;
        console.log(item);
      },
      newImg:function(item){
        this.panel_data.current_selection.imagen_fondo = item.Imag_link;
      },
      onFileChange(e) {
        var files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImage(files[0]);
      },
      createImage(file) {
        var reader = new FileReader();   
        reader.onload = (e) => {
          this.image = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      //envía los datos a chancla.php
      save: function (item){
        if(this.selected==0){
          this.selected=item.imagen_id;
        }
        console.log(item);
        fetch('chancla.php', {
            method: 'POST',
            body: JSON.stringify({
              id_pestana: item.id_pestana,
              texto: item.texto,
              imagen_id: this.selected,
              tipo: this.panel_data.tipo
            })
        });
      },
    }
});


const request = new Request('set.json');
const imgs = new Request('imgs.json');
//data del cuento
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

  //Image gallery
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