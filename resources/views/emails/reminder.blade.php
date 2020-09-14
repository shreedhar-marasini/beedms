<html>
<head>
    <title>Document Management System</title>
    <link rel="stylesheet" href="{{url('style.css')}}">


</head>
<body style="border: 5px solid #cccccc">
{{--<img src="logo.png">--}}
<br>
<div class="container " style="margin-left:30px; text-align: left;">

    Reminder Title : {{$title}} <hr>
    Reminder date : {{$reminderDate}} <hr>
    Reminder content : {{$content}} <hr>

    Created by {{$userId}}



    <div style="color:#cccccc">
        <hr>
        <br>Document Management System Powered by:<a href="http://www.youngminds.com.np/" style="color:#cccccc">Young
            Minds</a></div>
</div>
</body>
</html>
