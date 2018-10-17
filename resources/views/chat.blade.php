<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content = "{{csrf_token()}}">


</head>
<body>
    <div id="app">
        <chat></chat>
    </div>
</body>
<script src="{{url('js/app.js')}}"></script>
</html>
