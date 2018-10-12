<?php
 
$dataPoints = array( 
	array("label"=>"Online", "y"=>$onlineperc),
	array("label"=>"Offline", "y"=>$offlineperc),
)
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
        CanvasJS.addColorSet("mycolors",
                [//colorSet Array

                "rgb(76, 174, 81)",
                "rgb(192, 80, 78)",              
                ]);
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	backgroundColor: "rgb(56, 82, 102)",
	colorSet: "mycolors",
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 200px; width: 25vw;"></div>
<script src="js/canvasjs.min.js"></script>
</body>
</html>  