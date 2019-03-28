<!DOCTYPE html>

<html>
<title>
    To Do List Application
</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.css'>
<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css" />
<link
  type="text/css"
  rel="stylesheet"
  href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"
/>

 <script src="//unpkg.com/@babel/polyfill@latest/dist/polyfill.min.js"></script>
<script src="//unpkg.com/vue@latest/dist/vue.min.js"></script> 
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>

<body>

<div class='container'>
    <div id="app">
        <tasks></tasks>
    </div>
</div>



<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.js"></script>
<script src="/js/app.js"> </script>

</body>

</html>