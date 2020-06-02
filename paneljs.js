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
//Fetchs
function setGen(){
  const request = new Request('set.php');
 //Story data
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
}

function setImgs(){
  const imgs = new Request('setCimages.php');
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

}
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
      successImg:false,
      //Estado de texto y personaje
      status:{
        texto:'',
        imagen:'',
      },
      txt:'',
      personajeprev:"",
      active:false,
      imag2:0,
      action:0,
      pos:'Posición'
    },
    created(){
      setGen();
      setImgs();
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
          } else if (this.section=='postresol'){
            return this.gallery.post_resol;
          }
        }
      },
      tipo:function(){
        if(this.active==true){
          if(this.section!="pilares" && this.section!="resolucion"){
            return "personaje";
          } else {
            return "acertijo";
          }
        } else{
          return this.panel_data.tipo;
        }
      },
      id_img:function(){
        if (this.active==true){
          if (this.panel_data.tipo=='fondos-acertijo'){
            return this.panel_data.current_selection.id_acertijo;
          } else {
            return this.panel_data.current_selection.id_imagen_personaje;
          }
        }
        if (this.panel_data.tipo=='torres'){
          var idPil=this.panel_data.current_selection.id_pilar;
          return this.gallery.torre[idPil-1].imagen_id; //
        } else if (this.panel_data.tipo=='fondos-acertijo'){
          return this.panel_data.current_selection.id_fondo_acertijo;
        } else if (this.panel_data.tipo=='portada'){
          return this.panel_data.current_selection.id_portada;
        } else{
          return this.panel_data.current_selection.id_imagen_fondo;
        }
      },
      preview:function(){
        if(this.active==true){
          if (this.section=='resolucion'){
            return this.panel_data.current_selection.imagen_acertijo;
          }
          else {
            return this.panel_data.current_selection.imagen_personaje;
          }
        }
        else if(this.active==false){
          if(this.section=='pilares'){
            return this.panel_data.current_selection.torre;
          } else if(this.section=='resolucion'){
            this.status.texto='Modificar solución';
            this.status.imagen='Cambiar acertijo';
            this.personajeprev=this.panel_data.current_selection.imagen_acertijo;
            return this.panel_data.current_selection.fondo_acertijo;
          } else if(this.section=='portada'){
            this.status.texto='Modificar título';
            return this.panel_data.current_selection.imagen_fondo;
          } else {
            this.status.texto='Modificar texto';
            this.status.imagen='Cambiar personaje';
            this.personajeprev=this.panel_data.current_selection.imagen_personaje;
            return this.panel_data.current_selection.imagen_fondo;
          }
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
        if(this.section=='resolucion'){
          this.txt=item.solucion;
        }
        else {
          this.txt=item.texto;
        }
      },
      newImg:function(item){
        if(this.active==true){
          if (this.section=='resolucion'){
            return this.panel_data.current_selection.imagen_acertijo = item.Imag_link;
          }
          else {
            this.imag2=item.imagen_id;
            return this.panel_data.current_selection.imagen_personaje = item.Imag_link;
          }
        }
        else if(this.active==false){
          this.panel_data.current_selection.imagen_fondo = item.Imag_link;
          this.selected=item.imagen_id;
          if(this.section=='pilares'){
            this.panel_data.current_selection.torre = item.Imag_link;
          } else if(this.section=='resolucion'){
            this.panel_data.current_selection.fondo_acertijo = item.Imag_link;
          }
        }
      },
      
      onFileChange(e) {
          var files = e.target.files || e.dataTransfer.files;
          if (!files.length)
            return;
          this.createImage(files[0]);

            const formData = new FormData();

            formData.append('submit', 'true');
            formData.append('ImageToUpload', files[0]);
            formData.append('tipoimagen', this.tipo);
            formData.append('id_imagen', this.id_img);
            formData.append('accion',this.action);

            fetch('upload.php', {
              method: 'POST',
              body: formData  
            })
            // .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              setImgs();
              this.successImg=true;
            })
            .catch(error => {
              console.error('Error:', error);
            });
        },
        createImage(file) {
          var reader = new FileReader();
          reader.readAsDataURL(file);
      },
      //envía los datos a chancla.php
      save: function (item){        
        if (this.pos=='Centro'){
            this.pos='center';
        } else if(this.pos=='Derecha'){
            this.pos='right';
        } else if(this.pos=='Izquierda'){
            this.pos='left';
        } else{
            this.pos=this.panel_data.current_selection.pos_personaje;
        }
        success=true;
        var datoskul;
        var Id_pestana;
        var imagen2_id;
        if(this.section=='portada'){
          Id_pestana = item.id_portada;
        } else if(this.section=='pilares'){
          Id_pestana = item.id_pilar;
          imagen2_id=null;
        } else if(this.section=='resolucion'){
          Id_pestana = item.id_pilar;
          imagen2_id = item.imagen_acertijo;
        } else {
          Id_pestana = item.id_pestana;
          if(this.imag2!=0){
            imagen2_id = this.imag2;
          } else {
            imagen2_id=item.id_imagen_personaje;
          }          
        }
        if(this.active!=true){
          if(this.selected==item.imagen_id || this.selected==0){
            this.selected=item.imagen_id;
          }
        }
        if (this.section=='pilares'){
          datoskul=JSON.stringify({
            Id_cuento:1,
            Id_pestana,
            texto: this.txt,
            imagen_id: this.selected,
            tipo: this.tipo
          })
        } else {
          datoskul=JSON.stringify({
            Id_cuento:1,
            Id_pestana,
            imagen2_id,
            texto: this.txt,
            imagen_id: this.selected,
            tipo: this.tipo,
            personaje_pos:this.pos
          })

          }
        {
          fetch('savechanges.php', {
            method: 'POST',
            body: datoskul
        })
        .then(result => {
          console.log('Success:', result);
          setGen();
        })
        .catch(error => {
          console.error('Error:', error);
        });
        }
      },
    }
});