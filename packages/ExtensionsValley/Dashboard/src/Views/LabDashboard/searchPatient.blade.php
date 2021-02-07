<div class="theadscroll" style="position: relative; height: 11vh;">
    <table  class="table table-condensed table-striped table_sm ">
        <thead>
            <tr>
                <th width="30%">Patient ID</th>          
                <th width="30%">Name</th>          
                <th width="20%">Phone</th>          
                <th width="10%">-</th>          
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($result) != 0) {
                foreach ($result as $value) {
                    $selected = '';
                    if ($pat_id == $value->patient_id) {
                        $selected = "checked";
                    }
                    ?>
                    <tr>
                        <td><?= $value->reference_no ? $value->reference_no : '-' ?></td>
                        <td><?= $value->patient_name ?></td>
                        <td><?= $value->phone ?></td>
                        <td style="text-align: center">
                            <div class="radio radio-primary no-margin inline">
                                <input <?= $selected ?> type="radio" name="patient_listselected" onclick="searchedPatientClick('<?= $value->patient_name ?>', '<?= $value->phone ?>', '<?= $value->patient_id ?>', 0)" id="patient_listselected<?= $value->id ?>" class="check_box"  data-toggle="radio">
                                <label for="patient_listselected<?= $value->id ?>">
                                </label>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" style="text-align: center">No Result Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

</div>