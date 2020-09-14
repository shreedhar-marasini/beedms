<!doctype html>
<html lang="en">
<head>


    <title>Document</title>
    <style type="text/css">

    </style>
</head>

<body>



@if($item->outgoing_document_content!=null)
    <div style="text-align: justify">{!! $newContent  !!}</div>
   @else
    <div style="text-align: justify">{!! $item->digitized_document_content  !!}</div>


@endif
{{--@if(isset($includeSignature))--}}
    {{--@if($includeSignature=='headerWithSignature' &&  isset($item->document_qr_code))--}}
        {{--<img src="{{public_path() . '/storage/uploads/documents/outgoingDocuments/QR-Codes/' . base64_decode($item->document_qr_code)}}">--}}
    {{--@endif--}}
{{--@endif--}}
</body>

</html>