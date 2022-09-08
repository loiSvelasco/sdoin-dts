<html>
<head>
<style>
	
	@import url('https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Libre+Barcode+128&family=Libre+Barcode+128+Text&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Libre+Barcode+128&family=Libre+Barcode+128+Text&family=Libre+Barcode+39&display=swap');
	
	body {
		font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
	}
	p.inline {
		display: inline-block;
	}

	span#codeFont {
		font-family: 'Libre Barcode 128', cursive;
		font-size: 48px;
		display: inline-block;
	}
	span { 
		font-size: 10px;
	}
	span#number { 
		font-size: 10px;
	}
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
	<div style="float: right; margin-right: 6%; line-height: 18px">
		<?php
		require_once("../../config.php");
		include 'barcode128.php';

		$tracking = '*' . escape_string($_GET['tracking']) . '*';

		echo "<p class='inline'><span><b>sdoin | Tracking no.</b></span>".bar128(stripcslashes($tracking))."</p>";

		$ellapie = <<<LALA
		<p><span><b>sdoin | Tracking no.</b></span></p>
		<span id="codeFont">$tracking</span><br>
		<span id="number"><b>$tracking</b></span>
LALA;
		// echo $ellapie;	
		?>
	</div>
</body>
</html>