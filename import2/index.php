<?php

session_start();
// Load the database configuration file
include_once 'dbConfig.php';

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Frames data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid Excel file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

$username = $_REQUEST['user'];
//print_r ($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Import Frames from Excel</title>

<!-- Bootstrap library -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<!-- Stylesheet file -->
<link rel="stylesheet" href="assets/css/style.css">

<!-- Show/hide Excel file upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</head>
<body>

<div class="container-fluid p-3">
    <h1>Import Excel File</h1>
	<?php

?>
    <h2>Frames List</h2>
    
    <!-- Display status message -->
    <?php if(!empty($statusMsg)){ ?>
    <div class="col-xs-12 p-3">
        <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
    </div>
    <?php } ?>
    
    <div class="row p-3">
        <!-- Import link -->
        <div class="col-md-12 head">
            <div class="float:left">
                <a href="http://ispecs-server/medicine/frameList" class="btn btn-danger"><i class="plus"></i> BACK TO INVENTORY <i class="plus"></i></a>
            </div>            
			<div class="float-end">
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import Excel</a>
            </div>
        </div>
        <!-- Excel file upload form -->
        <div class="col-md-12" id="importFrm" style="display: none;">
            <form class="row g-3" action="importFrames.php" method="post" enctype="multipart/form-data">
                <div class="col-auto">
                    <label for="fileInput" class="visually-hidden">File</label>
                    <input type="file" class="form-control" name="file" id="fileInput" />
                    <input type="hidden" class="form-control" name="user2" value="<?php echo $username; ?>" />
                </div>
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
                </div>
            </form>
            <div class="float-end" style="clear: both;">
                <a href="assets/Sample-Excel-Format.xlsx" download target="_blank">Download Sample Format</a>
            </div>
        </div>
    
        <!-- Data list table --> 
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Frame Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Category</th>
                    <th>Mobay Avail.</th>
                    <th>Falmouth Avail.</th>
                    <th>Mobay Qty.</th>
                    <th>Falmouth Qty.</th>
                    <th>Price</th>
                    <th>Added By</th>
                    <th>Date Added</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Get member rows
            $result = $db->query("SELECT * FROM medicine where type = 'frames' ORDER BY id DESC");
            if($result->num_rows > 0){ $i=0;
                while($row = $result->fetch_assoc()){ $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['effects']; ?></td>
                    <td><?php echo $row['box']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['location_2']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['quantity_2']; ?></td>
                    <td><?php echo $row['s_price']; ?></td>
                    <td><?php echo $row['user']; ?></td>
                    <td><?php echo $row['add_date']; ?></td>
                </tr>
            <?php } }else{ ?>
                <tr><td colspan="7">No Frame(s) found...</td></tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>