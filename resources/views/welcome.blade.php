<!DOCTYPE html>

<html>
    <title> ToDo App </title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <body>

    <!-- <div class='container'> -->
      
      
    <div class='container'>
     <div id="app">
            
        <task-component> </task-component>

     </div>
     </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.13/vue.js"></script>
    <script src="/js/app.js"> </script>
    

    </body>

</html>