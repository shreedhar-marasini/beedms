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
    @if($documentType=='incoming')

        <div style="margin-right: 5%; margin-left: 5%; text-align: justify">
            Attn: <br>
            <strong>{{ucfirst($letter->department->department_name)}} Department</strong><br><br>
            <i> We have just received a letter with subject “{{$letter->incoming_document_subject}}” with registration
                number
                “{{$letter->incoming_document_registration_number}} issued on
                “{{$letter->incoming_document_registration_date}}”.
                Please find the letter attached and do the needful.</i>

            Uploaded by
            {{$letter->user->name}}

            <br><br>
            <br/>
        </div>



    @elseif($documentType=='outgoing')
        <a style="margin-right: 5%; margin-left: 5%; text-align: justify">
            Attn: <br>
            <strong>{{ $letter->institution->institution_name }},</strong><br>
            @if($letter->institution->institution_address)
                <strong>{{ $letter->institution->institution_address }},</strong><br>
            @endif
            <br><br>
            @if($request->email_content!=null)
                <div style="background-color: antiquewhite">
                    {!! nl2br($request->email_content) !!}
                </div>

                {!! $letter->outgoing_document_content !!}
            @endif
            <br><br>
            <i> <?php $emailFooter = (App\Models\MasterSetting::where('key_name', '=', '_EMAIL_FOOTER_NOTE_')->first())?>
                {{$emailFooter->key_value}} </i>
            @if($letter->document_qr_code!=null)
                <br>
                You can check and verify genuinity of this letter by
                <a href="{{url('/document/'.$letter->document_qr_code)}}">
                    clicking here
                </a>
                or you can scan the
                QR-code below. <br>
                <?php
                $website = \App\Models\MasterSetting::where('key_name', '_COMPANY_WEBSITE_')->first();

                ?>
                <a href="{{url('document/'.$letter->document_qr_code)}}">
                    <img src="{{$website->key_value . '/storage/uploads/documents/outgoingDocuments/QR-Codes/' . base64_decode($letter->document_qr_code)}}">
                </a>
            @endif
            <br><br>
            @if($letter->signature_user_id!=null)
                <?php $signature = \App\User::where('id', $letter->signature_user_id)->first();?>

                {!! nl2br($signature->user_signature_content)!!}<br>
            @endif
            <br/>
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
