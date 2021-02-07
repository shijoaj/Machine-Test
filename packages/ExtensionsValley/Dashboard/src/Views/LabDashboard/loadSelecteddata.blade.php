<div class="theadscroll always-visible ps-container ps-theme-default ps-active-y" style="position: relative; height: 450px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <table class="table table_sm no-border" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td><strong>PATIENT NAME</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $patient_name ?></td>
                        <td style="width: 20%;">&nbsp;</td>
                        <td><strong>Age</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $patient_age ?></td>
                    </tr>
                    <tr>
                        <td><strong>Patient ID</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $patient_id ?></td>
                        <td>&nbsp;</td>
                        <td><strong>Phone </strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $patient_phone ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="theadscroll" style="position: relative; height: 40vh;">
                <table  class="table table_sm ">
                    <thead>
                        <tr>
                            <th width="15">Name</th>
                            <th width="55">Test Requirements</th>
                            <th width="15">TAT</th>
                            <th width="15">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_amt = 0;
                        if (count($result) != 0) {
                            foreach ($result as $key => $val) {
                                ?>
                                <tr class="bg-info text-center">
                                    <th colspan="4"><?= base64_decode($key) ?></th>
                                </tr>
                                <?php
                                foreach ($val as $each) {
                                    $each_explode = explode(":::", $each);
                                    $test_name = @$each_explode[0] ? $each_explode[0] : '';
                                    $test_amount = @$each_explode[1] ? $each_explode[1] : 0;
                                    $test_tat = @$each_explode[2] ? $each_explode[2] : 0;
                                    $test_id = @$each_explode[3] ? $each_explode[3] : 0;
                                    $total_amt = $total_amt + intval(base64_decode($test_amount));
                                    ?>
                                    <tr class="">
                                        <td><?= base64_decode($test_name) ?></td>
                                        <td><?= @$test_requrement_desc[$test_id] ? $test_requrement_desc[$test_id] : '' ?></td>
                                        <td><?= base64_decode($test_tat) ?></td>
                                        <td><?= base64_decode($test_amount) ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            <tr>
                                <th style="text-align: right" colspan="3">Total</th>
                                <td><?= $total_amt ?></td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td style="text-align: center">No Result Found</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<div class="h10"></div>
<div class="modal-footer">
    <button type="button" style="padding: 3px 4px" class="btn btn-danger" data-dismiss="modal" onclick="">Close</button>
    <button class="btn btn-primary" onclick="saveLoadSampleData(1)" style="padding: 3px 4px" id="savesampledatabtn">Save <i id="savesampledataspin" class="fa fa-save"></i></button>
</div>