<?php require_once('connect/conn.php');

    // pull data for test person...Bobby Little Boy
    // Info that needs to be displayed for apprentice: Occupation, Student Name,(Year and Wage will need to be figured out)

    $query = "SELECT 
            CONCAT(p.fname, ' ', p.middle, ' ', p.lname) as fullname,
            o.occupationname as occupation
            FROM personstbl p
            JOIN personoccupationstbl po ON p.personid = po.perspersoccfk
            JOIN occupationstbl o ON o.occupationid = po.occpersoccfk
            WHERE personid = 1
            ";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($rs);
    $count = mysqli_num_rows($rs);

    //TODO: should probably check here to make sure query does not return more than one record


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/styles.css">
        <title>Apprentice Main Page</title>
        <style>
            
        </style>
    </head>

    <body>
        <div id="main">

            <section id="calendar_block">
                <div>
                </div>

                <table id="year_calendar">
                </table>

            </section>

            <section>
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

        <script src="js/scripts.js"></script>
    </body>

</html>