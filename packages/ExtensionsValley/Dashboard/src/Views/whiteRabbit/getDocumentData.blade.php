<div class="">
    <table  class="table table-condensed table_sm ">
        <thead>
            <tr>
                <th class="bg-teal-active" width="70%">File Name</th>
                <th class="bg-teal-active" width="20%">Created AT</th>          
                <th class="bg-teal-active" width="10%"><i class="fa fa-trash"></i></th>          

            </tr>
        </thead>
        <tbody>
            <?php
            if (count($result) != 0) {
                foreach ($result as $each) {
                    ?>
                    <tr id="tableuplodedrow<?= $each->created_at ?>">
                        <td><?= $each->document_name ?></td>
                        <td><?= $each->created_at ?></td>
                        <td><button class="btn btn-danger" onclick="delete_uploadedfile(<?= $each->id ?>)" title="" id="delete_uploadedfilebtn<?= $each->created_at ?>" style="padding: 2px 2px; margin-right: 10px;" ><i id="deleted__uploaded_filespin<?= $each->created_at ?>" class="fa fa-trash"></i></button></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="3" style="text-align: center">No Result Found</td>
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