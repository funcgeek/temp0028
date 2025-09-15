<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>jQuery UI Signature Basics</title>
<link href="jquery-ui.css" rel="stylesheet">
<link href="jquery.signature.css" rel="stylesheet">
<style>
.kbw-signature { width: 400px; height: 200px; }
</style>
<!--[if IE]>
<script src="excanvas.js"></script>
<![endif]-->
<script src="jquery.min.js"></script>
<script src="jquery-ui.min.js"></script>
<script src="jquery.signature.js"></script>
<script src="flashcanvas.js"></script>
<script>
$(function() {
	//var sig = $('#sig').signature();
	var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
//	var sigdiv = $("#sig").jSignature({'UndoButton':true})
	$('#disable').click(function() {
		var disable = $(this).text() === 'Disable';
		$(this).text(disable ? 'Enable' : 'Disable');
		sig.signature(disable ? 'disable' : 'enable');
	});
	$('#clear').click(function() {
		sig.signature('clear');
	});	
	

});

</script>
<script src="jSignature.js"></script>
<script src="jSignature.UndoButton.js"></script> 
</head>
<body>
    <form  method="post">
<p>Default signature:</p>

        <div class="col-md-12">
            <label class="" for="">Signature:</label>
            <br/>
            <div id="sig" ></div>
            <br/>
            <button id="clear">Clear Signature</button>
            <textarea id="signature64" name="signed" style="display: none">
			
			</textarea>
        </div>
        <input type="submit">
    </form>

</body>
</html>
