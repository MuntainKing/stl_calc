<?php

@include ( '../stlcalc.php' );

$allowedExts	= array ( 'stl' );
$value			= explode ( '.', $_FILES['file']['name'] );
$extension		= strtolower ( end ( $value ) );
$uploaddir 		= '..\..\uploads\\';
$uploadfile 	= $uploaddir . basename($_FILES['file']['name']);
$fn = $_FILES['file']['name'];

if( in_array ( $extension, $allowedExts ) ) {
	if ( $_FILES['file']['error'] > 0 ) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br><br>';
	} else {
			
		$filename = $_FILES['file']['tmp_name'];
		$obj = new STLCalc ( $filename );
		echo '<br><br><b>Результаты расчета:</b><br>';
		$unit = 'cm';
		$vol = $obj->GetVolume ( $unit );
		$unit = 'сантиметров';
		echo 'Объём: ' . $vol . ' ' . $unit . '<br>';
		echo 'Стоимость : ' . intval($vol * 9999) .' рублей <br>';
?>
		<button> Оплатить </button>
		
        <div id="stl_cont" style="width:500px;height:500px;margin-top:20px;border:1px solid black;"></div>
		

		<script src="three.min.js"></script>
		<script src="stl_viewer.min.js"></script>
		<script src="parser.min.js"></script>
		<script src="webgl_detector.js"></script>
		<script src="CanvasRenderer.js"></script>
		<script src="OrbitControls.js"></script>
		<script src="TrackballControls.js"></script>
		<script src="Projector.js"></script>

		
		
        <script>
		
            var stl_viewer=new StlViewer
            (
				
                document.getElementById("stl_cont"),
                {
                    models:
                    [
                        {filename:"..\\..\\uploads\\<?php echo $fn; ?>"}
                    ]
                }
				
            );
			
        </script>
		

		
<?php
	
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
			//echo "File is valid, and was successfully uploaded.\n";
		} else {
			//echo "Possible file upload attack!\n";
		}

	}
} else {
	echo 'File too large or bad file extension.';
}

	
function my_autoloader($class) {
    include 'classes/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');

?>


