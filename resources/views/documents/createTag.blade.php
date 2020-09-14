<script>
    $('#create_tag_check_box').click(function () {
        if ($('#create_tag_check_box').is(":checked")) {
            $('#create_tag').show();
        } else {
            $('#create_tag').hide();
        }
    });
    $("#create_tag_button").click(function () {
        var name = $("#tag_name").val();


        $.ajax({
            type: "POST",
            "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url: "{{url('configurations/tag')}}",
            data: "tag_name=" + name,
            success: function (data) {
                console.log(data);
                if (data) {

                    console.log(data['id']);
                    $('#tag_name').val("");
                    $('#create_tag').hide();


                    $("#my-text-input").tokenInput("add", {id: data['id'], tag_name: data['tag_name']});
                    $("#create_tag_check_box").prop("checked", false);

                }
            }
        });


    });
    $('.token-input-list-facebook').remove();
    $("#my-text-input").tokenInput("{{url('configurations/tag/search')}}", {
        onReady: function () {
            $('#token-input-my-text-input').attr('placeholder', 'Type Document Tag');
            $('#token-input-my-text-input').attr('value', '{{Request::get('tag_id')}}');
        },
        theme: "facebook",
        noResultsText: 'Tags not Found',
        preventDuplicates: true,
        tokenValue: "id",
        propertyToSearch: "tag_name"
    });
    $('#nepaliDate').nepaliDatePicker({
        npdMonth: true,
        npdYear: true
    });
</script>
<script>
    // Create Folder

    $(document).ready(function () {
        $('#folder_name').on('keyup', function () {

            var institution_id = $('#related_institution_id').val();
            folder_name = $('#folder_name').val();
            // $('#folder_id').remove();
            $('#datalistItems').load('/get-folder-name/' + institution_id + '/' + folder_name);

        });
        $('#create_folder_check_box').click(function () {
            if ($('#create_folder_check_box').is(":checked")) {
                $('#create_folder').show();
            } else {
                $('#create_folder').hide();
            }
        });

        $("#create_folder_button").click(function () {
            var name = $("#folder_name").val();
            var institution = $("#folder_institution_id").val();
         
            $.ajax({
                type: "POST",
                "headers": {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: "{{url('folder')}}",
                data: "name=" + name + "&institution_id=" + institution,
                success: function (data) {
                    if (data) {
                        console.log(data['id']);
                        $('#folder_name').val("");
                        $('#create_folder').hide();
                        folder_id = data['id'];
                        institution_id = data['institution_id'];
                        console.log(data);
                        $('#folder_id').load('/get-folder-list/' + folder_id + '/' + institution_id);
                        $("#create_folder_check_box").prop("checked", false);

                    }
                }
            });


        });

    })

</script>

{{--Get folder name on type--}}

<script>


    $(document).ready(function () {

        @if(isset($edits))
            $inst_id ={{$edits->related_institution_id}};
            $folder_id ={{$edits->folder_id}};
        @elseif(isset($incomingDocument))
            $inst_id ={{$incomingDocument->sender_institution_id}};
            $folder_id ={{$incomingDocument->folder_id}};
        @elseif(isset($outgoingDocument))
            $inst_id ={{$outgoingDocument->institution_id}};
            $folder_id ={{$outgoingDocument->folder_id}};
        @elseif(isset($document))
                @if($document->related_institution_id!=null)
                    $inst_id ={{$document->related_institution_id}};
                        @else
                            $inst_id ={{$document->institution_id}};
                @endif
            $folder_id ={{$document->folder_id}};

        @endif

        $('#folder_id').load('/get-folder-list/' + $folder_id + '/' + $inst_id);


    })
</script>

{{--//change the folde name according to the institution--}}
<script>
    $(document).ready(function () {
        $('#related_institution_id').on('change', function () {
            institution_id = $('#related_institution_id').val();

            $('#folder_institution_id').val(institution_id).change();
            folder_id = 0;
            // $('#folder_id').remove();
            $('#folder_id').load('/get-folder-list/' + folder_id + '/' + institution_id);

        });

    })
</script>