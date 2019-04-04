<template>
    <h2>{{currentPlayer}}</h2>
</template>

<script>
    export default {
        data(){
            return{
                currentPlayer: ''
            }
        },
        mounted(){

            // load current player on new page load or refresh
            axios.post('/currentPlayer')
                .then(response => {
                    this.currentPlayer = response.data
                });

            // listen to game log event so that whenever a new log is added the player is changed
            Event.$on('gameLog', () => {
                axios.post('/currentPlayer')
                .then(response => {
                    this.currentPlayer = response.data
                });
            });

            // if the clear board button was clicked current player becomes X by default
            Event.$on('boardCleared', () => {
                this.currentPlayer = 'Current Player is: X'
            });
        }
    }
</script>

<style>
h2{
    text-align: center;
    color: white;
}
</style>