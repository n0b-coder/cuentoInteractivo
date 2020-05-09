var admin_data = {
	"historia":[
		[
		   {
			  
		   }
		]
	 ],
	 "pilares":{
	 }
}
var checkboxes={
    list: ["Historia","Pilares","Indagacion", "Resolución", "Finales"]
};

var app = new Vue({
    el: '#panelApp',
    data: {
      admin_data: admin_data,
      targetId:0,
      items:0,
      selected: 1,
      check:'',
      optionV: checkboxes,
      pjOrAcer:". . .",
      texto:". . .",
      txt:'',
      estado:false,
      normal:true
    },
    methods: {
      checkboxF:function(){//para los checkbox
        if(this.check==this.optionV.list[3]){
            this.pjOrAcer='imagen del acertijo';
            this.texto='respuesta';
        } else if(this.check==this.optionV.list[2]){
          this.pjOrAcer='No disponible';
          this.texto='No disponible';
          this.estado=true;
        }
        else{
          this.pjOrAcer='personaje';
          this.texto='texto';
          this.estado=false;
        }
      },
      getId: function(item,key){//recuperar id de item
        this.txt = item-1;			
        fetch('cuentoid.php', {
            method: 'post',
            body: JSON.stringify({
                ides: this.targetId+1,//
                name: this.admin_data.cuentos[this.targetId][0].name
            })
        });
      },
      placeName:function(){
          return this.admin_data.cuentos[this.selected-1][0].name;
      }
    },
    computed:{
      seccion:function(){
        if(this.check==this.optionV.list[0]){//historia
          this.normal=1;
          return this.admin_data.historia;
        } else if (this.check==this.optionV.list[1]){//pilares
          this.normal=3;
          return this.admin_data.pilares;//necesito que pilares sea enviado como un array
        } else if (this.check==this.optionV.list[2]){//indagación
          this.normal=1;
          return this.admin_data.indagacion;
        } else if (this.check==this.optionV.list[3]){//pilares, resolución local
          this.normal=2;
          return this.admin_data.pilares;//necesito que pilares sea enviado como un array
        } else if(this.check==this.optionV.list[4]){
          this.normal=1;
          return this.admin_data.finales;
        }
      }
    }
});

const request = new Request('set.json');

fetch(request)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {

	app.admin_data = response;

  }).catch(error => {
    console.error(error);
  });