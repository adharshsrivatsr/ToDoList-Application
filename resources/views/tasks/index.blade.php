<!DOCTYPE html>

<html>
<title>
    To Do List Application
</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css'>

<body>
<br>

<div class="contaniner" style="background:grey; width:1200px; margin:0 auto; height:50px">
    <div style="text-align:center; line-height: -5px"> 
        <h2>To-do List Application</h2> 
    </div>
</div> 

<br>

<div class="container" >
    <div id="app">
        <tasks></tasks>
    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
<script src="/js/app.js"> </script>


</body>

</html>