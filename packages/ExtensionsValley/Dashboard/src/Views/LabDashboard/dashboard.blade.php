@extends('Dashboard::dashboard.dashboard')
@section('content-header')

<!-- Navigation Starts-->
@include('Dashboard::dashboard.partials.headersidebar')
@include('Dashboard::extension.bootstrap_datetimepicker_css')
<!-- Navigation Ends-->
{!! Html::style('packages/extensionsvalley/dashboard/css/LabDasboard.css?'.config('tia.asset_version')) !!}
{!! Html::style('packages/extensionsvalley/dashboard/css/admin.min.css?'.config('tia.asset_version')) !!}
{!! Html::style('packages/extensionsvalley/dashboard/css/bootstrap_3.min.css?'.config('tia.asset_version')) !!}
{!! Html::script('packages/extensionsvalley/dashboard/js/LabDashboard.js?'.config('tia.asset_version')) !!}
{!! Html::style('packages/extensionsvalley/dashboard/js/toaster/toastr.css?'.config('tia.asset_version')) !!}
{!! Html::script('packages/extensionsvalley/dashboard/js/toaster/toastr.min.js?'.config('tia.asset_version')) !!}
@include('Dashboard::extension.bootstrap_datetimepicker_js')
@stop
@section('content-area')

<!-- page content -->
<div class="modal fade" id="add_patientmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
    <div class="modal-dialog" style="max-width: 900px;width: 100%">
        <div class="modal-content">
            <div class="modal-header" style="background: #0886a5; color: #FFFFFF;">
                <button type="button" class="close close_white"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size: 30px;">&times;</span></button>
                <h4 class="modal-title">Add Patient</h4>
            </div>
            <div class="modal-body">
                <div id="add_patientmodel_div"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loadSelecteddatamodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:none;">
    <div class="modal-dialog" style="max-width: 1000px;width: 100%">
        <div class="modal-content">
            <div class="modal-header" style="background: #0886a5; color: #FFFFFF;">
                <button type="button" class="close close_white"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="font-size: 30px;">&times;</span></button>
                <h4 class="modal-title">Order Summary</h4>
            </div>
            <div class="modal-body" id="loadPatientDataDiv">


            </div>
        </div>
    </div>
</div>


