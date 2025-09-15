<!DOCTYPE html>
<html>
<head>
    <title>PHP Signature Pad Example - ItSolutionStuff.com</title>
  
    <script type="text/javascript" src="./sig2/jquery-3.6.0.min"></script> 
  <!-- 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
-->
 <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
 <script type="text/javascript" src="./sig2/js/jquery.ui.touch-punch.min.js"></script>

  
    <script type="text/javascript" src="./sig2/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./sig2/css/jquery.signature.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 	
  
    <style>
        .kbw-signature { width: 200px; height: 50px;}
        #sig canvas{
            width: 200 !important;
            height: auto;
        }
    </style>
  
</head>
<body>
  
<div class="container">
  
    <form method="POST" action="upload.php">
  
        <h1>PHP Signature Pad Example - ItSolutionStuff.com</h1>
  
        <div class="col-md-12">
            <label class="" for="">Signature:</label>
            <br/>
            <div id="sig" ></div>
            <br/>
            <button id="clear">Clear Signature</button>
            <textarea id="signature64" name="signed" style="display: none"></textarea>
        </div>
  
        <br/>
        <button class="btn btn-success">Submit</button>
    </form>
  
</div>
  
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>
  
</body>
</html>