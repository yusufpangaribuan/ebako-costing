<?php

$this->mytcpdf->setPageOrientation('P', true, 1);
$this->mytcpdf->SetCompression(true);
$this->mytcpdf->setPrintHeader(false);
$this->mytcpdf->setPrintFooter(false);
$this->mytcpdf->SetMargins(2, 2, 2);
$this->mytcpdf->SetFont('', '', 8.5);
$this->mytcpdf->AddPage();

$tbl = '<table cellpadding="0" width="100%" cellspacing="0">
    <tr>
        <td style="border-bottom: 0.1px #000000 double;">' . $company->name . '<br/>' . nl2br($company->address) . '</td>
    </tr>
    <tr>
        <td align="center"><br/><br/>
            <span style="font-weight:bold;font-size:12pt;letter-spacing: 2px;"><u>PURCHASE ORDER</u></span><br/>
            <span style="font-style: italic;font-size:11pt">ORDER PEMBELIAN</span>
        </td>
    </tr>
    </table>
';
$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');

$tbl = '
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr valign="top">
            <td width="50%" valign="top">
                <table width="100%">
                    <tr valign="top">
                        <td width="35%" style="font-weight: bold;">To<br/><span style="font-size:7pt;font-style:italic">Kepada</span></td>
                        <td width="1%" style="font-weight: bold;">:</td>
                        <td width="64%" style="font-weight: bold;padding:5px;">&nbsp;' . $po->vendorname . '</td>
                    </tr>
                    <tr valign="top">
                        <td style="font-weight: bold;">Address<br/><span style="font-size:7pt;font-style:italic">Alamat</span></td>
                        <td>:</td>
                        <td style="font-weight: bold;">&nbsp;' . nl2br($po->address1) . '</td>
                    </tr>
                    <tr valign="top">
                        <td style="font-weight: bold;">Phone No.<br/><span style="font-size:7pt;font-style:italic">No.Telephone</span></td>
                        <td style="font-weight: bold;">:</td>
                        <td style="font-weight: bold;">&nbsp;' . nl2br($po->phone) . '</td>
                    </tr>
                    <tr valign="top">
                        <td colspan="3">
                            Please send us the following items: <br/>Mohon dikirim barang-barang seperti tersebut dibawah ini:
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50%">
                <table width="100%">
                    <tr valign="top">
                        <td width="35%" style="font-weight: bold;">Order No.<br/><span style="font-size:7pt;font-style:italic">No. Order</span></td>
                        <td width="1%" style="font-weight: bold;">:</td>
                        <td width="64%" style="font-weight: bold;">&nbsp;' . $po->ponumber . '</td>
                    </tr>
                    <tr valign="top">
                        <td style="font-weight: bold;">Order Date<br/><span style="font-size:7pt;font-style:italic">Tanggal Order</span></td>
                        <td style="font-weight: bold;">:</td>
                        <td style="font-weight: bold;">&nbsp;' . date("d/m/Y", strtotime($po->dates)) . '</td>
                    </tr>
                    <tr valign="top">
                        <td style="font-weight: bold;">Delivery Date.<br/><span style="font-size:7pt;font-style:italic">Tanggal Pengiriman</span></td>
                        <td style="font-weight: bold;">:</td>
                        <td style="font-weight: bold;">&nbsp;' . ((!empty($po->deliveryterm) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $po->deliveryterm)) ? date("d/m/Y", strtotime($po->deliveryterm)) : $po->deliveryterm) . '</td>
                    </tr>
                    <tr valign="top">
                        <td style="font-weight: bold;">Terms Of Payment.<br/><span style="font-size:7pt;font-style:italic">Pembayaran</span></td>
                        <td style="font-weight: bold;">:</td>
                        <td style="font-weight: bold;">&nbsp;' . ((!empty($po->payterm) && preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $po->payterm)) ? date('d/m/Y', strtotime($po->payterm)) : $po->payterm) . '</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
';

$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');


$tbl = '
<table border="0" cellspacing="0" cellspacing="0" width="100%" style="border-collapse:collapse">
    <thead>
        <tr>
            <td width="4%" align="center" style="border: 0.1px solid black;"><b>NO.<BR><i>No.</i></b></td>
            <td width="10%" align="center" style="border: 0.1px solid black;"><B>NO. PP<BR><i>No. PP</i></B></td>            
            <td width="10%" align="center" style="border: 0.1px solid black;"><B>Code<BR><i>Kode</i></B></td>
            <td width="30%" align="center" style="border: 0.1px solid black;"><B>DESCRIPTION<br/><i>Nama Barang</i></B></td>
            <td width="8%" align="center" style="border: 0.1px solid black;"><B>Qty</B></td>
            <td width="5%" align="center"  style="border: 0.1px solid black;"><B>Unit</B></td>
            <td width="15%" align="center" style="border: 0.1px solid black;"><B>U/Price</B></td>
            <td width="18%" align="center" style="border: 0.1px solid black;"><b>Amount<br/>Harga Total</b></td>
        </tr>
    </thead>';
$qtytotal = 0;
$row = 10;


