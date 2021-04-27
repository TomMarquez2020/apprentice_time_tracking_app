<?php require_once('connect/conn.php'); ?>

<?php
// process the submit month screen 
// first, make sure the supervisor code matches the apprentice's supervisor's code
// if pass, insert records
// if not pass, send to an error page with a link to navigate back to the submit_month page

$error_url = "error.php";

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
    $supervisorcode = "";
    foreach ($_POST as $key => $value) {
        if ($key == "supervisorcode") {
            $supervisorcode = $value;
        } else if ($key != "form_submitted") {
            $new_key = $key;
            // if value is empty and it is not a comment, make it a 0
            if ($value == "" and $key != 'comments') {
                $value = 0;
            }
            $form_values[$new_key] = $value;
        }
    }

    $json_form_values = json_encode($form_values);
    echo $json_form_values;
}

?>

<?php
mysqli_close($con);
?>