<template>
  <div>
    <button @click="clear()" class="butn">Clear board</button>
    <br></br>
  </div>  
</template>

<script>
export default{
  data(){
    return{
      btnTriggered: 1
    }
  },
    methods: {
      
      // on button click pass a value to the request that it was triggered
      clear(){
        axios.post('/request', {
          btnTriggered: this.btnTriggered
        }).then(response => {
           Event.$emit('boardCleared')
        });
      }
    }
  }
</script>

<style>
div{
  text-align: center;
}
.butn {
  background: #babfc2;
  background-image: -webkit-linear-gradient(top, #babfc2, #393f42);
  background-image: -moz-linear-gradient(top, #babfc2, #393f42);
  background-image: -ms-linear-gradient(top, #babfc2, #393f42);
  background-image: -o-linear-gradient(top, #babfc2, #393f42);
  background-image: linear-gradient(to bottom, #babfc2, #393f42);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  -webkit-box-shadow: 1px 4px 3px #474747;
  -moz-box-shadow: 1px 4px 3px #474747;
  box-shadow: 1px 4px 3px #474747;
  font-family: Arial;
  color: #ffffff;
  font-size: 16px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

.butn:hover {
  background: #242424;
  background-image: -webkit-linear-gradient(top, #242424, #707c85);
  background-image: -moz-linear-gradient(top, #242424, #707c85);
  background-image: -ms-linear-gradient(top, #242424, #707c85);
  background-image: -o-linear-gradient(top, #242424, #707c85);
  background-image: linear-gradient(to bottom, #242424, #707c85);
  text-decoration: none;
}
</style>