<!-- process daily hours form -->

<?php require_once('connect/conn.php'); ?>
<?php

if (isset($_POST['form_submitted'])) {

    session_start();

    $day     = $_GET['data'];
    $month = $_SESSION['month'];
    $year = $_SESSION['year'];
    $id = $_SESSION['id'];

    // add values to a json array
    $data = array();
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'workpid_') == 0 and $key != "form_submitted") {
            $new_key = str_replace('hours_', "", $key);
            // only add values if there is a value
            if ($value != "") {
                $data[$new_key] = $value;
            }
        }
    }

    echo json_encode($data);

    // post data back to database here
    // use parameterized query
    // $query = "INSERT INTO namestbl (firstname, lastname) VALUES (?, ?)"
    // $stmt = mysqli_prepare($conn, $query);
    // mysqli_stmt_bind_param($stmt, "ss", $firstname, $lastname);
    // mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);
    // mysqli_close($conn);

} // end if 

?>