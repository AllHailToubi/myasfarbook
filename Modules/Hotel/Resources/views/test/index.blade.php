<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/all.css')}}">
    
</head>
<body>
    
    <div id="app" class="border border-danger">
        <app-home></app-home>
    </div>
    
    
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        $(".border").on("click",function(){
            //alert("ho");
        });
    </script>
</body>
</html>