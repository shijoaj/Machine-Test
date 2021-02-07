<div class="row">
    <div class="col-md-4 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Name *</label>
            <input id="patient_name" class="form-control custom_floatinput" type="text" autocomplete="off">
        </div>
    </div>
    <div class="col-md-4 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Gender</label>
            <div class="custom-float-label-control" style="padding-top: 10px">
                <div class="radio radio-primary no-margin inline">
                    <input type="radio" name="patient_gender" value="1" id="patient_male"  data-toggle="radio">
                    <label for="patient_male">
                        Male
                    </label>
                </div>
                <div class="radio radio-primary no-margin inline">
                    <input type="radio" name="patient_gender" value="2" id="patient_female"  data-toggle="radio">
                    <label for="patient_female">
                        Female
                    </label>
                </div>
                <div class="radio radio-primary no-margin inline">
                    <input type="radio" name="patient_gender" value="3" id="patient_other"  data-toggle="radio">
                    <label for="patient_other">
                        Other
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Phone *</label>
            <input id="patient_phone" class="form-control custom_floatinput" type="text" autocomplete="off">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="h10"></div>
    <div class="col-md-4 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Age In</label>
            <div class="custom-float-label-control" style="padding-top: 10px">
                <div class="radio radio-info no-margin inline">
                    <input type="radio" name="patient_agetype" value="1" id="patient_agedays"  data-toggle="radio">
                    <label for="patient_agedays">
                        Days
                    </label>
                </div>
                <div class="radio radio-info no-margin inline">
                    <input type="radio" name="patient_agetype" value="2" id="patient_agemonths"  data-toggle="radio">
                    <label for="patient_agemonths">
                        Months
                    </label>
                </div>
                <div class="radio radio-info no-margin inline">
                    <input type="radio" checked="" name="patient_agetype" value="3" id="patient_ageyears"  data-toggle="radio">
                    <label for="patient_ageyears">
                        Years
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Age *</label>
            <input id="patient_age" class="form-control custom_floatinput" type="text" autocomplete="off">
        </div>
    </div>
    <div class="col-md-2 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Patient ID *</label>
            <input id="patient_referenceno" class="form-control custom_floatinput" type="text" autocomplete="off">
        </div>
    </div>
    <div class="col-md-4 padding_sm">
        <div class="custom-float-label-control">
            <label class="custom_floatlabel">Email</label>
            <input id="patient_email" class="form-control custom_floatinput" type="text" autocomplete="off">
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="h10"></div>
<div class="modal-footer">
    <button type="button" style="padding: 3px 4px" class="btn btn-danger" data-dismiss="modal" onclick="">Close</button>
    <button class="btn btn-primary" onclick="savePatient()" style="padding: 3px 4px" id="savepatientbtn">Save <i id="savepatientspin" class="fa fa-save"></i></button>
</div>

