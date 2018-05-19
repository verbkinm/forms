 <?php
// классные руководители раз в неделю, вместе с табелем питания, должны относить подписанные от руки заявки на питание

	if($_POST['hide'] == "report_eatery_pdf") {
		include("../lib/connect.php");
	   define('FPDF_FONTPATH','../fonts/');
	   require('../lib/fpdf/fpdf.php');

		$width 			= 90;
		$height 			= 90;
		$line_spacing 	= 5;
		$row 				= 0;
		$column			= 0;
		
		$pdf 				= new FPDF('L','mm','A4');


		$pdf->AddPage();
		$pdf->AddFont('DejaVuSans','','DejaVuSans.php');
		$pdf->SetFont('DejaVuSans','',10);	

		$x = 10;
		$y = 10;
		$max_y = 0;
	
		$user_id = $mysqli->query("SELECT id FROM auth WHERE login = '$login'")->fetch_object()->id;

		$date_begin	= $_POST['date_begin'];
		$date_end	= $_POST['date_end'];
		$class 		= $_POST['class'];
		$class_name = $_POST['class_name'];
		$user_name	= $_POST['user_name'];
		

		$startDate = new DateTime($date_begin);
		$endDate = new DateTime($date_end);
		$period = new DatePeriod($startDate, new \DateInterval('P1D'), $endDate->modify('+1 day'));
		
		foreach ($period as $date) {
			global $x, $y, $max_y, $row, $column;
			
			$current_date = $date->format('Y-m-d');
													
			$sql 			= "SELECT * FROM `eatery` WHERE date = '$current_date' AND class = $class AND class_name = '$class_name' ";
			$result 		= check_error_db($mysqli, $sql);
			$request 	= $result->fetch_assoc();
			$count 		= $request['count'];
			$count_lg 	= $request['count_lg'];
			$names_lg	= $request['names_lg'];
			
			//new line
			if ( ($column == 3) && ($row == 0) ) { 
				$column 	= 0; 
				$row 		= 1; 
				$y 		= $y + $max_y;
			}
			if ( ($column == 3) && ($row == 1) ) {$row++;}
			if ( ($column == 3) && ($row == 2) ) { 
				$column 	= 0; 
				$row 		= 0; 
				$y 		= 10;
				$x 		= 10;
				$max_y	=0;
				$pdf->AddPage();				
			}	
			one_day($pdf, $x+$width*$column++, $y);
		}



		$mysqli->close();
		$pdf->Output('I','report.pdf',true); 
	}
	
	function one_day($pdf, $x, $y) {
		global $max_y, $width, $height, $line_spacing, $current_date, $class, $class_name, $count, $count_lg, $names_lg, $user_name;
				
		$pdf->setXY($x, $y);
		$pdf->Cell($width,$line_spacing,'Лицей им.Г.Ф.Атякшева',0,2,'C');
		$pdf->Cell($width,$line_spacing,'Заявки на питание',0,2,'C');
		$pdf->Cell($width,$line_spacing,'от '.$current_date.' г.',0,2,'R');
		$pdf->Cell($width,$line_spacing,'Класс: '.$class.$class_name,0,2,'L');
		$pdf->Cell($width,$line_spacing,'Количество: '.$count.' чел.',0,2,'L');
		$pdf->Cell($width,$line_spacing,'в т.ч. льготная карегория: '.$count_lg.' чел.',0,2,'L');
		
		$pdf->MultiCell($width, 5, $names_lg, 0, 'L',false);	
		
		$pdf->setXY($x,$pdf->GetY());
		$pdf->Cell($width,$line_spacing,'Кл. рук.: '.$user_name.' ___________ (подпись)',0,1,'L');
		$pdf->Rect($x, $y, $width, $pdf->GetY()-$y+3 );
		
		if( $pdf->GetY() > $max_y) {
			$max_y = $pdf->GetY();
		}
	}
?> 