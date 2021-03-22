<?php require_once('connect/conn.php');

session_start();

// pull data for test person...Bobby Little Boy, personid = 1...this will need to be changed to Get id from login page
// Info that needs to be displayed for apprentice: Occupation, Student Name,(Year and Wage will need to be figured out)

$query = "SELECT 
            CONCAT(p.fname, ' ', p.middle, ' ', p.lname) as fullname,
            p.personid as id,
            o.occupationname as occupation
            FROM personstbl p
            JOIN personoccupationstbl po ON p.personid = po.perspersoccfk
            JOIN occupationstbl o ON o.occupationid = po.occpersoccfk
            WHERE personid = 1 
            LIMIT 1
            ";
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($rs);
$count = mysqli_num_rows($rs);

$_SESSION["id"] = $row["id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Year Calendar</title>
    <style>

    </style>
</head>

<body>
    <div id="yc_main">
        <!-- yc = "landing page" -->
        <section id="yc_calendar_block">

            <!-- user data attribute to pass on userid to next page...not sure if this is the right way to do this -->
            <table id="yc_year_calendar" data-userid="<?php echo $_SESSION["id"] ?>">
            </table>

        </section>

        <section id="yc_info">
            <span>
                <h2><?php echo $row['occupation']; ?> </h2>
            </span>
            </br>
            <span>
                <h2><?php echo $row['fullname']; ?></h2>
            </span>
            <span> year 1st </span>
            <span> Wage 60% </span>
        </section>
    </div>

    <div id="yc_total_hours">
        <section>

        </section>
    </div>
    <script src="js/year_calendar_script.js"></script>
</body>

</html>

<?php
mysqli_close($con);
?>