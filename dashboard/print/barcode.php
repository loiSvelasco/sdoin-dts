<html>
<head>
<style>
	body {
		font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	}
p.inline {display: inline-block;}
span { font-size: 9px; line-height: 1.8;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
		
    }
</style>
</head>
<body onload="window.print();">
	<div style="float: right; margin-right: 6%;">
		<?php
		require_once("../../config.php");
		include 'barcode128.php';

		$tracking = escape_string($_GET['tracking']);
		echo "<p class='inline'><span><b>sdoin | Tracking no.</b></span>".bar128(stripcslashes($tracking))."</p>";
		
		?>
	</div>
</body>
</html>