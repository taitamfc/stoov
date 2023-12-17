@extends('layout.main')
@section('content')
<section>
    <div class="container-fluid"><span id="general_result"></span></div>
    <div class="container-fluid mb-3">
        <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i> {{__('Add Email Setting')}}</button>
    </div>
    <div class="table-responsive">
        <table id="table" class="table ">
            <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{ __('Onderwerp') }}</th>
                    <th>{{ __('Event') }}</th>
                    <th>{{ __('Action') }}</th>
                </tr>
            </thead>

        </table>
    </div>
</section>
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title">{{__('Add Mail Setting')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="_id">
                    <input type="hidden" name="_method" id="_method">
                    @csrf
                    <div class="row">
                        <div class="row col-12 form-box">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-bold">{{ __('Event') }} <span class="text-danger">(Verplicht)</span></label>
                                    <select name="type" id="type" required class="form-control dynamic">
                                        @foreach( \App\EmailSetting::TYPES_LIST as $type)
                                        <option value="{{ $type }}">{{ @__(\App\EmailSetting::TYPE_NAMES_LIST[$type]) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 form-group" id="input_admin_email">
                                <label class="text-bold">{{__('Versturen naar e-mailadres')}}</label>
                                <input type="text" name="admin_email" id="admin_email" placeholder="{{__('Versturen naar e-mailadres')}}" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Knop tekst')}}</label>
                                <input type="text" name="button_text" id="button_text" placeholder="{{__('Knop tekst')}}" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('CC')}}</label>
                                <input type="text" name="cc_email" id="cc_email" placeholder="{{__('CC')}}" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('BBC')}}</label>
                                <input type="text" name="bcc_email" id="bcc_email" placeholder="{{__('BBC')}}" class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Onderwerp')}} <span class="text-danger">(Verplicht)</span></label>
                                <input type="text" name="subject" id="subject" placeholder="{{__('Onderwerp')}}" required class="form-control">
                            </div>
                            <div class="col-md-12 form-group">
                                <label class="text-bold">{{__('Bericht')}} <span class="text-danger">(Verplicht)</span></label>
                                <p id="text_suggest">::organisatie || ::email || ::depcription</p>
                                <textarea name="content" id="content" placeholder="{{__('Inhoud')}}" class="form-control des-editor"></textarea>
                            </div>
                        </div>

                        <div class="container">
                            <div class="form-group" align="center">
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning w-100" value="{{__('Add')}}" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{__('Confirmation')}}</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">{{__('Are you sure you want to remove this data?')}}</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{__('OK')}}</button>
                <button type="button" class="close btn-default" data-dismiss="modal">{{__('Cancel')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    // The DOM element you wish to replace with Tagify
    var ccEmailInput = document.querySelector('input[name=cc_email]');
    var bccEmailInput = document.querySelector('input[name=bcc_email]');
    // initialize Tagify on the above input node reference
    new Tagify(ccEmailInput, {
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
        pattern: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gm 
    });
    new Tagify(bccEmailInput, {
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
        pattern: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/gm 
    });
    const formatDate = "{{ env('Date_Format_JS ')}}";
    const menu = "_MENU_ {{__('records per page ')}}";
    $(document).ready(function() {
        if (window.location.href.indexOf('#formModal') != -1) {
            $('#formModal').modal('show');
        }
        var date = $('.date');
        date.datepicker({
            format: formatDate,
            autoclose: true,
            todayHighlight: true
        });

        var table_table = $('#table').DataTable({
            initComplete: function() {},
            responsive: false,
            fixedHeader: {
                header: true,
                footer: true
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('email_settings.index') }}",
                type: 'GET',
                data: function(d) {
                    if ($("#company_id_filter").val() !== '') {
                        d.company_id = $("#company_id_filter").val();
                    }
                }
            },

            columns: [{
                    data: 'id',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'subject',
                    name: 'subject',
                },
                {
                    data: 'type',
                    name: 'type',
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ],
            "order": [],
            'language': {
                'lengthMenu': menu,
                "info": '{{__("Showing")}} _START_ - _END_ (_TOTAL_)',
                "search": '{{__("Search")}}',
                'paginate': {
                    'previous': '{{__("Previous")}}',
                    'next': '{{__("Next")}}'
                }
            },
            'columnDefs': [{
                    "orderable": false,
                    'targets': [0, 1],
                    "className": "text-left"
                },
                {
                    'render': function(data, type, row, meta) {
                        if (type == 'display') {
                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>';
                        }

                        return data;
                    },
                    'checkboxes': {
                        'selectRow': true,
                        'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label class="text-bold"></label></div>'
                    },
                    'targets': [0]
                }
            ],


            'select': {
                style: 'multi',
                selector: 'td:first-child'
            },
            'lengthMenu': [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            dom: '<"row"lfB>rtip',
            buttons: [],
        });
        new $.fn.dataTable.FixedHeader(table_table);
    });


    //-------------- Filter -----------------------

    $('#filterSubmit').on("click", function(e) {
        $('#table').DataTable().draw(true);
    });
    //--------------/ Filter ----------------------

    $('#create_record').click(function() {
        $('.modal-title').text("{{__('Add Email Setting')}}");
        $('#action_button').val("{{__('Add')}}");
        $('#action').val("{{__('Add')}}");
        $('#formModal').modal('show');
        fillDataForm({});
    });

    $('#sample_form').on('submit', function(event) {
        event.preventDefault();
        setTimeout(() => {
            let id = $("#_id").val();
            $.ajax({
                url: "{{ route('email_settings.store') }}/" + id,
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }
                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        // $('#sample_form')[0].reset();
                        $('select').selectpicker('refresh');
                        $('.date').datepicker('update');
                        $('#table').DataTable().ajax.reload();
                        // $('#formModal').modal('hide');
                    }
                    $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }
            });
        })

    });

    let delete_id;

    $(document).on('click', '.delete', function() {
        delete_id = $(this).attr('id');
        $('#confirmModal').modal('show');
        $('.modal-title').text("{{__('DELETE Record ')}}");
        $('#ok_button').text("{{__('OK ')}}");
    });

    $('#ok_button').click(function() {
        let target = "{{ route('email_settings.index') }}/" + delete_id + '/delete';
        $.ajax({
            url: target,
            beforeSend: function() {
                $('#ok_button').text("{{__('Deleting...')}}");
            },
            success: function(data) {
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                }
                if (data.error) {
                    html = '<div class="alert alert-danger">' + data.error + '</div>';
                }
                setTimeout(function() {
                    $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                    $('#confirmModal').modal('hide');
                    $('#table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });
    //-------------- EDIT -----------------------
    $(document).on("click", "a.btn-edit", function() {
        $('.modal-title').text("{{__('Edit Email Setting')}}");
        $('#action_button').val("{{__('Edit')}}");
        $('#action').val("{{__('Edit')}}");
        $('#formModal').modal('show');
        callAjaxShowDetail($(this).attr("data-id"))
        handleCheckShowHideAdminEmail()
    });
    //--------------/ EDIT -----------------------

    function callAjaxShowDetail(id) {
        $.ajax({
            url: "{{ route('email_settings.index') }}/" + id,
            beforeSend: function() {
                $("#action_button").attr("disabled", true);
            },
            success: function(data) {
                fillDataForm(data.data)
            }
        })
    }

    function fillDataForm(data) {
        $("#type").val(data.type ?? "{{ \App\EmailSetting::TYPE_VERLETVERGOEDING }}");
        $("#subject").val(data.subject ?? '');
        let textDecode = data.content ? htmlDecode(data.content) : '';
        tinymce.get('content').setContent(textDecode, {
            format: 'raw'
        });
        $("#admin_email").val(data.admin_email ?? '');
        $("#button_text").val(data.button_text ?? '');
        $("#cc_email").val(data.cc_email ?? '');
        $("#bcc_email").val(data.bcc_email ?? '');
        $("#_id").val(data.id ?? '');
        $("#_method").val(data.id ? 'put' : 'post');
        setTimeout(() => {
            $("#action_button").removeAttr("disabled");
        })
    }

    function htmlDecode(input) {
        var e = document.createElement('div');
        e.innerHTML = input;
        return e.childNodes[0].nodeValue ?? null;
    }

    let verletvergoedingSuggest = JSON.parse('{!! json_encode($verletvergoedingSuggest) !!}')
    let opleidingsvergoedingSuggest = JSON.parse('{!! json_encode($opleidingsvergoedingSuggest) !!}')
    let loonsomopgaveSuggest = JSON.parse('{!! json_encode($loonsomopgaveSuggest) !!}')
    let text = "";
    renderHtmlSuggest(text, verletvergoedingSuggest)
    $("#type").on( "change", function() {
        $('#text_suggest').html("")
        let text = "";
        let value = Number($(this).val());
        if ([1,4,5,10].indexOf(value) != -1) {
            renderHtmlSuggest(text, verletvergoedingSuggest)
        } else if ([2,6,7,11].indexOf(value) != -1) {
            renderHtmlSuggest(text, opleidingsvergoedingSuggest)
        } else if ([3,8,9,12].indexOf(value) != -1) {
            renderHtmlSuggest(text, loonsomopgaveSuggest)
        }

        handleCheckShowHideAdminEmail()
    });

    function handleCheckShowHideAdminEmail() {
        let value = Number($("#type").val());
        if ([5,7,9].indexOf(value) != -1) {
            $("#input_admin_email").hide();
            $("#admin_email").val("");
        } else {
            $("#input_admin_email").show();
        }
    }

    function renderHtmlSuggest(text, array) {
        array.forEach((item, index) => {
            text += `::${item} `; 
        })
        $('#text_suggest').html(text)
    }

    tinymce.init({
        selector: '.des-editor',
        setup: function(editor) {
            editor.on('init', function() {
                editor.save();
            });
        },
        height: 300,

        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function(cb, value, meta) {
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
              Note: In modern browsers input[type="file"] is functional without
              even adding it to the DOM, but that might not be the case in some older
              or quirky browsers like IE, so you might want to add it to the DOM
              just in case, and visually hide it. And do not forget do remove it
              once you do not need it anymore.
            */

            input.onchange = function() {
                let file = this.files[0];

                let reader = new FileReader();
                reader.onload = function() {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    let id = 'blobid' + (new Date()).getTime();
                    let blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    let base64 = reader.result.split(',')[1];
                    let blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },

        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        branding: false
    });
</script>
@endpush