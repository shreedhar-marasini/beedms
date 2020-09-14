<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Licenced to: <a href="#">@if(isset($companyLiscenceTo))
                {{$companyLiscenceTo}}@else Youngminds @endif</a>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">Youngminds</a>.</strong> All rights reserved.
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src={{url("lib/jquery/dist/jquery.js")}}></script>
    <!-- Bootstrap 3.3.7 -->
    <script src={{url("lib/bootstrap/dist/js/bootstrap.min.js")}}></script>
    <!-- AdminLTE App -->
    <script src={{url("dist/js/adminlte.min.js")}}></script>
    <script src={{url("dist/js/jquery.jscroll.js")}}></script>

    <script src=></script>

    <script src={{url("lib/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}></script>
    <!-- CK Editor -->
    <script src={{url("lib/ckeditor/ckeditor.js")}}></script>
    <!-- datetimepicker -->
    <script src={{url("lib/datetimepicker/js/bootstrap-datetimepicker.js")}}></script>
    <!-- iCheck 1.0.1 -->
    <script src={{url("plugins/iCheck/icheck.min.js")}}></script>
    <!-- HighChart -->
    <script src={{url("lib/HighCharts/code/js/highcharts.js")}}></script>
    <!-- DataTables -->
    <script src={{url("lib/datatables.net/js/jquery.dataTables.min.js")}}></script>
    <script src={{url("lib/datatables.net-bs/js/dataTables.bootstrap.min.js")}}></script>
    <script src={{url("plugins/bootstrap-toggle/js/bootstrap-toggle.js")}}></script>
    <script src={{url("plugins/token-input/src/jquery.tokeninput.js")}}></script>
    <script src={{url("plugins/select2/dist/js/select2.full.js")}}></script>

    {{--Time Ago for determing the time difference--}}
    <script src="{{url("lib/timeago/timeago.js")}}"></script>
    <!-- Jquery-confirm -->
    <script src={{url("plugins/Jquery-confirm/js/jquery-fallr-2.0.1.js")}}></script>

    <script type="text/javascript" src="{{url('lib/nepali.datepicker.v2.2/nepali.datepicker.v2.2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('lib/nepali.datepicker.v2.2')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{url('lib/nepali.datepicker.v2.2/nepali.datepicker.v2.2.min.css')}}"/>
    <script src="{{url('lib/owlcarousel/dist/owl.carousel.min.js')}}"></script>


    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable()
            $('#example3').DataTable()
            $('#example4').DataTable({
                "paging": false,
                "ordering": false,
                "info": false,
                'searching': true,
                'autoWidth': true

            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select').select2();
        });
    </script>

    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        $('#email_date').datepicker({
            autoclose: true
        })
    </script>

    <script>
        //Check box

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        })


        CKEDITOR.on('dialogDefinition', function (ev) {
            // Take the dialog name and its definition from the event
            // data.
            var dialogName = ev.data.name;
            var dialogDefinition = ev.data.definition;

            // Check if the definition is from the dialog we're
            // interested on (the "Table" dialog).
            if (dialogName == 'table') {
                // Get a reference to the "Table Info" tab.
                var infoTab = dialogDefinition.getContents('info');
                txtWidth = infoTab.get('txtWidth');
                txtWidth['default'] = '476px';

            }
        });

        $(function () {


            CKEDITOR.replace('editor1', {

                // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
                // The full preset from CDN which we used as a base provides more features than we need.
                // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
//                toolbar: [
//                    { name: 'document', items: [ 'Print' ] },
//                    { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
//                    { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
//                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
//                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
//                    { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
//                    { name: 'links', items: [ 'Link', 'Unlink' ] },
//                    { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
//                    { name: 'insert', items: [ 'Image', 'Table' ] },
//                    { name: 'tools', items: [ 'Maximize' ] },
//                    { name: 'editing', items: [ 'Scayt' ] }
//                ],

                // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
                // One HTTP request less will result in a faster startup time.
                // For more information check http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.config-cfg-customConfig
                customConfig: '',

                // Sometimes applications that convert HTML to PDF prefer setting image width through attributes instead of CSS styles.
                // For more information check:
                //  - About Advanced Content Filter: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_advanced_content_filter
                //  - About Disallowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_disallowed_content
                //  - About Allowed Content: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_allowed_content_rules
                disallowedContent: 'img{width,height,float}',
                extraAllowedContent: 'img[width,height,align]',

                // Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
                extraPlugins: 'tableresize,uploadimage,uploadfile,justify',

                /*********************** File management support ***********************/
                // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
                // solution with file upload/management capabilities, like for example CKFinder.
                // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_ckfinder_integration

                // Uncomment and correct these lines after you setup your local CKFinder instance.
                // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
                // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                /*********************** File management support ***********************/

                // Make the editing area bigger than default.
                height: 800,

                // An array of stylesheets to style the WYSIWYG area.
                // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
                contentsCss: ['https://cdn.ckeditor.com/4.8.0/full-all/contents.css', '/css/mystyles.css'],

                // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
                bodyClass: 'document-editor',

                // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
                format_tags: 'p;h1;h2;h3;pre',

                // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
                removeDialogTabs: 'image:advanced;link:advanced',

                // Define the list of styles which should be available in the Styles dropdown list.
                // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
                // (and on your website so that it rendered in the same way).
                // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
                // that file, which means one HTTP request less (and a faster startup).
                // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles
                stylesSet: [
                    /* Inline Styles */
                    {name: 'Marker', element: 'span', attributes: {'class': 'marker'}},
                    {name: 'Cited Work', element: 'cite'},
                    {name: 'Inline Quotation', element: 'q'},

                    /* Object Styles */
                    {
                        name: 'Special Container',
                        element: 'div',
                        styles: {
                            padding: '5px 10px',
                            background: '#eee',
                            border: '1px solid #ccc'
                        }
                    },
                    {
                        name: 'Compact table',
                        element: 'table',
                        attributes: {
                            cellpadding: '5',
                            cellspacing: '0',
                            border: '1',
                            bordercolor: '#ccc',
                            width: '475px',
                        },
                        styles: {
                            'border-collapse': 'collapse'
                        }
                    },
                    {
                        name: 'Borderless Table',
                        element: 'table',
                        styles: {'border-style': 'hidden', 'background-color': '#E6E6FA'}
                    },
                    {name: 'Square Bulleted List', element: 'ul', styles: {'list-style-type': 'square'}}
                ]
            });


            //bootstrap WYSIHTML5 - text editor
//            $('.textarea').wysihtml5()
        });

        $(document).ready(function () {
            $('#notification_link').onclick(function () {


            })
        })

        {{--</script>--}}

        {{--<script type="text/javascript">--}}
        {{--var clicked = function(){--}}
        {{--alert('congrats, you\'ve deleted internet');--}}
        {{--$.fallr('hide');--}}
        {{--};--}}
        {{--$( ".test" ).click(function() {--}}
        {{--$.fallr.show({--}}
        {{--buttons : {--}}
        {{--button1 : {text: 'Yes', danger: false},--}}
        {{--button2 : {text: 'Cancel'}--}}
        {{--},--}}
        {{--content : '<p>Are you sure you want to delete internet?</p>',--}}
        {{--icon    : 'error',--}}
        {{--position:'center'--}}
        {{--});--}}
        {{--});--}}
        {{--</script>--}}
        {{--<script>--}}
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("scrollBtn").style.display = "block";
            } else {
                document.getElementById("scrollBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        $(".datepicker").datepicker({});
    </script>
    <script>
        $('#search_field').on('input', function (event) {
            event.preventDefault();
            $searchData = $('#search_field').val();
            $("#searchTagList").load("/configurations/tag/list" + '/' + $searchData)
            $("#search_field").unbind("input");

        });
    </script>
</footer>