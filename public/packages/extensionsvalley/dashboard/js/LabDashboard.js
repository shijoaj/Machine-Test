$(document).ready(function () {
    $('.date_floatinput').datetimepicker({
        format: 'MMM-DD-YYYY'
    });

    setTimeout(function () {
        $('#menu_toggle').click();
    }, 1000);

    var route_value = $('#route_value').val();
    var decode_route = atob(route_value);
    route_json = JSON.parse(decode_route);
    getFrequentData('tests');
    getFrequentData('lab');
    seach_patientdata(0);
    seach_patientorders(0);
});

mapLabTest = {};
freq_dataarray = {};

$(document).on('click', '.pagination li a', function (event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    seach_patientdata(page);
});

$(document).on('click', '.pagination li a', function (event) {
    event.preventDefault();
    var page_orders = $(this).attr('href').split('page=')[1];
    seach_patientorders(page_orders);
});

$(document).on('click', '.select_button li', function () {
    $(this).toggleClass('active');
});

function getFrequentData(from_type) {
    var url = route_json.getFrequentData;
    var file_token = $('#hidden_filetoken').val();
    var param = {_token: file_token, from_type: from_type};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('#add_patient').attr('disabled', true);
            $('#add_patient_spin').removeClass('fa fa-plus');
            $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            if (from_type == 'lab') {
                $('#frequent_labdiv').html(data);
            } else if (from_type == 'tests') {
                $('#frequent_testdiv').html(data);
            }
        },
        complete: function () {
            $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
            $('#add_patient_spin').addClass('fa fa-plus');
            $('#add_patient').attr('disabled', false);
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}

function addPatient() {
    var url = route_json.AddLabPatient;
    var file_token = $('#hidden_filetoken').val();
    var param = {_token: file_token};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('#add_patient').attr('disabled', true);
            $('#add_patient_spin').removeClass('fa fa-plus');
            $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            $("#add_patientmodel_div").html(data);
            $("#add_patientmodel").modal({
                backdrop: 'static',
                keyboard: false
            });
        },
        complete: function () {
            $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
            $('#add_patient_spin').addClass('fa fa-plus');
            $('#add_patient').attr('disabled', false);
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}

function savePatient() {
    var url = route_json.SavePatient;
    var file_token = $('#hidden_filetoken').val();
    var patient_name = $('#patient_name').val();
    var patient_phone = $('#patient_phone').val();
    var age = $('#patient_age').val();
    var email = $('#patient_email').val();
    var referenceno = $('#patient_referenceno').val();
    var gender = $('input[name="patient_gender"]:checked').val();
    var agetype = $('input[name="patient_agetype"]:checked').val();
    var insert_flag = 1;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email)
    {
        if (!email.match(mailformat)) {
            insert_flag = 0;
        }
    } else {
        insert_flag = 1;
    }

    if (patient_name) {
        if (gender) {
            if (patient_phone) {
                if (age) {
                    if (referenceno) {
                        if (insert_flag == 1) {
                            var param = {_token: file_token, referenceno: referenceno, patient_name: patient_name, patient_phone: patient_phone, age: age, email: email, gender: gender, agetype: agetype};
                            $.ajax({
                                type: "POST",
                                url: url,
                                cache: false,
                                data: param,
                                beforeSend: function () {
                                    $('#add_patient').attr('disabled', true);
                                    $('#add_patient_spin').removeClass('fa fa-list-alt');
                                    $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
                                },
                                success: function (data) {
                                    if (data) {
                                        $("#add_patientmodel").modal('toggle');
                                        searchedPatientClick(patient_name, patient_phone, data, 1)
                                        toastr.success("Patient Successfully Inserted");
                                        toastr.warning("Patient ID :" + data);
                                    } else {
                                        toastr.error("Error Please Check Your Internet Connection");
                                    }

                                },
                                complete: function () {
                                    $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
                                    $('#add_patient_spin').addClass('fa fa-list-alt');
                                    $('#add_patient').attr('disabled', false);
                                }, error: function () {
                                    toastr.error("Error Please Check Your Internet Connection");
                                }
                            });
                        } else {
                            toastr.warning("Invalid Email Format");
                            $('#patient_email').focus();
                        }
                    } else {
                        toastr.warning("Please Enter Reference Number");
                        $('#patient_referenceno').focus();
                    }
                } else {
                    toastr.warning("Please Enter Age");
                    $('#patient_age').focus();
                }
            } else {
                toastr.warning("Please Enter Patient Phone");
                $('#patient_phone').focus();
            }
        } else {
            toastr.warning("Please Enter Patient Gender");
        }
    } else {
        toastr.warning("Please Enter Patient Name");
        $('#patient_name').focus();
    }

}

