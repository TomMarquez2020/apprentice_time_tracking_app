<!-- PHP to display form data from year_calendar.php -->

<?php
    $data     = $_GET['data'];
    // split data into 3 variables
    list($id, $month, $year) = explode("_", $data)
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
        <!-- ?php echo $data ?> 
        ?php echo $id ?>
        ?php echo $month ?>
        ?php echo $year ?> -->
        
        <div id="mc_main">
            <section>
                <h2 id="mc_data"><?php echo $month . ' ' . $year ?></h2>
            </section>
            
            <form type="post">

                <input type="hidden" id="month" name="month" value="<?php echo $month ?>">
                <input type="hidden" id="year" name="year" value="<?php echo $year ?>">

                <section id="mc_calendar_block">
                    <table id="mc_table">

                    </table>
                </section>

            </form>

            <input type="submit" button="submit">

        </div>


        <script src="js/month_calendar_script.js"></script>
    </body>

</html>