<div class="right_col"  role="main">
    <input type="hidden" value='{{ csrf_token() }}' id="hidden_filetoken">
    <input type="hidden" value='<?= $route_data ?>' id="route_value">
    <input type="hidden" value='' id="patientid_hidden">
    <input type="hidden" value='' id="orderid_hidden">
    <div class="row padding_sm">

        <div class="col-md-7 padding_sm" style="margin-top: -10px;">
            <div class="col-md-12 padding_sm">
                <h5 class="text-black text-center" id="dropselected_patientdetalis"></h5>
            </div>
            <div class="col-md-6 padding_sm">
                <div class="panel panel-default padding_sm" style="min-height:550px;">
                    <div class="panel-heading">

                        <div id="search_frequent_tests" class="tab-pane active">
                            <div class="clearfix"></div>
                            <div class="h10"></div>
                            <div class="custom-float-label-control" id="frequent_testdiv">

                            </div>
                        </div>
                        <div id="search_patients_labs" class="tab-pane">
                            <div class="clearfix"></div>
                            <div class="h10"></div>
                            <div class="custom-float-label-control" id="frequent_labdiv">

                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="h10"></div>

                        <div class="custom-float-label-control">
                            <label class="custom_floatlabel">Search Tests</label>
                            <input id="search_tests" onkeyup="searchalltests()" class="form-control custom_floatinput" type="text" autocomplete="off">
                            <ul id="searchalltestlist" class="drop txtbx medDivStyle" style="overflow:auto; margin-top:0px; max-height:200px;display:none;"></ul>
                        </div>
                        <div class="clearfix"></div>
                        <div class="h10"></div>
                        <div class="col-md-12 padding_sm" id="search_testresult_div">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 padding_sm">
                <div class="panel panel-default padding_sm" style="min-height:550px;">
                    <div class="panel-heading">
                        <div class="col-md-12 padding_sm">

                            <div class="col-md-8 padding_sm">
                                <div class="custom-float-label-control">
                                    <table class="table table_sm no-border" style="border-collapse: collapse;">
                                        <tbody>
                                            <tr>
                                                <td><strong>PATIENT NAME</strong></td>
                                                <td><strong>:</strong></td>
                                                <td id="seleted_patient_nametd">NA</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Patient ID</strong></td>
                                                <td><strong>:</strong></td>
                                                <td id="seleted_patient_id">NA</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone </strong></td>
                                                <td><strong>:</strong></td>
                                                <td id="seleted_patient_phone">NA</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4 padding_sm">
                                <div class="custom-float-label-control">
                                    <button class="btn bg-teal-active btn-block" onclick="saveLoadSampleData(2)" title="" id="makeas_draftsbtn" style="padding: 0px 0px;" >Draft <i id="makeas_draftsspin" class="fa fa-save"></i></button>
                                </div>
                                <div class="custom-float-label-control">
                                    <button class="btn bg-purple btn-block" onclick="loadSelectedResults()" title="" id="load_resultbtn" style="padding: 0px 0px;" >Continue <i id="load_resultspin" class="fa fa-sign-in"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="nav-tabs-custom no-padding">
                            <ul class="nav nav-tabs primary_nav">
                                <li class="active"><a data-toggle="tab" href="#search_patients_navtab"> Search Patients </a></li>
                                <li id="icd_fav_li"> <a data-toggle="tab" href="#latest_patients_navtab">Latest Patients</a></li>
                            </ul>

                            <div class="tab-content padding_sm">
                                <div id="search_patients_navtab" class="tab-pane active" style="min-height: 100px">
                                    <div class="col-md-12 padding_sm">
                                        <div class="clearfix"></div>
                                        <div class="h10"></div>
                                        <div class="col-md-4 padding_sm">
                                            <div class="custom-float-label-control">
                                                <div class="custom-float-label-control">
                                                    <label class="custom_floatlabel">Patient Name</label>
                                                    <input id="search_allpatientspat_name" onkeyup="searchallpatients('pat_name')" class="form-control custom_floatinput" type="text" autocomplete="off">
                                                    <ul id="searchallpatientlistpat_name" class="drop txtbx medDivStyle" style="overflow:auto; margin-top:0px; max-height:200px;display:none;"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 padding_sm">
                                            <div class="custom-float-label-control">
                                                <div class="custom-float-label-control">
                                                    <label class="custom_floatlabel">Patient ID</label>
                                                    <input id="search_allpatientspat_id" onkeyup="searchallpatients('pat_id')" class="form-control custom_floatinput" type="text" autocomplete="off">
                                                    <ul id="searchallpatientlistpat_id" class="drop txtbx medDivStyle" style="overflow:auto; margin-top:0px; max-height:200px;display:none;"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 padding_sm">
                                            <div class="custom-float-label-control">
                                                <div class="custom-float-label-control">
                                                    <label class="custom_floatlabel"> Patient Phone</label>
                                                    <input id="search_allpatientspat_phone" onkeyup="searchallpatients('pat_phone')" class="form-control custom_floatinput" type="text" autocomplete="off">
                                                    <ul id="searchallpatientlistpat_phone" class="drop txtbx medDivStyle" style="overflow:auto; margin-top:0px; max-height:200px;display:none;"></ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 padding_sm">
                                            <div class="custom-float-label-control">
                                                <button class="btn btn-success btn-block" onclick="addPatient()" title="" id="add_patient" style="padding: 2px 5px;" >Add New Patient <i id="add_patient_spin" class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="latest_patients_navtab" class="tab-pane">
                                    <div class="clearfix"></div>
                                    <div class="h10"></div>
                                    <div class="custom-float-label-control" id="latest_patients_list_div">>


                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-md-12 no-padding"  style="display: none" id="selected_testshowdiv">
                            <div class="panel panel-warning" style="min-height: 270px;">
                                <div class="panel-heading">
                                    <div class="custom-float-label-control">
                                        <label class="custom_floatlabel">Selected Tests</label>
                                        <div class="theadscroll" style="position: relative; height: 30vh;">
                                            <div id="show_mapped_test_lab"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-5 padding_sm">
            <div class="panel panel-default padding_sm" style="min-height:550px;">
                <div class="panel-heading">
                    <div class="col-md-12 padding_sm">
                        <div class="custom-float-label-control">
                            <label class="custom_floatlabel">Order List</label>
                        </div>
                    </div>
                    <div class="col-md-3 padding_sm">
                        <div class="custom-float-label-control">
                            <label class="custom_floatlabel">From Date</label>
                            <input id="patient_fromdate" onblur="seach_patientorders()"  class="form-control custom_floatinput date_floatinput" value="<?= $current_date ?>" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3 padding_sm">
                        <div class="custom-float-label-control">
                            <label class="custom_floatlabel">To Date</label>
                            <input id="patient_todate" onblur="seach_patientorders()" class="form-control custom_floatinput date_floatinput" value="<?= $current_date ?>" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3 padding_sm">
                        <div class="custom-float-label-control">
                            <label class="custom_floatlabel">Patient ID</label>
                            <input id="searchpatient_id" class="form-control custom_floatinput" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-3 padding_sm">
                        <div class="custom-float-label-control">
                            <label class="custom_floatlabel">Sample ID</label>
                            <input id="patient_sampleid" class="form-control custom_floatinput" type="text" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 padding_sm">
                        <div class="custom-float-label-control">
                            <div class="checkbox checkbox-danger no-margin inline">
                                <input type="checkbox" checked="" name="sample_searchcheck" id="sampledraft_searchcheck" onclick="seach_patientorders()" data-toggle="checkbox">
                                <label for="sampledraft_searchcheck"> <span class="text-red"> Draft</span>
                                </label>
                            </div>
                            <div class="checkbox checkbox-primary no-margin inline">
                                <input type="checkbox" checked="" name="sample_searchcheck" id="samplecollected_searchcheck" onclick="seach_patientorders()"   data-toggle="checkbox">
                                <label for="samplecollected_searchcheck"><span class="text-blue">  Sample Collected</span>
                                </label>
                            </div>
                            <div class="checkbox checkbox-warning no-margin inline">
                                <input type="checkbox" name="sample_searchcheck" id="sample_received_at_central_lab_searchcheck" onclick="seach_patientorders()"   data-toggle="checkbox">
                                <label for="sample_received_at_central_lab_searchcheck"><span class="text-orange"> Sample Received</span>
                                </label>
                            </div>
                            <div class="checkbox checkbox-success no-margin inline">
                                <input type="checkbox" name="sample_searchcheck" id="sampleresult_ready_searchcheck" onclick="seach_patientorders()"   data-toggle="checkbox">
                                <label for="sampleresult_ready_searchcheck"> <span class="text-green"> Result Ready </span>
                                </label>
                            </div>


                            <button class="btn btn-primary pull-right" onclick="seach_patientorders(0)" title="" id="seach_patientorders_btn" style="padding: 2px 2px; margin-right: 10px;" >Search <i id="seach_patientorders_spin" class="fa fa-search"></i></button>
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
    </div>
</div>

<!-- /page content -->
@stop