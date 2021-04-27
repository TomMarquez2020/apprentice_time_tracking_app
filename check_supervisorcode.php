<?php require_once('connect/conn.php'); ?>

<?php
// check supervisor code
// Needs:   apprentice id
//          supervisor code

$supcode = "";
$id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $id = $_POST['id'];
    $supcode = $_POST['supcode'];
    if (empty($id) || empty($supcode)) {
        echo "Name is empty";
    }
}

$query = "SELECT *
            FROM supervisorstbl s
            JOIN apprentsuperstbl ap ON ap.supappsupfk = s.supervisorid
            WHERE ap.persappsupfk = $id
            AND s.supervisorcode = $supcode
            LIMIT 1;
            ";

$rs = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($rs);

echo "good job";
echo "woot woot";

?>

<?php
mysqli_close($con);
?>