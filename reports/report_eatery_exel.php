<?php
//Создание табличного файла для всех класов 


	// Подключаем класс для работы с excel
	require_once('../lib/phpexel/Classes/PHPExcel.php');
	// Подключаем класс для вывода данных в формате excel
	require_once('../lib/phpexel/Classes/PHPExcel/Writer/Excel5.php');
	
	session_start();
	include("../lib/connect.php");
	
	 if(empty($_SESSION['date'])) {
	 	$date = date("Y-m-d");
	 }
	 else {
	 	$date=$_SESSION['date'];
	 }
	
	
	// Создаем объект класса PHPExcel
	$xls = new PHPExcel();

	for($numberList = 1; $numberList < 12; $numberList++) {
		$xls->createSheet();
		$xls->setActiveSheetIndex($numberList);
		$sheet = $xls->getActiveSheet();
		$sheet->getPageSetup()
		       ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$sheet->getPageSetup()
		       ->SetPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		// Поля документа
		$sheet->getPageMargins()->setTop(1);
		$sheet->getPageMargins()->setRight(0.75);
		$sheet->getPageMargins()->setLeft(0.75);
		$sheet->getPageMargins()->setBottom(1);
		// Подписываем лист
		$sheet->setTitle($numberList.'-e классы');
		
		// Вставляем текст в ячейку A1
		$sheet->setCellValue("A1", 'Данные на 2018-05-03');

		 
		// Объединяем ячейки
		$sheet->mergeCells('A1:F1');

		$sheet->setCellValue("A2", 'Класс');
		$sheet->setCellValue("B2", 'Кол-во детей');
		$sheet->setCellValue("C2", 'Кол-во льготников');
		$sheet->setCellValue("D2", 'Ф.И.О. льготников');
		$sheet->setCellValue("E2", 'Классный руководитель');
		$sheet->setCellValue("F2", 'Время добавления');
		 
		$sql = "SELECT * FROM eatery WHERE date = '$date' AND class = '$numberList' ORDER BY class_name";	
		if (!$result = $mysqli->query($sql)) {
		    // О нет! запрос не удался. 
		    echo "Извините, возникла проблема в работе сайта.";
		
		    // И снова: не делайте этого на реальном сайте, но в этом примере мы покажем, 
		    // как получить информацию об ошибке:
		    echo "Ошибка: Наш запрос не удался и вот почему: \n";
		    echo "Запрос: " . $sql . "\n";
		    echo "Номер_ошибки: " . $mysqli->errno . "\n";
		    echo "Ошибка: " . $mysqli->error . "\n";
		    exit;
		}
				
		$styleArray = array(
  									'borders' => array(
 								'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN))
				);
		$sheet->getStyle('A1:F2')->applyFromArray($styleArray);
		$sheet->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		$sheet->getStyle('A1:F2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$sheet->getStyle('A1:F2')->getAlignment()->setWrapText(true);
				
		$i=0;
		$j=3;		
		while ($request = $result->fetch_assoc()) {
			$sheet->setCellValueByColumnAndRow($i, 
										  $j,
										  $request['class'] . $request['class_name']);
			$sheet->setCellValueByColumnAndRow($i+1, 
										  $j,
										  $request['count']);
			$sheet->setCellValueByColumnAndRow($i+2, 
										  $j,
										  $request['count_lg']);		
														  
			$request['names_lg'] = str_replace(array("\r","\n")," ",$request['names_lg']);													  								
			$sheet->setCellValueByColumnAndRow($i+3, 
										  $j,
										  $request['names_lg']);							
			$sheet->getStyle('D'.$j)->getAlignment()->setWrapText(true);	
			
			$sheet->setCellValueByColumnAndRow($i+4, 
										  $j,
										  $request['teacher']);				
			$sheet->setCellValueByColumnAndRow($i+5, 
										  $j,
										  $request['time']);	
			//рамка для содержимого		
			for($ii = 0; $ii < 6; $ii++) {							  
				$sheet->getStyleByColumnAndRow($ii, $j)->applyFromArray($styleArray);
				$sheet->getStyleByColumnAndRow($ii, $j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				$sheet->getStyleByColumnAndRow($ii, $j)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sheet->getStyleByColumnAndRow($ii, $j)->getAlignment()->setWrapText(true);														  					  									  
			}
			    
	   	$j++;
		}
		$sheet->getColumnDimension('A')->setWidth(10);
		$sheet->getColumnDimension('B')->setWidth(10);
		$sheet->getColumnDimension('C')->setWidth(15);
		$sheet->getColumnDimension('D')->setWidth(25);
		$sheet->getColumnDimension('E')->setWidth(20);
		$sheet->getColumnDimension('F')->setWidth(15);
	}
	


// Выводим HTTP-заголовки
	header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
	header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
	header ( "Cache-Control: no-cache, must-revalidate" );
	header ( "Pragma: no-cache" );
	header ( "Content-type: application/vnd.ms-excel" );
	header ( "Content-Disposition: attachment; filename=matrix.xls" );
// Выводим содержимое файла
	$objWriter = new PHPExcel_Writer_Excel5($xls);
	$objWriter->save('php://output');
?>