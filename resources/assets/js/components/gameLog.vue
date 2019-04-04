<template>
    <div>
        <p v-for="logs in gameLogs" :key="logs">{{logs}}</p>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                gameLogs: []
            }
        },
        mounted() {

            // equate response data from logs to an array to load logs on page refresh
            axios.post('/logs')
            .then(response => {
                this.gameLogs = response.data 
            });

            // listen for game log event emited in table component to load logs whenever a new marker was placed
            Event.$on('gameLog', () => {
                axios.post('/logs')
                .then(response => {
                    this.gameLogs = (response.data) 
                });
            });

            // if the board was cleared redeclare gameLogs as new array
            Event.$on('boardCleared', () => {
                axios.post('/logs')
                .then(response => {
                    this.gameLogs = new Array(); 
                });
            });       
        }
    }
</script>

<style>
p{
    text-align: center;
    color: white;
}
</style>