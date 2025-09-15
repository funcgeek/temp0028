<!DOCTYPE html>
<html>
<head>  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="./dist/js/jquery.signature.min.js"></script>
    <script type="text/javascript" src="./dist/js/jquery.ui.touch-punch.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./dist/css/jquery.signature.css">
  
    <style>
        .kbw-signature { width: 300px; height: 50px;}
        #sig canvas{
            width: 300 !important;
            height: auto;
        }
    </style>
  
</head>
<body>
  
<div class="container">
  
    <form method="POST" >  
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