function seach_patientdata(page_value) {
    var url = route_json.SearchPatient;
    var file_token = $('#hidden_filetoken').val();
    var from_date = $('#patient_fromdate').val();
    var pat_id = $("#patientid_hidden").val();
    var to_date = $('#patient_todate').val();
    var sampleid = $('#patient_sampleid').val();
    var patient_id = $('#searchpatient_id').val();
    var param = {_token: file_token, pat_id: pat_id, page: page_value, from_date: from_date, to_date: to_date, patient_id: patient_id, sampleid: sampleid};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('#seach_patientdata_btn').attr('disabled', true);
            $('#seach_patientdata_spin').removeClass('fa fa-search');
            $('#seach_patientdata_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            $("#latest_patients_list_div").html(data);
        },
        complete: function () {
            $('#seach_patientdata_spin').removeClass('fa fa-spinner fa-spin');
            $('#seach_patientdata_spin').addClass('fa fa-search');
            $('#seach_patientdata_btn').attr('disabled', false);
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}


function searchalltests() {
    var url = route_json.SearchAllTest;
    var file_token = $('#hidden_filetoken').val();
    var test_name = $('#search_tests').val();
    if (test_name)
    {
        var param = {_token: file_token, test_name: test_name};
        $.ajax({
            type: "POST",
            url: url,
            data: param,
            async: true,
            beforeSend: function () {
                $("#searchalltestlist").html('<i class="fa fa-spinner fa-spin"></i>').show();
            },
            success: function (html) {
                $("#searchalltestlist").html(html).show();
            }, error: function () {
                toastr.error("Error Please Check Your Internet Connection");
            }
        });
    } else {
        $("#searchalltestlist").html("");
        $('#searchalltestlist').hide();
    }
}

function searchallpatients(from_type) {
    var url = route_json.SearchAllPatients;
    var file_token = $('#hidden_filetoken').val();
    var search_type = $('#search_allpatients' + from_type).val();
    if (search_type)
    {
        var param = {_token: file_token, from_type: from_type, search_type: search_type};
        $.ajax({
            type: "POST",
            url: url,
            data: param,
            async: true,
            beforeSend: function () {
                $("#searchallpatientlist" + from_type).html('<i class="fa fa-spinner fa-spin"></i>').show();
            },
            success: function (html) {
                $("#searchallpatientlist" + from_type).html(html).show();
            }, error: function () {
                toastr.error("Error Please Check Your Internet Connection");
            }
        });
    } else {
        $("#searchallpatientlist" + from_type).html("");
        $('#searchallpatientlist' + from_type).hide();
    }
}

function searchedTestClick(test_id, test_name) {
    var url = route_json.getSelectedTest;
    var file_token = $('#hidden_filetoken').val();
    var map_string = JSON.stringify(mapLabTest);
    $('#search_tests').val('');
    var param = {_token: file_token, map_string: map_string, test_id: test_id, test_name: test_name};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $("#searchalltestlist").html("");
            $('#searchalltestlist').hide();
            $('#add_patient').attr('disabled', true);
            $('#add_patient_spin').removeClass('fa fa-plus');
            $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            $('#search_testresult_div').html(data);
        },
        complete: function () {
            $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
            $('#add_patient_spin').addClass('fa fa-plus');
            $('#add_patient').attr('disabled', false);
            $('#selected_testshowdiv').show();
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}

function searchedPatientClick(name, phone, patient_id, from_type, load_type) {
    $("#patientid_hidden").val(patient_id);
    if (load_type) {
        $("#searchallpatientlist" + load_type).html("");
        $('#searchallpatientlist' + load_type).hide();
        $('#search_allpatients' + load_type).val('');
    }

    $('#seleted_patient_nametd').html(name);
    $('#seleted_patient_id').html(patient_id);
    $('#seleted_patient_phone').html(phone);
    if (from_type == '1') {
        seach_patientdata(0);
    }
}

function getfrequentdata(from_type, data_id, data_name) {
    var datastring = from_type + ':::' + data_id;
    if ($('#' + from_type + '_data_' + data_id).hasClass('active')) {
        delete freq_dataarray[datastring];
        if (from_type == 'tests') {
            delete mapLabTest[data_id + ':::' + btoa(data_name)];
        }
    } else {
        freq_dataarray[datastring] = data_name;
    }
    var url = route_json.frequentDataClick;
    var file_token = $('#hidden_filetoken').val();
    var map_string = JSON.stringify(freq_dataarray);
    var labarraystring = JSON.stringify(mapLabTest);
    var param = {_token: file_token, labarraystring: labarraystring, map_string: map_string};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('#add_patient').attr('disabled', true);
            $('#add_patient_spin').removeClass('fa fa-plus');
            $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            if (data) {
                var data_array = JSON.parse(data);
                $.each(data_array['test_data'], function (index, element) {
                    mapLabTest[element.test_id + ':::' + btoa(element.test_name)] = element.lab_id + ':::' + btoa(element.lab_name) + ':::' + btoa(element.amount) + ':::' + btoa(element.tat);
                });
                if (data_array['in_data'].length != 0) {
                    toastr.warning("Test Already In Previous Lab");
                }
                getselectedLabTest();
            }
        },
        complete: function () {
            $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
            $('#add_patient_spin').addClass('fa fa-plus');
            $('#add_patient').attr('disabled', false);
            $('#selected_testshowdiv').show();
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });

}

