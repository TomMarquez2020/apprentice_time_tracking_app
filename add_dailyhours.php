<?php require_once('connect/conn.php'); ?>
<?php
// php here will need to pull the following info:
//          1. Supervisorname of apprentice id
//          2. All work processes of apprenctice
//              a. Order by process character
//          3. all hour work and process character of the passed in date for apprentice if any

//  roughly this:
session_start();

$day     = $_GET['data'];
$month = $_SESSION['month'];
$year = $_SESSION['year'];
$id = $_SESSION['id'];

// get index of month + 1
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

// get supervisors name
$supquery = "SELECT concat(p.fname, ' ', p.lname) AS SuperName
            FROM supervisorstbl s
            JOIN apprentsuperstbl a ON a.supappsupfk = s.supervisorid
            JOIN personstbl p ON p.personid = s.perssupfk
            WHERE a.persappsupfk = $id
                ";

// Question here is do we want to get the all of the data for this page with one SQL call, or break it out?

$suprs = mysqli_query($con, $supquery);
$suprow = mysqli_fetch_assoc($suprs);
$supname = $suprow["SuperName"];

// get processes
$proc_data_array   = array();
$procquery = "SELECT ow.owpid AS workpid, ow.processletter, w.pname, aop.hours 
            FROM personstbl p 
            JOIN personoccupationstbl po ON po.perspersoccfk = p.personid
            JOIN occupationworkprocessestbl ow ON po.occpersoccfk = ow.occfk
            JOIN workprocessestbl w ON w.workprocessid = ow.procfk
            LEFT JOIN apprenticeoccupationprogresstbl aop ON aop.owpfk = ow.owpid 
									AND aop.poaopfk = po.perspersoccfk
                                    AND aop.date = '$date'
            WHERE p.personid = $id
            ";
$procrs = mysqli_query($con, $procquery);
while ($sql_data = mysqli_fetch_assoc($procrs)) {
    $proc_data_array[] = $sql_data;
}
$proc_data_len = count($proc_data_array);
$json_proc_data = json_encode($proc_data_array, true);
// echo json_encode($json_proc_data);

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
            <h2 id="ad_date"><?php echo $month . ' ' . $day . ' ' . $year ?></h2>
            <h3><u>Supervisor Name</u></h3>
            <h3 id="ad_supname"><?php echo $supname ?></h3>
            <!--    Table here for any work done followed by 2 text fields (1 for adding hours and 1 for adding process) 
                    The second text field could be a drop down of processes
            -->
        </section>
        <section id="ad_right">
            <h2>Work Processes</h2>
            <form action="process_daily_hours.php" method="post">
                <!--    Another table here for character process and process name -->
                <div id="ad_table">
                    <div id="ad_table_header">
                        <div class="ad_table_cell shortcell">
                            Hours
                        </div>
                        <div class="ad_table_cell shortcell">

                        </div>
                        <div class="ad_table_cell">
                            Process
                        </div>
                    </div>
                    <div id="ad_table_body">
                        <?php foreach ($proc_data_array as $item) { ?>
                            <div class="ad_table_row" id="workpid_<?php echo $item['workpid'] ?>" name="workpid_<?php echo $item['workpid'] ?>">
                                <div class="ad_table_cell shortcell">
                                    <input type="text" value="<?php echo $item['hours'] ?>" name="hours_<?php echo $item['workpid'] ?>">
                                </div>
                                <div class="ad_table_cell shortcell">
                                    <?php echo $item['processletter'] ?>.
                                </div>
                                <div class="ad_table_cell">
                                    <?php echo $item['pname'] ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <br>
                <input type="submit" value="save">
            </form>
        </section>
    </main>


    <script src="js/jquery.js"></script>
    <script src="js/add_dailyhours_script.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>