@extends('Dashboard::dashboard.dashboard')
@section('content-header')

<!-- Navigation Starts-->
@include('Dashboard::dashboard.partials.headersidebar')
@include('Dashboard::extension.bootstrap_datetimepicker_css')
<!-- Navigation Ends-->
{!! Html::style('packages/extensionsvalley/dashboard/css/LabDasboard.css?'.config('tia.asset_version')) !!}
{!! Html::style('packages/extensionsvalley/dashboard/css/admin.min.css?'.config('tia.asset_version')) !!}
{!! Html::script('packages/extensionsvalley/dashboard/js/fileinput.min.js?'.config('tia.asset_version')) !!}
{!! Html::style('packages/extensionsvalley/dashboard/css/bootstrap_3.min.css?'.config('tia.asset_version')) !!}
{!! Html::style('packages/extensionsvalley/dashboard/js/toaster/toastr.css?'.config('tia.asset_version')) !!}
{!! Html::script('packages/extensionsvalley/dashboard/js/toaster/toastr.min.js?'.config('tia.asset_version')) !!}
{!! Html::script('packages/extensionsvalley/dashboard/js/bootbox/javascript/bootbox.js?'.config('tia.asset_version')) !!}
@include('Dashboard::extension.bootstrap_datetimepicker_js')
@stop
@section('content-area')

<div class="modal fade" id="changedpimagebtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog" style="max-width: 1000px;width: 100%">
        <div class="modal-content">
            <div class="modal-header" style="background: #008D4C; color: #FFFFFF;">
                <button type="button" class="close close_white"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size: 30px;">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Image</h4>
            </div>
            <form action="" id="uploadfileForm" method="post" >
                @csrf
                <div class="modal-body" style="margin-left: 15px">

                    <div class="row">
                        <div class="col-md-12">
                            <label style="padding-top: 10px;">Upload Image</label>
                            <input id="drphoto" class="file" data-show-upload="false" name="drphoto" type="file" >
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save" id="dpimagesavespin"></i> Save</button>

                </div>
            </form>
        </div>
    </div>

</div>


