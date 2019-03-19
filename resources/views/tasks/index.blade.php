<!DOCTYPE html>

<html>
    <title>
        To Do List Application
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css'>

    <body>


    <!-- <div class='container'> -->
      
    

    <div class='container'>
     <div id="app">
            
        <task-component>  </task-component>

     </div>
     </div>
    
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.js"></script>
    <script src="/js/app.js"> </script>
    

    </body>

    </html>