if (!empty($poitem)) {
    $counter = 1;
    foreach ($poitem as $pritem) {
        $tbl .= '<tr valign="top" nobr="true">               
                    <td width="4%" align="right" style="border-right: 0.1px solid black;border-left: 0.1px solid black;">' . $counter++ . '</td>
                    <td width="10%" style="border-right: 0.1px solid black;">' . $pritem->mat_req_number . $pritem->sr_number . '&nbsp;</td>            
                    <td width="10%" style="border-right: 0.1px solid black;">' . $pritem->itempartnumber . '&nbsp;</td>
                    <td width="30%" style="border-right: 0.1px solid black;">' . $pritem->itemdescription . '&nbsp;</td>
                    <td width="8%" align="center" style="border-right: 0.1px solid black;">' . number_format($pritem->qty) . '&nbsp;</td>
                    <td width="5%" align="center"  style="border-right: 0.1px solid black;">' . $pritem->unitcode . '&nbsp;</td>
                    <td width="15%" align="right" style="border-right: 0.1px solid black;">' . (in_array('hide_price', $accessmenu) ? "-" : $pritem->currency . ' ' . number_format($pritem->price, 2)) . '&nbsp;</td>
                    <td width="18%" align="right" style="border-right: 0.1px solid black;">' . (in_array('hide_price', $accessmenu) ? "-" : number_format($pritem->total, 2)) . '&nbsp;</td>
                </tr>';
        $qtytotal += $pritem->qty;
        $row--;
    }
}

if ($row > 0) {
    for ($i = 0; $i < $row; $i++) {
        $tbl .= '<tr valign="top" nobr="true">               
                    <td width="4%" align="right" style="border-right: 0.1px solid black;border-left: 0.1px solid black;">&nbsp;</td>
                    <td width="10%" style="border-right: 0.1px solid black;">&nbsp;</td>            
                    <td width="10%" style="border-right: 0.1px solid black;">&nbsp;</td>
                    <td width="30%" style="border-right: 0.1px solid black;">&nbsp;</td>
                    <td width="8%" align="center" style="border-right: 0.1px solid black;">&nbsp;</td>
                    <td width="5%" align="center"  style="border-right: 0.1px solid black;">&nbsp;</td>
                    <td width="15%" align="right" style="border-right: 0.1px solid black;">&nbsp;</td>
                    <td width="18%" align="right" style="border-right: 0.1px solid black;">&nbsp;</td>                    
                </tr>';
    }
}

$tbl .= '<tr valign="top" nobr="true">               
            <td width="4%" align="right" style="border-right: 0.1px solid black;border-left: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>
            <td width="10%" style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>            
            <td width="10%" style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>
            <td width="30%" style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>
            <td width="8%" align="center" style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>
            <td width="5%" align="center"  style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>
            <td width="15%" align="right" style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>
            <td width="18%" align="right" style="border-right: 0.1px solid black;border-bottom: 0.1px solid black;">&nbsp;</td>                    
        </tr>';
$tbl .='</table>';
$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');

$tbl = '
    <table border="0" cellspacing="0" cellspacing="0" width="100%" style="border-collapse:collapse" nobr="true">    
        <tr>               
            <td width="80%" colspan=6 align="right"><strong>Disc ' . (in_array('hide_price', $accessmenu) ? '-' : $po->discount_percentage) . ' %&nbsp;&nbsp;&nbsp;:</strong></td>            
            <td width="20%" colspan=2 align="right">' . (in_array('hide_price', $accessmenu) ? "-" : number_format($po->discount, 2, '.', ',')) . '&nbsp;</td>                    
        </tr>
        <tr>               
            <td width="80%" colspan=6 align="right"><strong>Sub Total (' . $po->currency . ')&nbsp;&nbsp;&nbsp;:</strong></td>            
            <td width="20%" colspan=2 align="right">' . (in_array('hide_price', $accessmenu) ? "-" : number_format($po->grandtotal, 2, '.', ',')) . '&nbsp;</td>                    
        </tr>
        <tr>               
            <td width="80%" colspan=6 align="right"><strong>PPn ' . (in_array('hide_price', $accessmenu) ? "-" : $po->ppn_percentage) . ' %&nbsp;&nbsp;&nbsp;:</strong></td>            
            <td width="20%" colspan=2 align="right">' . (in_array('hide_price', $accessmenu) ? "-" : number_format($po->ppn, 2, '.', ',')) . '&nbsp;</td>                    
        </tr>
    </table>';
$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');

$tbl = '
        <table border="0" cellspacing="0" cellspacing="0" width="100%" style="border-collapse:collapse" nobr="true">
            <tr valign="top" nobr="true">               
                <td width="54%" colspan="4" align="center" style="border: 0.1px solid black;"><strong>GRAND TOTAL</strong></td>
                <td width="8%" align="center" style="border: 0.1px solid black;">' . $qtytotal . '</td>                
                <td width="38%" colspan="3" align="right" style="border: 0.1px solid black;"><strong>' . (in_array('hide_price', $accessmenu) ? "-" : ($po->currency . '&nbsp;&nbsp;' . number_format($po->all_total_price, 2))) . '&nbsp;</strong></td>                    
            </tr> 
        </table>';
