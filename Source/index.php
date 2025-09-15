<?php
if(isset($_POST['submit'])){

    //collect form data
    $name = $_POST['name'];
    $date = $_POST['date'];
    $license_plate = $_POST['license_plate'];
    $authorised_by = $_POST['authorised_by'];

    //if no errors carry on
    if(!isset($error)){

        // Title of the CSV
              $Content = "DATE,NAME,LICENSE_PLATE,AUTHORISED_BY\n";

        //set the data of the CSV
        $Content .= "$date,$name,$license_plate,$authorised_by\n";

        //set the file name and create CSV file
        $FileName = "data.csv";
        header('Content-Type: application/csv'); 
    //    header('Content-Type: application/vnd.ms-excel'); 
    //    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); 
        echo $Content;
        exit();
    }
}

//if their are errors display them
if(isset($error)){
    foreach($error as $error){
        echo '<p style="color:#ff0000">$error</p>';
    }
}
?> 

<form action="" method="post">
<label>Date</label><br><input type="text" name="date" required="" value="">
<br>
<label>Name</label><br><input type="text" name="name" required="" value="">
<br>
<label>License Plate No.</label><br><input type="text" name="license_plate" value="" required="">
<br>
<label>Authorised By</label><br><input type="text" name="authorised_by" value="" required="">
<br><br>
<input type="submit" name="submit"   value="Update Excel File">

</form>