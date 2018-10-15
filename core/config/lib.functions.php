<?php

function sendJson($html){
	header('Content-Type: application/json;charset=utf-8');
	echo json_encode(array('status'=>STATUS_OK,'html'=>$html));
}

function sendJsonData($data){
	header('Content-Type: application/json;charset=utf-8');
	echo json_encode(array('status'=>STATUS_OK,'data'=>$data));
}

function exportToExcel($datos,$titulos,$nombre_archivo,$properties = array()){
	if(!$properties){
		unset($properties);
		$properties = array('creator'=>"Web Validadora",
							 'modificado'=>"Web Validadora",
							 'titulo'=>"Reporte",
							 'tema'=>"",
							 'descripcion'=>"",
							 'key'=>'office 2007 openxml',
							 'categoria'=>"Reportes");
	}
	require_once(dirname(__FILE__)."/util/PHPExcel-1.8/Classes/PHPExcel.php");

	$hoy = new DateTime();
	$fecha_tmp = $hoy->getTimestamp();

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator($properties['creator'])
								 ->setLastModifiedBy($properties['modificado'])
								 ->setTitle($properties['titulo'])
								 ->setSubject($properties['tema'])
								 ->setDescription($properties['descripcion'])
								 ->setKeywords($properties['key'])
								 ->setCategory($properties['categoria']);
	
	$letra = "A";
	foreach ($titulos as $key=>$titulo) {
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($letra.'1', $titulo);
		$objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);
		if(end($titulos) == $titulo){
			break;
		}
		$letra ++;
	}
	
	$objPHPExcel->getActiveSheet()->setAutoFilter('A1:'.$letra.'1');
	$objPHPExcel->getActiveSheet()->freezePane('A2');
	$objPHPExcel->getActiveSheet()->setSelectedCell('A1');

	$data = array();
	
	foreach ($datos as $key => $value) {
		$tmp_data = array();
		foreach ($titulos as $key=>$titulo) {
			array_push($tmp_data, $value->$key);
		}
		$data[] = $tmp_data;
		unset($tmp_data);
	}

	$objPHPExcel->getActiveSheet()->fromArray($data, null, 'A2');
	// header para descaragr via Jquery.FileDownload
	header('Set-Cookie: fileDownload=true; path=/');
	header('Cache-Control: max-age=60, must-revalidate');

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="'.$nombre_archivo.'-'.$fecha_tmp.'.xlsx"');
	header('Cache-Control: max-age=0');
	// para IE 9
	header('Cache-Control: max-age=1');

	// IE sobre SSL
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	exit;
}

function getCurrentUri()
{
    $uri = urldecode($_SERVER['REQUEST_URI']);
    $split = explode('?',$uri);
    $uri=$split[0];
    if (substr($uri,0,1)=='/')
    {
      $uri=substr($uri,1);
    }
    $prmuri=explode('/',$uri);

    return $prmuri;
}

function getPrm($index){
    global $url_format;
    if(count($url_format)>$index){
    	if($url_format[$index]){
			return $url_format[$index];
		}else{
			return '';
		}
    }
}
