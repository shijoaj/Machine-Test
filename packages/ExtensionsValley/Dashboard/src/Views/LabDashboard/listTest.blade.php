<?php
if (count($result) != 0) {
    foreach ($result as $each) {
        ?>
        <li onclick='searchedTestClick(<?= $each->id ?>, "<?= trim($each->test_name) ?>");'>
            <a>
                <?= $each->test_name ?>
            </a>
        </li>
        <?php
    }
} else {
    echo "No Result Found";
}
?>
