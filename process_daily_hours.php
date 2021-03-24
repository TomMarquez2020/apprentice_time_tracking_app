<!-- process daily hours form -->

<?php require_once('connect/conn.php'); ?>
<?php
session_start();

$day     = $_GET['data'];
$month = $_SESSION['month'];
$year = $_SESSION['year'];
$id = $_SESSION['id'];

// add values to a json array
$data = array();
foreach ($_POST as $key => $value) {
    if (strpos($key, 'workpid_') == 0) {
        $new_key = str_replace('hours_', "", $key);
        // only add values if there is a value
        if ($value != "") {
            $data[$new_key] = $value;
        }
    }
}

echo json_encode($data);

// post data back to database here


?>