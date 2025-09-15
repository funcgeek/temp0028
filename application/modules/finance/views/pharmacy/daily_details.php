<?php
//$conn = mysqli_connect("localhost", "ispecs", "Pass@2020", "ispecs");
// $conn = mysqli_connect("swiftvbs.ipagemysql.com", "ispecs_2", "Pass2020", "ispecs_2");
$conn = mysqli_connect("localhost", "ispecs_0", "Pass@2020", "ispecs_0");
	

?>

<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                  <?php echo 'Daily Sales Report';//lang('payments'); ?> 
            </header>
            <div class="col-md-12">
                <div class=" panel-body col-md-7">
                    <section>
                        <form role="form" class="panel-body" action="finance/dailyDetails" method="post" enctype="multipart/form-data">
                            <div class="form-group">

                                <!--     <label class="control-label col-md-3">Date Range</label> -->
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder="<?php echo lang('date_from'); ?>">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder="<?php echo lang('date_to'); ?>">
                                        <input type="hidden" class="form-control dpd2" name="doctor" value="<?php
                                        if (!empty($doctor)) {
                                            echo $doctor;
                                        }
                                        ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span> 
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-5 panel-body">
                    <button class="btn btn-info green no-print pull-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
                </div>
            </div>
            
            
            <style>
                
                
                #editable-sample_length{
                    display: none;
                }
                
                #editable-sample_info{
                    display: none;
                }
                
                .pagination{
                    display: none;
                }
                
                
            </style>
            
            
            <div class="panel-body col-md-12">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                              
                               <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('patient'); ?></th>   
                                <th><?php echo 'Model#'; ?></th>   
                                <th><?php echo 'Colour';//lang('date'); ?></th>
                                <th><?php echo 'Price';//lang('total'); ?></th>
                                <th><?php echo 'Discount';//lang('total'); ?></th>
                                <th><?php echo 'Final Cost';//lang('total'); ?></th>								
                                <th><?php echo 'Lens'; ?></th>								
                                <th><?php echo 'Exam'; ?></th>
                                <th><?php echo 'Pay. Type'; ?></th>
                                <th><?php echo 'HL INS'; ?></th>
                                <th><?php echo 'Claims'; ?></th>
                                <th><?php echo 'Deposit'; ?></th>
                                <th><?php echo 'Total'; ?></th>
                                <th><?php echo 'Others'; ?></th>                                
								<th><?php echo 'Bal'; ?></th>
                            </tr>
                        </thead>
                        <tbody>
<?php
//	if (isset($_REQUEST['id'])) {
		$id = strtotime($_REQUEST['id']);
		$id3 = $_GET['id'];

		$query = "SELECT * FROM pharmacy_payment where date_string = '".$id3."'";
		$newdate = mysqli_query($conn, $query);

		$amt_sql= mysqli_query($conn, "SELECT sum(amount) as amt_total FROM pharmacy_payment where date_string = '".$id3."'");
		$amt_results = mysqli_fetch_assoc($result);
		



//if(mysqli_num_rows($newdate) > 0) {
  // output data of each row