function mapSelectedLabsTest(lab_id, test_id, lab_name, test_name, amount, tat) {
    mapLabTest[test_id + ':::' + test_name] = lab_id + ':::' + lab_name + ':::' + amount + ':::' + tat;
    getselectedLabTest();
}

function getselectedLabTest() {
    var url = route_json.mapSelectedLabsTest;
    var file_token = $('#hidden_filetoken').val();
    var map_string = JSON.stringify(mapLabTest);
    var param = {_token: file_token, map_string: map_string};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('#add_patient').attr('disabled', true);
            $('#add_patient_spin').removeClass('fa fa-plus');
            $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            $('#show_mapped_test_lab').html(data);
            $('#selected_testshowdiv').show();
        },
        complete: function () {
            $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
            $('#add_patient_spin').addClass('fa fa-plus');
            $('#add_patient').attr('disabled', false);
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}


function loadSelectedResults() {
    var patient_id = $("#patientid_hidden").val();
    if (patient_id) {
        var arry_len = Object.keys(mapLabTest).length;
        if (arry_len != 0) {
            var url = route_json.loadSelectedData;
            var file_token = $('#hidden_filetoken').val();
            var map_string = JSON.stringify(mapLabTest);
            var param = {_token: file_token, patient_id: patient_id, map_string: map_string};
            $.ajax({
                type: "POST",
                url: url,
                cache: false,
                data: param,
                beforeSend: function () {
                    $('#add_patient').attr('disabled', true);
                    $('#add_patient_spin').removeClass('fa fa-plus');
                    $('#add_patient_spin').addClass('fa fa-spinner fa-spin');
                },
                success: function (data) {
                    $("#loadPatientDataDiv").html(data);
                    $("#loadSelecteddatamodel").modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                },
                complete: function () {
                    $('#add_patient_spin').removeClass('fa fa-spinner fa-spin');
                    $('#add_patient_spin').addClass('fa fa-plus');
                    $('#add_patient').attr('disabled', false);
                    saveLoadSampleData(2);
                }, error: function () {
                    toastr.error("Error Please Check Your Internet Connection");
                }
            });
        } else {
            toastr.warning("PLease Test And Lab");
        }
    } else {
        toastr.warning("PLease Select Any Patient");
    }
}

