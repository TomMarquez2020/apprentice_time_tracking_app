<!-- process daily hours form -->

<?php require_once('connect/conn.php'); ?>
<?php

if (isset($_POST['form_submitted'])) {

    session_start();

    $day    = $_SESSION['day'];
    $month  = $_SESSION['month'];
    $year   = $_SESSION['year'];
    $id     = $_SESSION['id'];

    // the following should probably be put into an external helper class or something
    // it's already done in add_dailyhours.php
    $months_array = array(
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "Novevember",
        12 => "December",
    );
    $month_index = array_search($month, $months_array);
    $date = $year . '-' . $month_index . '-' . $day;

    // add values to a json array
    $form_values = array();
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'workpid_') == 0 and $key != "form_submitted") {
            $new_key = str_replace('hours_', "", $key);
            // only add values if there is a value
            if ($value != "") {
                $form_values[$new_key] = $value;
            }
        }
    }

    $json_form_values = json_encode($form_values);
    // echo $json_form_values;

    // select records that already exist in the apprenticeoccupationprogress table first
    // to see if they need to be updated
    $data_array = array();
    $query = "SELECT ao.owpfk
                FROM apprenticeoccupationprogresstbl ao
                JOIN personoccupationstbl po ON po.poid = ao.poaopfk
                JOIN personstbl p ON p.personid = po.perspersoccfk
                WHERE p.personid = $id
                AND ao.date = '$date';
                ";

    $rs = mysqli_query($con, $query);
    // create an array of owpfk (Occupation Work Process foreign key)
    while ($sql_data = mysqli_fetch_assoc($rs)) {
        $data_array[] = $sql_data['owpfk'];
    }
    $json_data = json_encode($data_array, true);
    // echo $json_data;

    $obj = json_decode($json_form_values, TRUE);

    // loop through posted data 
    // TODO: Need to figure out how to handle values that have been edited to blank
    foreach ($obj as $key => $value) {
        $con->begin_transaction();
        try {
            // if key already exists in database, update
            if (in_array($key, $data_array)) {
                $query_update = "
                    UPDATE apprenticeoccupationprogresstbl ao
                    JOIN personoccupationstbl po ON po.poid = ao.poaopfk
                    JOIN personstbl p ON p.personid = po.perspersoccfk
                    SET ao.hours = ?
                    WHERE ao.date = '$date'
                    AND p.personid = $id
                    AND ao.owpfk = $key;
                ";
                // echo $value;
                $stmt = $con->prepare($query_update);
                if ($stmt) {
                    $stmt->bind_param("i", $value);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    // should probably handle failures differently here
                    echo "Failure!!!" . $con->error;
                }
            }
            //else insert
            else {
                $query_insert = "
                INSERT INTO apprenticeoccupationprogresstbl(poaopfk, owpfk, hours, date) VALUES(?, ?, ?, ?);
                ";
                $stmt = $con->prepare($query_insert);
                if ($stmt) {
                    $stmt->bind_param("iiis", $id, $key, $value, $date);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "Failure!!! " . $con->error;
                }
            }
            $con->commit();
        } catch (mysqli_sql_exception $exception) {
            // should probably return an error message or something if there is an exception thrown here
            $con->rollback();
        }
    } // end if 

    // remove day session
    unset($_SESSION['day']);
}
?>