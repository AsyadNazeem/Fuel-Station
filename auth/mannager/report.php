<?php session_start(); ?>
<?php include_once '../../config/conn.php'; ?>
<?php include_once '../../res/add-ons.php';
require '../../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
?>
<?php
if(!isset($_SESSION['user_id'])){
    header('Location: ../../login.php');
}
if($_SESSION['userType'] != 'MANAGER'){
    header('Location: ../../login.php');
}

?>



<?php

if (isset($_POST['btn-DateBetweenSales'])) {
    $user_id = $_SESSION['user_id'];

    //assign empty string to the variable
    $startDate = '';
    $endDate = '';
    //assign the value from the form to the variable
    $StartDate = $_POST['start_date'];
    $EndDate = $_POST['end_date'];
    echo $StartDate;
    echo '<br>';
    echo $EndDate;

    $sql="SELECT * FROM Fuel_station WHERE manager_id='{$user_id}'";
    $result=mysqli_query($connection,$sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $station_id = $row['station_id'];

        $SalesRecodeList ='';
        $sql="SELECT * from invoice where station_id='{$station_id}' AND invoice_date BETWEEN '{$StartDate}' AND '{$EndDate}' ORDER BY invoice_date DESC";
        $result=mysqli_query($connection,$sql);
        if ($result) {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $rowcount = 1;
            while ($row = mysqli_fetch_assoc($result)) {

                $sheet->setCellValue('A'.$rowcount, $row['invoice_id']);
                $sheet->setCellValue('B'.$rowcount, $row['pumper_id']);
                $sheet->setCellValue('C'.$rowcount, $row['fuel_id']);
                $sheet->setCellValue('D'.$rowcount, $row['quantity']);
                $sheet->setCellValue('E'.$rowcount, $row['total']);
                $sheet->setCellValue('F'.$rowcount, $row['invoice_date']);

                $rowcount++;

                $writer = new Xlsx($spreadsheet);
                $writer->save('report.xlsx');
                header('Location: report.xlsx');









            }


        }

    }else{
        header('Location: ../../login.php');
    }


}


?>

<?php












?>