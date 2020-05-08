var images_data = {
	"imgs":[
		[
		   {
			  
		   }
		]
	 ]
}
Vue.component('modal', {
  template: '#modal-template'
});

var app = new Vue({
    el: '#adminApp',
    data: {
    images_data: images_data,
    targetId:0,
    items:0,
    selected: 1,
    //popup
    image:'',
    newName:''
    },
    methods: {
        //upload
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
        //
        getId: function(item){
          this.targetId = item;	
          console.log(item);
      },
      uploadFile:function(ev){
        ev.preventDefault();

        let fd = new FormData();
        fd.append(this.image)

        let reque = new Request('cuentoid.php',{
            method: 'POST',
            body: JSON.stringify({
                 id: this.targetId,//
                 name: this.newName
            }),
        })
        //
        fetch()
        .then ()
      }
    }
});

const request = new Request('setCimages.php');

fetch(request)
  .then(response => {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error('Something went wrong on api server!');
    }
  })
  .then(response => {

	app.images_data = response;

  }).catch(error => {
    console.error(error);
  });