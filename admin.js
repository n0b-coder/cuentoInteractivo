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

var app = new Vue({
    el: '#adminApp',
    data: {
        admin_data: admin_data,
		targetId:0,
		items:0,
		selected: 1
    },
    methods: {
        //
        getId: function(item){
          this.targetId = item-1;			
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