<?php
include('db.php');

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    // Using prepared statements is safer to prevent SQL injection
    $query = "SELECT * FROM consent_form WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        // --- 1. Define variables based on form type ---
        $title = '';
        $patientName = '';
        $signatureImage = '';
        $baseURL = 'https://secure-emr.ispecsappeal.net/';

        switch ($row['form_type']) {
            case "Own Frame Consent":
                $title = "Own Frame Consent";
                $patientName = $row['disclaim_name'];
                $signatureImage = $row['disclaim_sign'];
                break;
            case "OCT Email Consent":
                $title = "OCT Email Consent";
                $patientName = $row['disclaim_name'];
                $signatureImage = $row['disclaim_sign'];
                break;
            case "Prescription Consent Form":
                $title = "Prescription Consent Form";
                $patientName = $row['consent_name'];
                $signatureImage = $row['consent_sign'];
                break;
        }

        // --- 2. Display the redesigned form if a valid type was found ---
        if ($title) {
?>

<style>
    .consent_letterhead_container {
        font-family: Arial, sans-serif;
        background-image: url('https://res.cloudinary.com/dabqwwyv2/image/upload/v1755893350/Isepcs/SetPrint2_hokyb1.png');
        background-repeat: no-repeat;
        background-size: 100% auto; /* Fit width, scale height */
        width: 800px; /* Standard document width */
        min-height: 1131px; /* A4 paper ratio to prevent background cutoff */
        margin: 20px auto; /* Center the view on the page */
        padding: 200px 60px 60px 60px; /* TOP, SIDES, BOTTOM padding to position content below the header */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 1px solid #ddd;
        box-sizing: border-box;
    }
    .consent_title {
        text-align: center;
        font-size: 26px;
        font-weight: bold;
        color: #333;
        margin-bottom: 40px;
        text-decoration: underline;
    }
    .consent_details {
        font-size: 16px;
        color: #555;
    }
    .consent_details .detail_row {
        display: flex;
        padding: 12px 5px;
        border-bottom: 1px solid #f0f0f0;
    }
    .consent_details .detail_row:last-child {
        border-bottom: none;
    }
    .consent_details .detail_label {
        font-weight: bold;
        color: #000;
        width: 150px; /* Fixed width for alignment */
        flex-shrink: 0;
    }
    .consent_details .detail_value {
        flex-grow: 1;
    }
    .signature_image {
        max-width: 200px;
        max-height: 75px;
        border: 1px solid #eee;
        border-radius: 4px;
    }
</style>

<div class="consent_letterhead_container">
    <h2 class="consent_title"><?php echo htmlspecialchars($title); ?></h2>
    
    <div class="consent_details">
        <div class="detail_row">
            <span class="detail_label">Name:</span>
            <span class="detail_value"><?php echo htmlspecialchars($patientName); ?></span>
        </div>
        <div class="detail_row">
            <span class="detail_label">Location:</span>
            <span class="detail_value"><?php echo htmlspecialchars($row['location']); ?></span>
        </div>
        <div class="detail_row">
            <span class="detail_label">Date:</span>
            <span class="detail_value"><?php echo htmlspecialchars($row['date']); ?></span>
        </div>
        <div class="detail_row">
            <span class="detail_label">Signature:</span>
            <span class="detail_value">
                <?php if (!empty($signatureImage)) : ?>
                    <img src="<?php echo $baseURL . htmlspecialchars($signatureImage); ?>" alt="Patient Signature" class="signature_image">
                <?php else : ?>
                    No signature provided.
                <?php endif; ?>
            </span>
        </div>
         <div class="detail_row">
            <span class="detail_label">User:</span>
            <span class="detail_value"><?php echo htmlspecialchars($row['nurse_name']); ?></span>
        </div>
    </div>
</div>

<?php
        } else {
            echo "<p>Unknown form type.</p>";
        }
    } else {
        echo "<p>No record found for this ID.</p>";
    }
    $stmt->close();
}
?>