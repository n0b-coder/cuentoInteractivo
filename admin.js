var app = new Vue({
    el: '#adminApp',
    data: {
        admin_data: game_data,
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