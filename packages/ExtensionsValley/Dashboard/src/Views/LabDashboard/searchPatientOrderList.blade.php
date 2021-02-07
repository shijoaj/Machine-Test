<div class="theadscroll" style="position: relative; height: 60vh;">
    <table  class="table table-condensed table_sm ">
        <thead>
            <tr>
                <th width="5%">-</th>          
                <th width="20%">Date</th>          
                <th width="19%">Patient ID</th>          
                <th width="20%">Name</th>          
                <th width="20%">Phone</th>          
                <th width="8%"><i class="fa fa-edit"></i></th>          
                <th width="8%"><i class="fa fa-trash"></i></th>          
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($result) != 0) {
                foreach ($result as $value) {
                    $creatd_at = date('M-d-Y H:i:s', strtotime($value->created_at));
                    $creatd_at_show = date('M-d-Y', strtotime($value->created_at));
                    $status_class = '';
                    if ($value->status == '1') {
                        $status_class = "text-blue";
                    } else if ($value->status == '2') {
                        $status_class = "text-red";
                    } else if ($value->status == '3') {
                        $status_class = "text-orange";
                    } else if ($value->status == '4') {
                        $status_class = "text-green";
                    }
                    ?>
                    <tr id="edit_patientorderrow<?= $value->head_id ?>" class="edit_patientorderrow">
                        <td><i class="fa fa-circle <?= $status_class ?>"></i></td>
                        <td title="<?= $creatd_at ?>"><?= $creatd_at_show ?></td>
                        <td><?= $value->reference_no ? $value->reference_no : '-' ?></td>
                        <td><?= $value->patient_name ?></td>
                        <td><?= $value->phone ?></td>
                        <td style="text-align: center"><button onclick="editPatientorder(<?= $value->head_id ?>, '<?= $value->patient_name ?>', '<?= $value->phone ?>', '<?= $value->patient_id ?>')" id="edit_patientorderbtn<?= $value->head_id ?>" type="button" style="padding: 1px 4px" class="btn bg-orange-active"><i id="edit_patientorderspin<?= $value->head_id ?>" class="fa fa-edit"></i></button></td>
                        <td style="text-align: center"><button onclick="deletePatientorder(<?= $value->head_id ?>, '<?= $value->patient_name ?>', '<?= $value->phone ?>', '<?= $value->patient_id ?>')" id="delete_patientorderbtn<?= $value->head_id ?>" type="button" style="padding: 1px 4px" class="btn bg-red-active"><i id="delete_patientorderspin<?= $value->head_id ?>" class="fa fa-trash"></i></button></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7" style="text-align: center">No Result Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <div class="row patientlist_pagination" style="margin:0;padding:0;float: right;">

        @if(!empty($paginator))
        <div class="row" >
            <div class="col-md-12" style="text-align:right;">
                <nav> <?php echo $paginator->render(); ?>
                </nav>
            </div>
        </div>@endif

    </div>

</div>
