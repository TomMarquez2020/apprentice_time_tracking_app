<!-- PHP to display form data from year_calendar.php -->

<?php require_once('connect/conn.php'); ?>
<?php
session_start();

$data     = $_GET['data'];
// split data into 3 variables
list($month, $year) = explode("_", $data);
$_SESSION['month'] = $month;
$_SESSION['year'] = $year;
$id = $_SESSION["id"];
$data_array   = array();

$query = "SELECT 
            DAY(aop.date) AS Day,
            SUM(aop.hours) as DailySum
            FROM personoccupationstbl p
            join apprenticeoccupationprogresstbl aop ON aop.poaopfk = p.poid
            where p.perspersoccfk = $id
            AND YEAR(aop.date) = $year 
            AND MONTHNAME(aop.date) = '$month'
            GROUP BY aop.date
            ";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Month Calendar</title>
    <style>

    </style>
</head>

<body>
    <main id="mc_main">
        <section>
            <h2 id="mc_data"><?php echo $month . ' ' . $year ?></h2>
        </section>

        <input type="hidden" id="data" name="data" value='<?php echo $sql_data ?>'>
        <input type="hidden" id="month" name="month" value="<?php echo $month ?>">
        <input type="hidden" id="year" name="year" value="<?php echo $year ?>">
        <input type="hidden" id="id" name="id" value="<?php echo $id ?>">

        <section id="mc_calendar_block">
            <table id="mc_table">

            </table>
        </section>

        <input id="submit_month" type="submit" button="submit">

    </main>

    <script src="js/jquery.js"></script>
    <script src="js/month_calendar_script.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>