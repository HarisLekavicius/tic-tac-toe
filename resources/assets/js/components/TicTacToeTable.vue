<template>
  <div class="ticTacToe">
    <div class="column">
      <span  v-for="id in 3" :key="id" @click="insert(id)" class="square">{{markers[id]}}</span>
    </div>
    <div class="column">
      <span v-for="id in 3" :key="id" @click="insert(id+3)" class="square">{{markers[id+3]}}</span>
    </div>
    <div class="column">
      <span v-for="id in 3" :key="id" @click="insert(id+6)" class="square">{{markers[id+6]}}</span>
    </div>   
  </div>   
</template>

<script>
  // import {markers} from 'vuex'
    export default {
      data(){
        return{
        markers: new Array(10)
        }
      },
      methods: {
        insert(id){

          // if box was clicked pass id and markers to request
          axios.post('/request', {
            id, 
            markers: this.markers
          }).then(response=> {
            this.markers = response.data;

            // emit a new game log event everytime new data was retrieved
            Event.$emit('gameLog');
          });
  
          // Event.$emit('store', id);
        }
      },
      mounted(){

         // if button was clicked redaclare markers array as empty
        Event.$on('boardCleared', () => {
          this.markers = new Array(10);
        });

        // on page refresh load markers from markers() function
        axios.post('/markers', {
          markers: this.markers
        }).then(response => {
          this.markers = response.data
        })
      }
      // computed: {
      //   getallMarkers(){
      //     return this.$store.state.markers
      //   }
      // }
      /*mounted(){
        //game API data
        axios.get('api/TicTacToe').then(response => {
          var game = response.data
          game.append('_token', csrf)
          this.currentPlayer = game.currentPlayer
          this.winner = game.winner
        }).catch(error =>{
          console.log(error)
        })
      }*/
    }
</script>

<style>
* {
    box-sizing : border-box;
  }
  
  html, body {
    height : 100%;
  }
  
  body {
    display         : flex;
    align-items     : center;
    justify-content : center;
    vertical-align  : center;
    flex-wrap       : wrap;
    align-content   : center;
    
    font-family     : 'Open Sans', sans-serif;
    background      : linear-gradient(top, #222, #333);
  }
  
  .ticTacToe {
    display         : flex;
    justify-content : space-between;
    
    width   : 400px;
    height  : 400px;
    padding : 5px;
    border  : 1px solid #e4e4e4;
  }
    .column {
      display         : flex;
      flex-direction  : column;
      justify-content : space-between;
    }
    
    .square {
      display : block;
      width   : 125px;
      height  : 125px;
      border  : 1px solid #e4e4e4;
      
      color       : #e4e4e4;
      font-size   : 5em;
      font-weight : 100;
      text-align  : center;
      padding     : 20px;
    }

</style>