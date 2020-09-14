<html>
<head>
    <title>Document Management System</title>
    <link rel="stylesheet" href="{{url('style.css')}}">


</head>
<body style="border: 5px solid #cccccc">
{{--<img src="logo.png">--}}
<br>
<div class="container " style="margin-left:30px; text-align: left;">


    <img src="{{$logoForEmail}}"><br><br>

    <hr>

    @if($documentType=='/documents/incomingDocument/')
        <div style="margin-right: 5%; margin-left: 5%; text-align: justify">
            Attn: <br>
            <strong>{{ucfirst($letter->department->department_name)}} Department</strong><br><br>
            <i>{{Auth::user()->name}} commented on “{{$letter->incoming_document_subject}}” with registration
                number
                “{{$letter->incoming_document_registration_number}} issued on
                “{{$letter->incoming_document_registration_date}}”.
                <br><br>
                <span style="background-color: #bcddff;padding: 15px">

                   " {{$request->document_comments_description}}"
                </span>
                <br><br>
                Please click in this <a href="{{url('documents/incomingDocument/'.$letter->id)}}">link</a> for necessary
                action.</i>

            Uploaded by
            {{$letter->user->name}}

            <br><br>
            <br/>
        </div>



    @elseif($documentType=='/documents/outgoingDocument/')
        <div style="margin-right: 5%; margin-left: 5%; text-align: justify">

            Attn: <br>
            <br>
            <i>{{Auth::user()->name}} commented on “{{$letter->outgoing_document_subject}}” with issue number
                “{{$letter->outgoing_issue_number}}”.<br><br>
                <span style="background-color: #bcddff;padding: 15px">
                    "{{$request->document_comments_description}}"
                </span>
                <br>
                <br>
                Please click in this <a href="{{url('documents/outgoingDocument/'.$letter->id)}}">link</a> for necessary
                action.</i><br>

            Created by
            {{$letter->user->name}}

            <br><br>
            <br/>
        </div>
    @else
        <div style="margin-right: 5%; margin-left: 5%; text-align: justify">

            Attn: <br>
            <br>
            <i>{{Auth::user()->name}} commented on “{{$letter->digitized_document_name}}”.<br><br>
                <span style="background-color: #bcddff;padding: 15px">
                    "{{$request->document_comments_description}}"
                </span>
                <br>
                <br>
                Please click in this <a href="{{url('documents/digitizedDocument/'.$letter->id)}}">link</a> for
                necessary
                action.</i>
            <br>

            Created by
            {{$letter->user->name}}

            <br><br>
            <br/>
        </div>


    @endif

    <i>If you have any questions or if this email was not meant for you, please email

        <?php $email = (App\Models\MasterSetting::where('key_name', '=', '_COMPANY_DEFAULT_EMAIL_')->first())?>
        {{$email->key_value}}

    </i>

    <div style="color:#cccccc">
        <hr>
        <br>Document Management System Powered by:<a href="http://www.youngminds.com.np/" style="color:#cccccc">Young
            Minds</a></div>
</div>
</body>
</html>
