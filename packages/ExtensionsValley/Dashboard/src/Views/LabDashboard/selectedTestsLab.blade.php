<table  class="table table-condensed table_sm ">
    <thead>
        <tr>
            <th width='50%'>Name</th>
            <th width='10%'><i class="fa fa-info"></i></th>
            <th width='20%'>Amount</th>
            <th width='20%'>TAT</th>
        </tr>
    </thead>
    <tbody>
        <?php
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
                    ?>
                    <tr class="">
                        <td><?= base64_decode($test_name) ?></td>
                        <td title="<?= @$test_requrement_desc[$test_id] ? $test_requrement_desc[$test_id] : '' ?>" class="text-blue"><i class="fa fa-info"></i></td>
                        <td><?= base64_decode($test_amount) ?></td>
                        <td><?= base64_decode($test_tat) ?></td>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="4" style="text-align: center">No Result Found</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>