$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');

$approval = $this->model_approval->selectApprovalPr($po->prid);
$content_order_by = '<b><br/><i>Submitted at </i>: <br/><br/></b>';
$myfile = "./signature/" . $approval[0]->employeeid . ".png";
if (file_exists($myfile)) {
    $content_order_by = '<img src="' . base_url() . '/signature/' . $approval[0]->employeeid . '.png" width="30" height="40"/><br/>';
}

$tbl = '
        <table border="0" cellspacing="0" cellspacing="0" width="100%" style="border-collapse:collapse" nobr="true">
            <tr valign="top" nobr="true">               
                <td width="35%" align="center" style="border-left: 0.1px solid black;border-top: 0.1px solid black;border-bottom: 0.1px solid black;">
                <strong>Order By<br/>Dipesan Oleh</strong><br/>
                ' . $content_order_by . '
                <span style="font-size:8pt">' . date('d/m/Y h:i', strtotime($approval[0]->timeapprove)) . '</span><br/> 
                <strong>' . strtoupper($approval[0]->name) . '</strong>    
                </td> 
                <td width="30%" align="center" style="border-top: 0.1px solid black;border-bottom: 0.1px solid black;">
                &nbsp;
                </td>
                <td width="35%" align="center"style="border-right: 0.1px solid black;border-top: 0.1px solid black;border-bottom: 0.1px solid black;">
                <strong>Accepted & Agreed By<br/>Diterima & disetujui oleh</strong>
                <br/><br/><br/><br/>
                (............................)
                </td>                    
            </tr> 
        </table>';
$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');

$content_aknowledge = '<b><i>Aknowledge at </i></b>: <br/><br/><br/>';
$myfile = "./signature/" . $approval[2]->employeeid . ".png";
if (file_exists($myfile)) {
    $content_aknowledge = '<img src="' . base_url() . '/signature/' . $approval[2]->employeeid . '.png" width="80" height="40"/><br/>';
}

$content_checked = '<b><i>Checked at </i></b>: <br/><br/><br/>';
$myfile = "./signature/" . $approval[1]->employeeid . ".png";
if (file_exists($myfile)) {
    $content_checked = '<img src="' . base_url() . '/signature/' . $approval[1]->employeeid . '.png" width="80" height="40"/><br/>';
}

$content_approved = '<b><i>Approved at </i></b>: <br/><br/><br/>';
$myfile = "./signature/" . $approval[3]->employeeid . ".png";
if (file_exists($myfile)) {
    $content_approved = '<img src="' . base_url() . '/signature/' . $approval[3]->employeeid . '.png" width="80" height="40"/><br/>';
}

$tbl = '
  <table width="100%" cellpadding="0" cellspacing="0" nobr="true">
        <tr>
            <td width="40%" rowspan="2" style="border:0.1px solid black;">&nbsp;</td>
            <td width="20%" style="border:0.1px solid black;" align="center"><strong>Aknowledge<BR>Diketahui</strong></td>
            <td width="20%" style="border:0.1px solid black;" align="center"><strong>Checked<BR>Diperiksa</strong></td>
            <td width="20%" style="border:0.1px solid black;" align="center"><strong>Approved<BR>Disetujui</strong></td>
        </tr>
        <tr>
            <td width="20%" style="border:0.1px solid black;" align="center">
            ' . $content_aknowledge . '
            <span style="font-size:8pt">' . date('d/m/Y h:i', strtotime($approval[2]->timeapprove)) . '</span><br/><strong>' . strtoupper($approval[2]->name) . '</strong>
            </td>
            <td width="20%" style="border:0.1px solid black;" align="center">
            ' . $content_checked . '
            <span style="font-size:8pt">' . date('d/m/Y h:i', strtotime($approval[1]->timeapprove)) . '</span><br/><strong>' . strtoupper($approval[1]->name) . '</strong>
            </td>
            <td width="20%" style="border:0.1px solid black;" align="center">
            ' . $content_approved . '
            <span style="font-size:8pt">' . date('d/m/Y h:i', strtotime($approval[3]->timeapprove)) . '</span><br/><strong>' . strtoupper($approval[3]->name) . '</strong>
            </td>
        </tr>
        <tr>
            <td colspan="4" width="100%">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td width="33%">Original for supplier</td>
                    <td width="34%" align="center">Copy for purchasing (1)</td>
                    <td width="33%" align="right">copy for accounting (2 & 3)</td>
                </tr>
            </table>
            </td>
        </tr>
  </table>  
';

if ($st == 4) {
    $tbl .= '<br/><table width="100%">
        <tr>
            <td>
                <i>';
    if ($po->printed == 0) {
        $tbl .= 'Original';
    } else {
        $tbl .= 'Copied ' . ($po->printed);
    }
    $tbl .= '</i>
        </td>
    </tr>
</table>';
}

$this->mytcpdf->writeHTML($tbl, true, false, false, false, '');

$this->mytcpdf->Output('example_048.pdf', 'I');