while($row = mysqli_fetch_assoc($newdate)) {
?>
<tr>
<td> <?php echo $row['date_string']; ?></td>
<td> <?php echo $row['patient_name']; ?></td>
<td>
<?php 
$frame_name = $row['category_name'];
$framelist = explode(",", $frame_name);
//replace space in array list with comma
$frameresult = str_replace(array('*'), ' ', $framelist);
//iterate through the nested-list array, and explode each list
for ($i = 0; $i < count($frameresult); ++$i) {
        $frame[$i] = explode(" ", $frameresult[$i]);
		$frameid = $frame[0][0];
		$frame_name_query = mysqli_query($conn, "SELECT * FROM medicine where id = '".$frameid."'");
		while($frame_name_row = mysqli_fetch_assoc($frame_name_query)) {
		echo "<br>".$frame_name_row['name'];		
        //print_r($res);
    }
}
 ?></td>
<td>
<?php 
$frame_color = $row['category_name'];
$framecolor = explode(",", $frame_color);
$framecolorresult = str_replace(array('*'), ' ', $framecolor);
//replace space in array list with comma
//iterate through the nested-list array, and explode each list
for ($i = 0; $i < count($framecolorresult); ++$i) {
        $framec[$i] = explode(" ", $framecolorresult[$i]);
		$framecid = $framec[0][0];
		$frame_color_query = mysqli_query($conn, "SELECT * FROM medicine where id = '".$frameid."'");
		while($frame_color_row = mysqli_fetch_assoc($frame_color_query)) {
		echo "<br>".$frame_color_row['effects'];		
        //print_r($res);
    }
}
 ?></td>
<td>
<?php 
$frame_price = $row['category_name'];
$frameprice = explode(",", $frame_price);
//replace space in array list with comma
$framepriceresult = str_replace(array('*'), ' ', $frameprice);
//iterate through the nested-list array, and explode each list
for ($i = 0; $i < count($framepriceresult); ++$i) {
        $framep[$i] = explode(" ", $framepriceresult[$i]);
		//$frameid = $frame[0][0];
		//$frame_name_query = mysqli_query($conn, "SELECT * FROM medicine where id = '".$frameid."'");
		//while($frame_name_row = mysqli_fetch_assoc($frame_name_query)) {
		echo "<br>".$framep[0][1];		
        //print_r($res);
    }

 ?></td>
<td> <?php echo $row['discount']; ?></td>
<td> <?php echo $row['doctor_name']; ?></td>
<td> <?php echo $row['doctor_name']; ?></td>
<td> <?php echo $row['doctor_name']; ?></td>
<td>
<?php
$dep_type = $row['deposit_type'];
$de_type = explode("," ,$dep_type);
$d_type = count($de_type);

for($x = 0; $x < $d_type; $x++) {  
  echo $de_type[$x];
  echo "<br>";
}
?>
</td> <td> <?php echo $row['doctor_name']; ?></td>
<td> <?php echo $row['doctor_name']; ?></td>
<td>
<?php
$am_received = $row['amount_received'];
$amt_received = explode("," ,$am_received);
$a_received = count($amt_received);

for($x = 0; $x < $a_received; $x++) {  
  echo "<b>$".$amt_received[$x];
  echo "<br></b>";
  $amt_rec += $amt_received[$x];
}

?>
</td><td> <b>$<?php echo $row['gross_total']; ?></b></td>
<td> <?php echo $row['doctor_name']; ?></td>
<td>
<b>
<?php
//$received = array()
$received = $row['amount_received'];
$amt_receive = array_sum(explode(',', $received));
$new_amt = $row['gross_total'] - $amt_receive;
if($new_amt > 0){
	echo "<font color='red'>$".$new_amt."</font";
}else{
	echo "<font color='green'>$".$new_amt."</font";
}

//echo $ec;
//$amt_received = explode("," ,$am_received);
//$a_received = count($amt_received);
/*
for($x = 0; $x < $a_received; $x++) {  
  echo "<b>$".$amt_received[$x];
  echo "<br></b>";
}
*/
?>
</b>
</td>
<td> 
<?php 
//$qty1 = array();
//$qty2 = array();

//$qty1 = explode(',', $row['category_name']);

$qty_amt = $row['category_name'];
//echo $qty_amt;
//echo "\n";
// explode list into array
$AUTHOR = explode(",", $qty_amt);

//replace space in array list with comma
$result = str_replace(array('*'), ' ', $AUTHOR);
//iterate through the nested-list array, and explode each list
for ($i = 0; $i < count($result); ++$i) {
        $res[$i] = explode(" ", $result[$i]);
		echo "<br>".$res[0][3];
        //print_r($res);
    }
 ?>
</td>
<td>
<?php 
//$qty1 = array();
//$qty2 = array();

//$qty1 = explode(',', $row['category_name']);

$service_item = $row['category_name'];
//echo $service_item;
//echo "\n";
// explode list into array
$AUTHOR1 = explode(",", $service_item);

//replace space in array list with comma
$result = str_replace(array('*'), ' ', $AUTHOR1);
//iterate through the nested-list array, and explode each list
for ($i = 0; $i < count($result); ++$i) {
        $res1[$i] = explode(" ", $result[$i]);
		//echo "<br>".$res[0][2];
		$qty_name = $res1[0][0];
		$qty_name_query = mysqli_query($conn, "SELECT category FROM payment_category where id = '".$qty_name."'");
		while($qty_name_row = mysqli_fetch_assoc($qty_name_query)) {
		echo "<br>".$qty_name_row['category'];
		}		
        //print_r($res);
    }
 ?>
</td>

</tr>
<?php
	}
//}
//	}	
?>

<tr>

<td colspan="7">&nbsp;</td>
<td colspan="2"  align="right"><font color="green"><b>Total Amount Due</b></font></td>
<td><font color="green"><b> $
<?php
$am_received = '0';
while ($amt_row = mysqli_fetch_assoc($amt_sql))
{ 
   echo $amt_row['amt_total'];
   $am_received = $amt_row['amt_total'];
}
	
?>
 </b></font></td>
</tr>

<tr>
<td colspan="7">&nbsp;</td>
<td colspan="2" align="right"><font color="blue"><b>Total Amount Collected</b></font></td>
<td><font color="blue"><b> $<?php echo $amt_rec; ?> </b></font></td>
</tr>

<tr>
<td colspan="7">&nbsp;</td>
<td colspan="2" align="right"><b><font color="red">Balance Due</font></b></td>
<td><font color="red"><b> 
<?php 
$get_total = $am_received - $amt_rec;
if( $get_total < 0 )
{ echo "<font color='green'>$".$get_total."</font>" ; }
else
{ echo "<font color='red'>$".$get_total."</font>" ; }


 ?>   </b></font></td>
</tr>

                        </tbody>
                    </table>
                </div>
            </div>            


        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
                        $(document).ready(function () {
                            $(".flashmessage").delay(3000).fadeOut(100);
                        });
</script>
