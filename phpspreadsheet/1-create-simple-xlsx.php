<?php
//include the file that loads the PhpSpreadsheet classes
require 'spreadsheet/vendor/autoload.php';

//include the classes needed to create and write .xlsx file
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//object of the Spreadsheet class to create the excel data
$spreadsheet = new Spreadsheet();

//add some data in excel cells
$spreadsheet->setActiveSheetIndex(0)
 ->setCellValue('A1', 'Domain')
 ->setCellValue('B1', 'Category')
 ->setCellValue('C1', 'Nr. Pages');


$spreadsheet->setActiveSheetIndex(0)
 ->setCellValue('A2', 'CoursesWeb.net')
 ->setCellValue('B2', 'Web Development')
 ->setCellValue('C2', '4000');

$spreadsheet->setActiveSheetIndex(0)
 ->setCellValue('A3', 'MarPlo.net')
 ->setCellValue('B3', 'Courses & Games')
 ->setCellValue('C3', '15000');

//set style for A1,B1,C1 cells
$cell_st =[
 'font' =>['bold' => true],
 'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
 'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
];
$spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($cell_st);

//set columns width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(16);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);

$spreadsheet->getActiveSheet()->setTitle('Simple'); //set a title for Worksheet

//make object of the Xlsx class to save the excel file
$writer = new Xlsx($spreadsheet);
$fxls ='excel-file_1.xlsx';
$writer->save($fxls);

//check if excel created
if(file_exists($fxls)) echo $fxls .' succesfully created';
else echo 'Unable to write: '. $fxls;