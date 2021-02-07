<?php
if (count($result) != 0) {
    foreach ($result as $each) {
        if ($from_type == 'pat_name') {
            $search_string = $each->patient_name;
        } else if ($from_type == 'pat_id') {
            $search_string = trim($each->reference_no);
        } else if ($from_type == 'pat_phone') {
            $search_string = trim($each->phone);
        }
        ?>
        <li onclick='searchedPatientClick("<?= trim($each->patient_name) ?>", "<?= trim($each->phone) ?>", "<?= trim($each->patient_id) ?>", 1, "<?= trim($from_type) ?>");'>
            <a>
                <?= trim($search_string) ?>
            </a>
        </li>
        <?php
    }
} else {
    echo "No Result Found";
}
?>