function saveLoadSampleData(from_type) {
    var patient_id = $("#patientid_hidden").val();
    if (patient_id) {
        var arry_len = Object.keys(mapLabTest).length;
        if (arry_len != 0) {
            var url = route_json.saveLoadSampleData;
            var file_token = $('#hidden_filetoken').val();
            var map_string = JSON.stringify(mapLabTest);
            var order_id = $('#orderid_hidden').val();
            var param = {_token: file_token, from_type: from_type, patient_id: patient_id, order_id: order_id, map_string: map_string};
            $.ajax({
                type: "POST",
                url: url,
                cache: false,
                data: param,
                beforeSend: function () {
                    if (from_type == '1') {
                        $('#savesampledatabtn').attr('disabled', true);
                        $('#savesampledataspin').removeClass('fa fa-save');
                        $('#savesampledataspin').addClass('fa fa-spinner fa-spin');
                    } else if (from_type == '2') {
                        $('#makeas_draftsbtn').attr('disabled', true);
                        $('#makeas_draftsspin').removeClass('fa fa-save');
                        $('#makeas_draftsspin').addClass('fa fa-spinner fa-spin');
                    }
                },
                success: function (data) {
                    if (data) {
                        if (from_type == '1') {
                            $("#loadSelecteddatamodel").modal('toggle');
                            toastr.success("Updated Successfully");
                            mapLabTest = {};
                            $("#patientid_hidden").val('');
                            $("#orderid_hidden").val('');
                            $("#search_testresult_div").html('');
                            $("#selected_testshowdiv").hide();
                            $("#show_mapped_test_lab").html('');
                            $("#dropselected_patientdetalis").html('');
                            $(".check_box").prop('checked', false);
                            toastr.warning("Order ID :" + data);
                            seach_patientorders(0);
                        } else {
                            toastr.success("Successfully Drafted");
                        }
                    } else {
                        toastr.error("Error Please Check Your Internet Connection");
                    }

                },
                complete: function () {
                    if (from_type == '1') {
                        $('#savesampledataspin').removeClass('fa fa-spinner fa-spin');
                        $('#savesampledataspin').addClass('fa fa-save');
                        $('#savesampledatabtn').attr('disabled', false);
                    } else if (from_type == '2') {
                        $('#makeas_draftsspin').removeClass('fa fa-spinner fa-spin');
                        $('#makeas_draftsspin').addClass('fa fa-save');
                        $('#makeas_draftsbtn').attr('disabled', false);
                    }

                }, error: function () {
                    toastr.error("Error Please Check Your Internet Connection");
                }
            });
        } else {
            toastr.warning("PLease Test And Lab");
        }
    } else {
        toastr.warning("PLease Select Any Patient");
    }
}

function seach_patientorders(page_value) {
    var url = route_json.seachPatientOrders;
    var file_token = $('#hidden_filetoken').val();
    var from_date = $('#patient_fromdate').val();
    var to_date = $('#patient_todate').val();
    var sampleid = $('#patient_sampleid').val();
    var patient_id = $('#searchpatient_id').val();
    var sample_draft = $('#sampledraft_searchcheck').is(":checked");
    var sample_collected = $('#samplecollected_searchcheck').is(":checked");
    var sample_received = $('#sample_received_at_central_lab_searchcheck').is(":checked");
    var result_ready = $('#sampleresult_ready_searchcheck').is(":checked");
    var param = {_token: file_token, sample_draft: sample_draft, sample_collected: sample_collected, result_ready: result_ready, sample_received: sample_received, page: page_value, from_date: from_date, to_date: to_date, patient_id: patient_id, sampleid: sampleid};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('#seach_patientorders_btn').attr('disabled', true);
            $('#seach_patientorders_spin').removeClass('fa fa-search');
            $('#seach_patientorders_spin').addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            $("#search_patientdiv").html(data);
        },
        complete: function () {
            $('#seach_patientorders_spin').removeClass('fa fa-spinner fa-spin');
            $('#seach_patientorders_spin').addClass('fa fa-search');
            $('#seach_patientorders_btn').attr('disabled', false);
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}

function editPatientorder(head_id, name, phone, patient_id) {
    mapLabTest = {};
    $('#orderid_hidden').val(head_id);
    var url = route_json.editPatientOrders;
    var file_token = $('#hidden_filetoken').val();
    var param = {_token: file_token, patient_id: patient_id, head_id: head_id};
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data: param,
        beforeSend: function () {
            $('.edit_patientorderrow').removeClass('bg-info');
            $('#edit_patientorderbtn' + head_id).attr('disabled', true);
            $('#edit_patientorderspin' + head_id).removeClass('fa fa-edit');
            $('#edit_patientorderspin' + head_id).addClass('fa fa-spinner fa-spin');
        },
        success: function (data) {
            if (data) {
                var data_array = JSON.parse(data);
                $.each(data_array, function (index, element) {
                    mapLabTest[element.test_id + ':::' + btoa(element.test_name)] = element.lab_id + ':::' + btoa(element.lab_name) + ':::' + btoa(element.amount) + ':::' + btoa(element.tat);
                });
                getselectedLabTest();
                searchedPatientClick(name, phone, patient_id, 1);
            }
        },
        complete: function () {
            $('#edit_patientorderrow' + head_id).addClass('bg-info');
            $('#edit_patientorderspin' + head_id).removeClass('fa fa-spinner fa-spin');
            $('#edit_patientorderspin' + head_id).addClass('fa fa-edit');
            $('#edit_patientorderbtn' + head_id).attr('disabled', false);
        }, error: function () {
            toastr.error("Error Please Check Your Internet Connection");
        }
    });
}