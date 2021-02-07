<label class="custom_floatlabel"><?= $list_head ?></label>
<?php
if (count($result) != 0) {
    ?>
    <ul class="select_button no-padding">
        <?php
        foreach ($result as $each) {
            ?>
            <li id="<?= $from_type ?>_data_<?= $each->data_id ?>" onclick="getfrequentdata('<?= $from_type ?>',<?= $each->data_id ?>, '<?= base64_encode($each->data_name) ?>')" class="tabtype1"><i class="fa fa-check-circle"></i><?= $each->data_name ?></li>
                <?php
            }
            ?>
    </ul>
    <?php
} else {
    echo "No Result Found";
}
?>