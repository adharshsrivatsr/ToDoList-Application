<!DOCTYPE html>

<html>
    <title> ToDo App </title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css'>
    
    <body>

    <div class='container'>
        <div id='root'>
            <modal v-if='showModal' @click='showModal=false' >
                <template slot='body'>{{ $tasks->task }}</template>
            </modal>

            
            
    




    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.js"></script>
    </body>




</html>