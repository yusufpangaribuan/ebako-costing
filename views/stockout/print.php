<?php

echo "<html>
    <head>
        <title>&nbsp;</title>";
if ($st == 1) {

    echo "<STYLE>
                <!-- 
                *{
                    padding:1px;
                    margin:1px;
                }
                body,table{ font-family:'Calibri'; }               
                -->
            </STYLE>";
}
echo "</head>
    <body>
    <center>
        <div style='width: 100%;border: 1px solid #000000;min-height: 400px;'>
            <table width='99%' style='border: none'>
                <tr>
                    <td style='border: none;font-family:Calibri' width='40%'>" . $company->name . "<br>" . nl2br($company->address) . "</td>
                    <td style='border: none;text-align: center;'><span style='font-size: 24px;'><b>STOCK OUT</b></span></td>
                </tr>
            </table><br/><br/>
            <table width='99%' style='border: none'>
                <tr>
                    <td width='20%' style='border: none;font-family:Calibri'><b><span style='font-size: 14px;'>STOCK OUT NO</span></b></td>
                    <td width='30%' style='border: none;font-family:Calibri'><font size='3'><b>: " . $stockout->number . "</b></font></td>
                    <td width='20%' style='border: none;font-family:Calibri'><b><span style='font-size: 14px;'>REF NO</span></b></td>
                    <td width='30%' style='border: none;font-family:Calibri'><font size='3'><b>: " . $stockout->refno . "</b></font></td>
                </tr>
                <tr>
                    <td width='20%' style='border: none;font-family:Calibri'><b>DATE</b></td>
                    <td width='30%' style='border: none;font-family:Calibri'><font size='3'><b>: " . date('d/m/Y', strtotime($stockout->date)) . "</b></font></td>
                    <td width='20%' style='border: none;font-family:Calibri'><b>OUT BY</b></td>
                    <td width='30%' style='border: none;font-family:Calibri'><font size='3'><b>: " . $stockout->outby . "</b></font></td>
                </tr>
                <tr>
                    <td width='20%' style='border: none;font-family:Calibri'><b>DEPARTMENT</b></td>
                    <td width='30%' style='border: none;font-family:Calibri'><font size='3'><b>: " . $this->model_department->getNameById($stockout->departmentid) . "</b></font></td>
                    <td width='20%' style='border: none;font-family:Calibri'><b>RECEIVE BY</b></td>
                    <td width='30%' style='border: none;font-family:Calibri'><font size='3'><b>: " . $stockout->receiveby . "</b></font></td>
                </tr>
            </table><br/><br/><br/>
            <table width='99%' class='tablesorter' cellpadding='0' cellspacing='0' align='center'>
                <thead>
                    <tr>
                        <th width='20%' style='font-family:Calibri;padding:2px;padding: 5px;border-width:1px 1px 1px 1px;border-color: #000000;border-style: solid;'><font size='4'>Code</font></th>                                
                        <th width='40%' style='font-family:Calibri;padding:2px;padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;'><font size='4'>Description</font></th>                    
                        <th width='10%' style='font-family:Calibri;padding:2px;padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;'><font size='4'>Unit</font></th>
                        <th width='10%' style='font-family:Calibri;padding:2px;padding: 5px;border-width:1px 1px 1px 0px;border-color: #000000;border-style: solid;'><font size='4'>Qty</font></th>
                    </tr>
                </thead>
                <tbody>";
$count_row = 10;
foreach ($stockoutdetail as $result) {
    echo "<tr valign='top'>
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;'><font size='3'><b>" . $result->code . "</b></font></td>
                            <td style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'><font size='3'><b>" . $result->descriptions . "</b></font></td>                        
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'><font size='3'><b>" . $result->unitcode . "</b></font></td>                                   
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'><font size='3'><b>" . $result->qty . "</b></font></td>
                        </tr>";
    $count_row--;
}
if ($count_row > 0) {
    for ($i = $count_row; $i > 0; $i--) {
        echo "<tr valign='top'>
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 1px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                            <td style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>                        
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>                                   
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 0px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                        </tr>";
    }
}
echo "<tr valign='top'>
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 1px 1px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                            <td style='font-family:Calibri;padding:2px;border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>                        
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>                                   
                            <td align='center' style='font-family:Calibri;padding:2px;border-width:0px 1px 1px 0px;border-color: #000000;border-style: solid;padding: 2px;'>&nbsp;</td>
                        </tr>";
echo "</tbody>
            </table>
            <br/>
            <br/>        
        </div>
        Print on " . date('d/m/Y H:i:s');
if ($st == 1) {
    echo "<script>window.print()</script>";
} else {
    echo "<br/>
                <a href='" . base_url() . "index.php/stockout/prints/" . $stockout->id . "/1' target='blank'><button>Print</button></a>";
}

echo "</center>
</body>
</html>";
