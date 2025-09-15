
<?php
/*
    $query1 = "SELECT * FROM products";
    $result1 = mysqli_query($con, $query1);
    $options = "";
    while($row3 = mysqli_fetch_array($result1))
    {
        $options = $options."<option value='$row3[1]'>$row3[2]</option>";
    }
*/
?>



<SCRIPT language="javascript">
//function that increases the table row
function addRow(dataTable) {
    var table = document.getElementById("dataTable");
    var rowCount = table.rows.length;
   // if (rowCount < 4) { // limit the user from creating fields more than your limits
        var row = table.insertRow(rowCount);
        var colCount = table.rows[1].cells.length;
        row.id = 'row_'+rowCount;
        for (var i = 0; i < colCount; i++) {
            var newcell = row.insertCell(i);
            newcell.outerHTML = table.rows[1].cells[i].outerHTML;            
        }
        var listitems= row.getElementsByTagName("input")
        for (i=0; i<listitems.length; i++) {
            listitems[i].setAttribute("oninput", "calculate('"+row.id+"')");
        }

  //  } else {
//alert("Maximum Row Reached.");
  //  }
}
//function that reduces the table row
function deleteRow(dataTable) {
    var table = document.getElementById("dataTable");
    var rowCount = table.rows.length;
    for (var i = 1; i < rowCount; i++) {
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null !== chkbox && true === chkbox.checked) {
            if (rowCount <= 2) { // limit the user from removing all the fields
                alert("Cannot Remove all the Rows.");
                break;
            }
            table.deleteRow(i);
            rowCount--;
            i--;
        }
    }
}
//function that handles the summing of each row & all last column
function calculate(elementID) {
    var mainRow = document.getElementById(elementID);
    var myBox12 = mainRow.querySelectorAll('[id=item')[0].value;
    var myBox23 = mainRow.querySelectorAll('[id=descript')[0].value;
    var myBox1 = mainRow.querySelectorAll('[id=uprice')[0].value;
    var myBox2 = mainRow.querySelectorAll('[id=price')[0].value;
    var total = mainRow.querySelectorAll('[id=qty')[0];
    var subtotal = mainRow.querySelectorAll('[id=sumtotal')[0];
	
    var multiplier = Number(myBox2) || 0;
    var myResult1 = myBox1 * multiplier;
    var mresult = myResult1.toFixed(2);                          
    total.value = mresult;
	console.log();
}

</SCRIPT>


<table id="dataTable" class="form"> 
<thead> 
<th style="width:20px"></th> 
<th>Item</th> 
<th>Description</th> 
<th>Unit Price</th> 
<th>Item Units</th> 
<th>Sub Total (#)</th> 
</thead> 

<tbody> 
<tr id='row_0'> 
	<td><input style="width:20px" type="checkbox" name="chkbox[]" /> </td> 
	<td> <select required="required" name="item" id="item" placeholder="Item"> <option value="0"> 0</option><option value="1">1</option></select> </td> 
	<td> <input type="text" required="required" class="small" name="descript" id="descript" placeholder="Description"> </td> 
	<td> <input type="text" required="required" name="uprice[]" oninput="calculate('row_0')" id="uprice" placeholder="unit price"> </td> 
	<td> <input type="text" required="required" class="small" name="price[]" oninput="calculate('row_0')" id="price" placeholder="units" value="0"> </td> 
	<td> <input type="text" required="required" class="small" name="qty[]" id="qty" placeholder="sub total" value="0.00" readonly="readonly" style="background-color: white"> </td> 
	<td> <input type="text" required="required" class="small" name="sumtotal[]" id="sumtotal" readonly="readonly" style="background-color: white"> </td> 
</tr> 
</tbody> 

</table> 

<span id="mee"></span> 
	<input type="button" value="Add" onClick="addRow('dataTable')" class="button" /> 
	<input type="button" value="Remove" onClick="deleteRow('dataTable')" class="button"/> 