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
      box:0,
      kyes:[],
      kk:'',
      //galería
      gallery:gallery,
      popUp: false,
      selected:1
    },
    computed:{
      seccion:function(){
        if(this.box==1){
          return this.panel_data.historia;
        } else if (this.box==3){
          return this.panel_data.indagacion;
        } else if (this.box==5){
          return this.panel_data.finales;
        } else{
          return this.panel_data.historia;
        }
      },
      keyes:function(){
        return this.kyes=(Object.keys(this.panel_data));
      }
    },
    methods: {
      kaka:function(index){
        return this.panel_data.Object.keys(this.panel_data)[index];
      },
      activar: function (item){
        JSON.parse(this.kyes);
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
            body: JSON.stringify({
              id_pestana: item.id_pestana,
              texto: item.texto,
              imagen_id: this.selected,
              tipo: this.keys[0]
            })
        });
      },
    }
});


const request = new Request('set.json');
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