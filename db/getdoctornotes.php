<style>
.thumbnail_img {
    position: relative;
    z-index: 0;
}

.thumbnail_img:hover {
    background-color: transparent;
    z-index: 10;
}

.thumbnail_img span img { 
    display: inline-block;
}

.thumbnail_img span { 
    position: absolute;
    visibility: hidden;
    color: black;
    text-decoration: none;
}

.thumbnail_img:hover span { /* CSS for enlarged image on hover */
    visibility: visible;
    background: transparent;
    top: 0px;
    height: auto;
    width: auto;
    border: 0;
    z-index: 10;
}

/* Button styling */
.action-buttons {
    margin-top: 10px;
    overflow: hidden; /* Clearfix for floating buttons */
}

.view-btn-set, .download-btn-set {
    padding: 10px 20px;
    font-size: 14px;
    font-weight: 600;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: 8px; /* Space between icon and text */
    text-decoration: none; /* Ensure no underline for anchor tags */
}

.view-btn-set {
    float: left;
    background: #3498db; /* Blue for view */
}

.view-btn-set:hover {
    background: #2980b9;
}

.download-btn-set {
    float: right;
    background: #2ecc71; /* Green for download */
}

.download-btn-set:hover {
    background: #27ae60;
}
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php
include('db.php');	

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $query = "SELECT * FROM medical_history WHERE id=" . $id;
    $stmt = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($stmt, MYSQLI_ASSOC);
    extract($row);
    ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr><th>Date: </th><td><?php echo date('d-m-Y', $date); ?></td></tr>
            <tr><th>Location: </th><td><?php echo $location; ?></td></tr>
            <tr><th>Doctor: </th><td><?php echo $doctor_name; ?></td></tr>
            <tr><th>Title: </th><td><?php echo $title; ?></td></tr>
            <tr><th>Description: </th><td><?php echo $description; ?></td></tr>				
            <tr><th>Written Notepad: </th>
                <td>
                    <div class="mytest" id="slideshow-carousel">
                        <a href="#" rel="p1" class="thumbnail_img">
                            <img src="<?php echo $doc_notepad; ?>" style="height:400px; width:400px" alt="Notepad Image"/>
                            <span><img src="<?php echo $doc_notepad; ?>" style="height:500px; width:500px" /></span>
                        </a>
                
                    </div>
         
                </td>
            </tr>				
        </table>
                           <div class="action-buttons">
                        <a href="<?php echo $doc_notepad; ?>" target="_blank" class="view-btn-set">
                            <i class="fas fa-eye"></i> View Image
                        </a>
                        <a href="download.php?file=<?php echo urlencode($doc_notepad); ?>" class="download-btn-set">
                            <i class="fas fa-download"></i> Download Image
                        </a>
                    </div>
    </div>
<?php } ?>