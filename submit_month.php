<?php require_once('connect/conn.php'); ?>

<?php

// run ajax code on the supervisorcode
// add an alert box
session_start();

$month = $_SESSION['month'];
$year = $_SESSION['year'];
$id = $_SESSION["id"];

//  query database
//  Need apprentice name, apprentice occupation, supervisor info
$query = "SELECT concat(p.fname, ' ', p.lname) AS apprentice_name,
            o.occupationname AS occupation_name,
            concat(superv.fname, ' ', superv.lname) AS supervisor_name
            FROM personstbl p
            JOIN personoccupationstbl po ON po.perspersoccfk = p.personid
            JOIN occupationstbl o ON o.occupationid = po.occpersoccfk
            JOIN apprentsuperstbl apsup ON apsup.persappsupfk = p.personid
            JOIN supervisorstbl s ON apsup.supappsupfk = s.supervisorid
            JOIN personstbl superv ON superv.personid = s.perssupfk
            WHERE p.personid = $id
            LIMIT 1
            ";

$rs = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($rs);

// $supname = $suprow["SuperName"];
$app_name = $row['apprentice_name'];
$app_occupation = $row['occupation_name'];
$sup_name = $row['supervisor_name'];

// Get process information
// Get the apprentice's month and year of processes and the total amount of each
$proc_query = "SELECT DISTINCT
                owp.owpid,
                owp.processletter,
                wp.pname,
                IFNULL(SUM(aop.hours), 0) as MonthlySum
                FROM workprocessestbl wp
                JOIN occupationworkprocessestbl owp ON owp.procfk = wp.workprocessid
                JOIN personoccupationstbl po ON po.occpersoccfk = owp.occfk
                LEFT JOIN apprenticeoccupationprogresstbl aop ON aop.poaopfk = po.poid
                                                    AND aop.owpfk = owp.owpid
                                                    AND YEAR(aop.date) = $year
                                                    AND MONTHNAME(aop.date) = '$month'
                WHERE po.perspersoccfk = $id
                GROUP BY owp.processletter
            ";
$proc_rs = mysqli_query($con, $proc_query);
$proc_data_array   = array();
while ($sql_data = mysqli_fetch_assoc($proc_rs)) {
    $proc_data_array[] = $sql_data;
}
// $proc_data_len = count($proc_data_array);

// Get a list of the Indepndent Skills
$skills_query = "SELECT idpid, skillname
                FROM idependentskillstbl i;
                ";
$skills_rs = mysqli_query($con, $skills_query);
$skills_data_array   = array();
while ($sql_data = mysqli_fetch_assoc($skills_rs)) {
    $skills_data_array[] = $sql_data;
}
// $skills_data_len = count($skills_data_array);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Month</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main id="sm_main">
        <input type="hidden" id="apprentice_id" value="<?php echo $id ?>">
        <!-- <form action="process_submit_month.php" method="post"> -->
        <form>
            <div class="sm_grid_container">
                <div class="header1">
                    <p class="underline"><?php echo $app_name ?></p>
                    <p class="underline"><?php echo $month ?></p>
                </div>
                <div class="header2">
                    <p class="underline"><?php echo $app_occupation ?></p>
                    <p class="underline"><?php echo $year ?></p>
                </div>

                <div class="main1">
                    <!-- submit process table -->
                    <div id="sm_process_table">
                        <!--submit table header -->
                        <div id="sm_table_header">
                            <div class="sm_table_cell shortcell">

                            </div>
                            <div class="sm_table_cell">
                                Process
                            </div>
                            <div class="sm_table_cell shortcell center">
                                HRS
                            </div>
                        </div>
                        <!-- end submit process header -->

                        <!-- submit process table body -->
                        <div id="sm_table_body">
                            <?php foreach ($proc_data_array as $item) { ?>
                                <div class="sm_table_row">
                                    <!-- id and name are owpid_MonthlySum -->
                                    <input type="hidden" id="owpid_<?php echo $item['owpid'] ?>" name="owpid_<?php echo $item['owpid'] ?>" value="<?php echo $item['MonthlySum'] ?>">
                                    <div class="sm_table_cell shortcell">
                                        <?php echo $item['processletter']; ?>.
                                    </div>
                                    <div class="sm_table_cell">
                                        <?php echo $item['pname']; ?>
                                    </div>
                                    <div class="sm_table_cell shortcell underline center">
                                        <?php echo $item['MonthlySum']; ?>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                        <!-- end submit process table body -->


                    </div>
                    <!-- end submit process table -->
                </div>
                <div class="main2">
                    <p style="text-align: center;">Supervisor: <?php echo $sup_name ?></p>
                    <!-- skills table -->
                    <div id="sm_skills_table">
                        <!-- table body -->
                        <div id="sm_table_body">
                            <?php foreach ($skills_data_array as $item) { ?>
                                <div class="sm_table_row">
                                    <div class="sm_table_cell">
                                        <?php echo $item['skillname']; ?>
                                    </div>
                                    <div class="sm_table_cell shortcell">
                                        <input id="<?php echo $item['idpid'] ?>" name="<?php echo $item['idpid'] ?>" type="text">
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <!-- end table body -->
                    </div>
                    <!-- end skills table -->
                    <div id="sm_submitarea">
                        <textarea id="comments" name="comments" placeholder="comments"></textarea>
                    </div>
                    <input id="supervisorcode" name="supervisorcode" type="text" placeholder="supervisorcode">
                    </br>
                    <input id="submit_button" type="hidden" name="form_submitted" value="1">

                    <input id="submit_month_form" type="submit" button="submit">

                </div>
            </div>
            </div>
        </form>
    </main>

    <script src="js/jquery.js"></script>
    <script src="js/submit_month.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>