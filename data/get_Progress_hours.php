<?php require_once('../connect/conn.php'); ?>
<?php 
    try {
      
        $id     = $_GET['id'];
        $month  = $_GET['month'];
        $year   = $_GET['year'];
        $data   = array();

        $query = "SELECT 
                    aop.date,
                    SUM(aop.hours) as DailySum
                    FROM personoccupationstbl p
                    join apprenticeoccupationprogresstbl aop ON aop.poaopfk = p.poid
                    where p.perspersoccfk = $id
                    AND YEAR(aop.date) = $year 
                    AND MONTHNAME(aop.date) = '$month'
                    GROUP BY aop.date
                ";
        $rs = mysqli_query($con, $query);
        while($sql_data = mysqli_fetch_assoc($rs)){
            $data[] = $sql_data;
        }

        echo json_encode($data);
    }

    catch(Exception $e){
        echo 'Message: ' . $e->getMessage();
    }
?>
<?php
    mysqli_close($con);
?>