<div class="right_col"  role="main">
    <input type="hidden" value='{{ csrf_token() }}' id="hidden_filetoken">
    <div class="row padding_sm">

        <div class="panel panel-default padding_sm" style="min-height:550px;">
            <div class="panel-heading">
                <div class="col-md-3 padding_sm">
                    <div class="custom-float-label-control">
                        <label class="custom_floatlabel">File Name</label>
                        <input id="file_nameseach" class="form-control custom_floatinput" type="text" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2 padding_sm">
                    <div class="custom-float-label-control">
                        <div class="checkbox checkbox-info inline">
                            <input  type="checkbox" value="true" id="showdeleted_onlycheck" data-toggle="checkbox">
                            <label for="showdeleted_onlycheck">
                                Deleted Only
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 padding_sm">
                    <div class="custom-float-label-control">
                        <button class="btn btn-primary btn-block" onclick="searchDocuments(1)" title="" id="searchDocumentsBtn" style="padding: 2px 2px; margin-right: 10px;" >Search <i id="searchDocumentsSpin" class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-2 padding_sm pull-right">
                    <div class="custom-float-label-control">
                        <button class="btn btn-success btn-block" onclick="add_newfile()" title="" id="add_newfilebtn" style="padding: 2px 2px; margin-right: 10px;" >Add New File <i id="add_newfilespin" class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 padding_sm">
                <div class="custom-float-label-control">
                    <div id="search_patientdiv"></div>
                </div>
            </div>

        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function () {
            $('#menu_toggle').click();
            searchDocuments(1);
        }, 500);
        $("#uploadfileForm").on('submit', function (e) {
            e.preventDefault();
            var file = $('#drphoto').val();
            if (file) {
                var image_vai = dr_image_Validate('drphoto');
                if (image_vai) {
                    var url = '<?= route('extensionsvalley.admin.uploadFiles') ?>';
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $('#dpimagesavespin').removeClass("fa fa-save");
                            $('#dpimagesavespin').addClass("fa fa-spinner fa-spin");
                        },
                        success: function (data) {
                            if (data) {
                                searchDocuments(1);
                                toastr.success("Successfully Uploaded");
                                $("#changedpimagebtn").modal('toggle');
                            } else {
                                toastr.error("Image Size is large please insert a try another.");
                            }
                        },
                        complete: function () {
                            $('#dpimagesavespin').removeClass("fa fa-spinner fa-spin");
                            $('#dpimagesavespin').addClass("fa fa-save");
                        },
                        error: function () {
                            toastr.error("Image Size is large please insert a try another.");
                        }
                    });
                } else {
                    toastr.warning('<strong>File criteria.</strong><br>Extensions: txt,doc,docx,pdf,png,jpeg,jpg,gif<br>Size : Maximum 2 MB');
                }
            } else {
                toastr.warning('Please Upload Any File <br> <strong>File criteria.</strong><br>Extensions: txt,doc,docx,pdf,png,jpeg,jpg,gif<br>Size : Maximum 2 MB');
            }
        });
    });
    function add_newfile() {
        $("#changedpimagebtn").modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function dr_image_Validate(input_id) {
        var fileInput = document.getElementById(input_id);
        var filePath = fileInput.value;
        var allowedExtensions = /(\.txt|\.doc|\.docx|\.pdf|\.png|\.jpeg|\.jpg|\.gif)$/i;
        var file_size = fileInput.size;
        if (!allowedExtensions.exec(filePath) || file_size >= 2048) {
            return false;
        } else {
            return true;
        }

    }

    $(document).on('click', '.pagination li a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        searchDocuments(page);
    });
    function searchDocuments(page_value) {
        var url = '<?= route('extensionsvalley.admin.getDocumentData') ?>';
        var file_token = $('#hidden_filetoken').val();
        var file_name = $('#file_nameseach').val();
        var deleted_only = document.getElementById('showdeleted_onlycheck').checked;
        var param = {_token: file_token, file_name: file_name, deleted_only: deleted_only, page: page_value};
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            data: param,
            beforeSend: function () {
                $('#searchDocumentsBtn').attr('disabled', true);
                $('#searchDocumentsSpin').removeClass('fa fa-search');
                $('#searchDocumentsSpin').addClass('fa fa-spinner fa-spin');
            },
            success: function (data) {
                $('#search_patientdiv').html(data);
            },
            complete: function () {
                $('#searchDocumentsSpin').removeClass('fa fa-spinner fa-spin');
                $('#searchDocumentsSpin').addClass('fa fa-search');
                $('#searchDocumentsBtn').attr('disabled', false);
            }, error: function () {
                toastr.error("Error Please Check Your Internet Connection");
            }
        });
    }

    function delete_uploadedfile(uploaded_id) {
        bootbox.confirm({
            message: "Are you sure delete this file",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-danger'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                if (result)
                {
                    var url = '<?= route('extensionsvalley.admin.deleteDocumentData') ?>';
                    var file_token = $('#hidden_filetoken').val();
                    var param = {_token: file_token, uploaded_id: uploaded_id};
                    $.ajax({
                        type: "POST",
                        url: url,
                        cache: false,
                        data: param,
                        beforeSend: function () {
                            $('#delete_uploadedfilebtn' + uploaded_id).attr('disabled', true);
                            $('#deleted__uploaded_filespin' + uploaded_id).removeClass('fa fa-search');
                            $('#deleted__uploaded_filespin' + uploaded_id).addClass('fa fa-spinner fa-spin');
                        },
                        success: function (data) {
                            if (data) {
                                $('#tableuplodedrow' + uploaded_id).remove();
                                toastr.success("Successfully Removed");
                            } else {
                                $('#delete_uploadedfilebtn' + uploaded_id).removeClass('fa fa-spinner fa-spin');
                                $('#deleted__uploaded_filespin' + uploaded_id).addClass('fa fa-search');
                                $('#deleted__uploaded_filespin' + uploaded_id).attr('disabled', false);
                            }
                        },
                        complete: function () {
                        }, error: function () {
                            toastr.error("Error Please Check Your Internet Connection");
                        }
                    });
                }
            }
        });
    }


</script>

<!-- /page content -->
@stop