<?php
include('db.php');    
    
if (isset($_REQUEST['id'])) {
    $id = intval($_REQUEST['id']); // Sanitize input
    $query = "SELECT * FROM patient_sickleave WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        extract($row);
        ?>
        
        <div class="table-responsive noprint">    
        <table class="table table-striped table-bordered">
        <tr>
        <th>ID</th>
        <td><?php echo htmlspecialchars($patient_id); ?></td>
        </tr>
        <tr>
        <th>Name</th>
        <td><?php echo htmlspecialchars($patient_first_name.' '.$patient_middle_name.' '.$patient_last_name); ?></td>
        </tr>        
        <tr>
        <th>Sick Days</th>
        <td><?php echo htmlspecialchars($days); ?></td>
        </tr>        
        <tr>
        <th>Date Started</th>
        <td><?php echo htmlspecialchars($start_date); ?></td>
        </tr>
        <tr>
        <th>Doctor</th>
        <td><?php echo htmlspecialchars($doctor_name); ?></td>
        </tr>    
        <tr>        
        <th>Description</th>
        <td><?php echo htmlspecialchars($description); ?></td>
        </tr>    
        <tr>
        <td colspan='2'><hr width="90%" /></td>
        </tr>        
        <tr>        
        <th>Signed?</th>
        <td><?php echo htmlspecialchars($d_sign); ?></td>
        </tr>    
        <?php if ($d_sign == 'Yes') { ?>
        <tr>        
        <th>Signature</th>
        <td><img src="<?php echo htmlspecialchars($doctor_sign); ?>" style="width:300px;height:auto;" /></td>
        </tr>
        <?php } else { ?>
        <tr>        
        <th>Signature</th>
        <td>No Signature was done</td>
        </tr>
        <?php } ?>
        </table>    
        </div>

<?php
$company = "SELECT * FROM settings";
$addcompany = mysqli_query($conn, $company);
?>

<div id="printableArea" style="display:none;">
    <table width="80%" cellspacing="5" cellpadding="5" align="center">
        <?php while ($row = mysqli_fetch_array($addcompany)) { ?>                        
        <tr><th><center><h3><?php echo htmlspecialchars($row['title']); ?></h3></center></th></tr>
        <tr><th><center><h4><?php echo htmlspecialchars($row['address']); ?><br><?php echo htmlspecialchars($row['phone']); ?></h4></center></th></tr>
        <?php } ?>
        <tr><td> </td></tr>        
        <tr><td><center><b>
            <h4><?php echo htmlspecialchars($doctor_name); ?> - <?php echo htmlspecialchars($postnomials); ?><br>
            <?php echo htmlspecialchars($profile); ?><br>
            Reg.#<?php echo htmlspecialchars($lic_number); ?></h4>
        </b></center></td></tr>
        <tr><td> </td></tr>
        <tr>
            <th colspan="2"><center><h4><u>MEDICAL CERTIFICATE</u></h4></center></th>                    
        </tr>
        <tr>
            <td colspan="2">
                This is to certify that <u><?php echo htmlspecialchars($patient_first_name." ".$patient_middle_name." ".$patient_last_name); ?></u> is a patient of mine at I SPECS APPEAL JAMAICA LTD. He/She is unable to carry out his/her duties for <u><?php echo htmlspecialchars($days); ?></u> days beginning on <?php echo htmlspecialchars($start_date); ?>.
            </td>
        </tr>
        <tr><td> </td></tr>
        <tr><td> </td></tr>
        <tr><td> </td></tr>
        <tr>
            <td colspan="2" align="right">
                <p><i>YOURS RESPECTFULLY</i></p>
                <p>_________________________________<br>
                <?php echo htmlspecialchars($doctor_name); ?> - <?php echo htmlspecialchars($postnomials); ?></p>
            </td>
        </tr>
    </table>
</div>

<?php            
    } else {
        echo "<p>No sick leave record found for ID: " . htmlspecialchars($id) . "</p>";
    }
    mysqli_stmt_close($stmt);
}
?>