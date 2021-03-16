<?php require_once('connect/conn.php'); ?>
<?php
// php here will need to pull the following info:
//          1. Supervisorname of apprentice id
//          2. All work processes of apprenctice
//              a. Order by process character
//          3. all hour work and process character of the passed in date for apprentice if any

//  roughly this:

$data     = $_GET['data'];
// split data into 3 variables
list($id, $day, $month, $year) = explode("_", $data);
$data_array   = array();

$query = "SELECT 
            supervisor.fname, supervisor.lname

            FROM personoccupationstbl p
            JOIN occupationworkprocessestbl ow ON ow.occfk = p.occpersoccfk 
            LEFT JOIN apprenticeoccupationprogresstbl aop ON aop.poaopfk = p.poid 
                                    AND aop.owpfk = ow.owpid
            JOIN apprentsuperstbl aps ON aps.persappsupfk = p.perspersoccfk
            JOIN supervisorstbl s ON s.supervisorid = aps.supappsupfk
            JOIN personoccupationstbl supocc ON supocc.perspersoccfk = s.perssupfk
            JOIN personstbl supervisor ON supervisor.personid = supocc.perspersoccfk
            WHERE p.perspersoccfk = 1
                ";

// Question here is do we want to get the all of the data for this page with one SQL call, or break it out?

$rs = mysqli_query($con, $query);
while ($sql_data = mysqli_fetch_assoc($rs)) {
    $data_array[] = $sql_data;
}
$sql_data = json_encode($data_array);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Daily Hours</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main id="ad_main">
        <section id="ad_left">
            <h2 id="ad_date">Date Goes here</h2>
            <!--    Table here for any work done followed by 2 text fields (1 for adding hours and 1 for adding process) 
                    The second text field could be a drop down of processes
            -->
        </section>
        <section id="ad_right">
            <h2>Work Processes</h2>
            <!--    Another table here for character process and process name -->

        </section>
    </main>


    <script src="js/jquery.js"></script>
    <script src="js/add_dailyhours_script.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>