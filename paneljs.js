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
//

//
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
      selected:0,
      //success modal :v
      success:false,
      //Estado de texto y personaje
      status:{
        texto:'',
        imagen:''
      },
      active:false
    },
    computed:{
      photos:function(){
        if(this.active==true){
          if (this.section=='resolucion'){ 
            return this.gallery.acertijo;
          }
          else {
            return this.gallery.personajes;
          }
        }
        else if(this.active==false){
          if (this.section=='historia'){ 
            return this.gallery.historia;
          } else if (this.section=='pilares'){
            return this.gallery.torre;
          } else if (this.section=='indagacion'){
            return this.gallery.indagacion;
          } else if (this.section=='finales'){
            return this.gallery.finales;
          } else if (this.section=='resolucion'){
            return this.gallery.facertijo;
          }
        }
      },
      tipo:function(){
        return this.panel_data.tipo;
      },
      preview:function(){
        if(this.section=='pilares'){
          return this.panel_data.current_selection.torre;
        } else if(this.section=='resolucion'){          
          this.status.texto='Modificar solución';
          this.status.imagen='Cambiar acertijo';
          return this.panel_data.current_selection.fondo_acertijo;
        } else if(this.section=='portada'){          
          this.status.texto='Modificar título';
          return this.panel_data.current_selection.imagen_fondo;
        } else {
          this.status.texto='Modificar texto';
          this.status.imagen='Cambiar personaje';
          return this.panel_data.current_selection.imagen_fondo;
        }
      }
    },
    methods: {
      seccion:function(actSeccion){        
        this.section=actSeccion;
      },
      activar: function (item){
        this.panel_data.current_selection = item;
        this.selected=item.imagen_id;
      },
      newImg:function(item){
        this.panel_data.current_selection.imagen_fondo = item.Imag_link;
        if(this.section=='pilares'){
          this.panel_data.current_selection.torre = item.Imag_link;
        }
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
        success=true;
        var Id_pestana;
        if(this.section=='portada'){
          Id_pestana = item.id_portada; 
        } else if(this.section=='pilares'){
          Id_pestana = item.id_pilar;
        } else if(this.section=='resolucion'){
          Id_pestana = item.id_pilar;
        } else {
          Id_pestana = item.id_pestana;
        }
        if(this.selected==item.imagen_id || this.selected==0){
          this.selected=item.imagen_id;
        }
        {
          fetch('savechanges.php', {
            method: 'POST',
            body: JSON.stringify({
              Id_cuento:1,
              Id_pestana,
              imagen2_id:item.imagen_acertijo,
              texto: item.texto,
              imagen_id: this.selected,
              tipo: this.tipo
            })
        });
        }
      },
    }
});


const request = new Request('set.php');
const imgs = new Request('setCimages.php');
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