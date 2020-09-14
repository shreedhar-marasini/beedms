<script>
    $("#btn_move_to_folder").click(function () {
        var folder_id = $("#folder_id").val();
                @if(isset($document))
        var document_id =
                {{$document->id}}
                @elseif(isset($incomingDocument))
        var document_id =
                {{$incomingDocument->id}}
                @endif
        var docType = $("#docType").val();

        $.ajax({
            type: "POST",
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url: "{{url('documents/folderchange')}}",
            data: "docType=" + docType + "&document_id=" + document_id + "&folder_id=" + folder_id,
            success: function (data) {
                console.log(data);
                if (data) {
                    location.reload();


                }
            }
        });


    });
    $('#change_folder').click(function () {
        if ($('#change_folder').is(":checked")) {
            $('#folder_element_to_change').show();
        } else {
            $('#folder_element_to_change').hide();
        }
    });
    var selectedolditem = localStorage.getItem('selectedolditem');

    if (selectedolditem != null) {
        if (selectedolditem === 'setting_tab') {
            $('#preview').removeClass("active selected");
            $('#preview_li').removeClass("active selected");
            $('#settings_li').addClass('active selected ');
            $('#settings').addClass('active selected ');
        }
        if (selectedolditem === 'timeline_tab') {
            $('#preview').removeClass("active selected");
            $('#preview_li').removeClass("active selected");
            $('#timeline_li').addClass('active selected ');
            $('#timeline').addClass('active selected ');
        }
        if (selectedolditem === 'attachment_tab') {
            $('#preview').removeClass("active selected");
            $('#preview_li').removeClass("active selected");
            $('#attachment_li').addClass('active selected ');
            $('#attachment').addClass('active selected ');
        }

    }
    //place the scroll position where it was left before
    if (sessionStorage.scrollTop != "undefined") {
        $(window).scrollTop(sessionStorage.scrollTop);
    }

    // $('#preview').removeClass("active selected");
    // $('#preview_li').removeClass("active selected");
    //  $('#settings_li').addClass('active selected ');
    //  $('#settings').addClass('active selected ');

    //navigation bar

    $(".nav li a").click(function () {
        var id = $(this).attr("id");

        localStorage.setItem("selectedolditem", id);
    });
    $(document).ready(function () {
        timeago().render($('.need_to_be_rendered'));
    });

</script>