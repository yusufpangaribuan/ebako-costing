<?php
$this->excel->setActiveSheetIndex(0);


$coloum = array(
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
    'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB',
    'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN',
    'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
    'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL',
    'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX',
    'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ',
    'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV'
);

$row = 1;
$this->excel->getActiveSheet()->setTitle('Stock Out ');
$this->excel->getActiveSheet()->setCellValue('A' . $row, "PT. EBAKO NUSANTARA\n" . $company->address);
$this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(50);
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(10);
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->mergeCells('A' . $row . ':H' . $row);

$row++;
$this->excel->getActiveSheet()->setCellValue('A' . $row, "STOCK OPNAME");
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->mergeCells('A' . $row . ':H' . $row);


$row +=2;

$this->excel->getActiveSheet()->setCellValue('A' . $row, "ID");
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->mergeCells('A' . $row . ':B' . $row);

$this->excel->getActiveSheet()->setCellValue('C' . $row, ": " . $stockopname->stockopname_no);
$this->excel->getActiveSheet()->getStyle('C' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->mergeCells('C' . $row . ':H' . $row);

$row++;
$this->excel->getActiveSheet()->setCellValue('A' . $row, "Date");
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->mergeCells('A' . $row . ':B' . $row);

$this->excel->getActiveSheet()->setCellValue('C' . $row, ": " . $stockopname->date);
$this->excel->getActiveSheet()->getStyle('C' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->mergeCells('C' . $row . ':H' . $row);

$row++;
$this->excel->getActiveSheet()->setCellValue('A' . $row, "Description");
$this->excel->getActiveSheet()->getStyle('A' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->mergeCells('A' . $row . ':B' . $row);

$this->excel->getActiveSheet()->setCellValue('C' . $row, ": " . $stockopname->description);
$this->excel->getActiveSheet()->getStyle('C' . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->mergeCells('C' . $row . ':H' . $row);

$col = 0;
$row += 2;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'NO');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(4);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Group');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(9);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Item Code');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(8);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Item Description');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(45);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Unit');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(6);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Stock');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(8);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Real Stock');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(8);

$col++;
$this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, 'Difference');
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setBold(true);
$this->excel->getActiveSheet()->getColumnDimension($coloum[$col])->setWidth(8);

$no = 1;
$row++;

foreach ($detail as $result) {
    $col = 0;
    $this->excel->getActiveSheet()->getRowDimension($row)->setRowHeight(11);
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $no++);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->group_code);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->item_code);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->item_description);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->unit_code);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->stock);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->real_stock);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $col++;
    $this->excel->getActiveSheet()->setCellValue($coloum[$col] . "" . $row, $result->difference);
    $this->excel->getActiveSheet()->getStyle($coloum[$col] . "" . $row)->getFont()->setSize(8);

    $row++;
}

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$this->excel->getActiveSheet()->getStyle("A8:" . $coloum[$col] . "" . $row)->applyFromArray($styleArray);

$filename = "stockopname.xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
$objWriter->save('php://output');
