<div class="custom-float-label-control">
    <label class="custom_floatlabel"><?= $test_name ?></label>
    <div class="theadscroll" style="position: relative; height: 50vh;">
        <table  class="table table-condensed table-striped table_sm ">
            <thead>
                <tr>
                    <th width="25%">Lab Name</th>
                    <th width="25%">Amount</th>          
                    <th width="25%">TAT</th>          
                    <th width="25%">Select</th>          
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if (count($result) != 0) {
                        foreach ($result as $each) {
                            $selected = '';
                            $string = $test_id . '::' . $each->lab_id;
                            if (in_array($string, $map_string)) {
                                $selected = "checked";
                            }
                            ?>
                        <tr>
                            <td><?= $each->lab_name ?></td>
                            <td><?= $each->amount ?></td>
                            <td><?= $each->tat ?></td>
                            <td>
                                <div class="radio radio-primary no-margin inline">
                                    <input <?= $selected ?> type="radio" onclick="mapSelectedLabsTest(<?= $each->lab_id ?>,<?= $test_id ?>, '<?= base64_encode($each->lab_name) ?>', '<?= base64_encode($test_name) ?>', '<?= base64_encode($each->amount) ?>', '<?= base64_encode($each->tat) ?>')" name="labselecteddetalis" id="labselecteddetalis<?= $each->lab_id ?>"  data-toggle="radio">
                                    <label for="labselecteddetalis<?= $each->lab_id ?>">
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4" style="text-align: center">No Result Found</td>
                    </tr>
                    <?php
                }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>