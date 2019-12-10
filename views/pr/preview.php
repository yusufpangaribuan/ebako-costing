<center>
    <table border='0' width='890' bgcolor="white" align="center" style="color: black;">
        <tr valign="top">
            <td valign='top' alt='' style="color: black;">
                <fieldset style="min-height: 300px;margin-right: 10px;">
                    <table border='0' width='99%'>
                        <tr valign="top">
                            <td colspan="4" align="center"><span style="font-size: 14pt;font-weight: bold;">Purchase Requisition</span></td>
                        </tr>  
                        <tr>
                            <td colspan="4"><br/></td>
                        </tr>
                        <tr>
                            <td valign='top' width='30%'>
                                <?php echo $company->name . "<br/>" . nl2br($company->address); ?>
                            </td>
                            <td valign='top' width='10%' style="color: black">
                                &nbsp;
                            </td>
                            <td valign='top' width='30%'>
                                <table border='0' width='100%'>											
                                    <tr><td width='30%'>PR No</td><td width='1%'>:</td><td width='69%'><b><?php echo $pr->requestnumber ?></b></td></tr>
                                    <tr><td>Request Date</td><td>:</td><td><b><?php echo date('d/m/Y', strtotime($pr->requestdate)) ?></b></td></tr>
                                    <tr><td>Printed Date</td><td>:</td><td><b><?php echo date('d/m/Y') ?></b></td></tr>
                                </table>
                            </td>
                            <td valign='top' width='30%'>
                                <table border='0' width='100%'>
                                    <tr valign='top'><td width='30%'>Requested By</td><td width='10%'>:</td><td width='69%'><b><?php echo $this->model_pr->get_all_department_by_id($pr->id);//$pr->departmentname ?></b></td></tr>                                    
                                    <tr valign='top'><td>SO NO.</td><td>:</td><td><b><?php echo $pr->sonumber ?></b></td></tr>
                                    <tr valign='top'><td>MR NO.</td><td>:</td><td><b><?php echo str_replace(',', ', ', $pr->mr_num); ?></b></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                    <br/>
                    <center>
                        <table border='0' width='99%' align="center" cellpadding="0" cellspacing="2" style="border-collapse: collapse;">
                            <thead>
                                <tr BGCOLOR="#CCCCCC">
                                    <th width="2%" style="border: 1px solid black;">No</th>
                                    <th width="10%" style="border: 1px solid black;">Code</th>                            
                                    <th width="15%" style="border: 1px solid black;">Description</th>            
                                    <th width="10%" style="border: 1px solid black;">Qty</th>
                                    <th width="10%" style="border: 1px solid black;">Price</th>
                                    <th width="15%" style="border: 1px solid black;">Amount</th>										
                                    <th width="25%" style="border: 1px solid black;">Vendor</th>
                                    <th width="10%" style="border: 1px solid black;">MR NO</th>
                                </tr>
                            </thead>
                            <?php
                            if (!empty($pritem)) {
                                $counter = 1;
                                foreach ($pritem as $pritem) {
                                    ?>
                                    <tr>
                                        <td valign='top' align="right" style="border: 1px solid black;padding: 1px;"><?php echo $counter++; ?>&nbsp;</td>
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->itempartnumber; ?>&nbsp;</td>                                
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo nl2br($pritem->itemdescription); ?>&nbsp;</td>
                                        <td valign='top' align='right' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->qty . " / " . $pritem->unitname; ?>&nbsp;</td>
                                        <td valign='top' align='right' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->currency . " " . number_format($pritem->price, 2, '.', ','); ?>&nbsp;</td>
                                        <td valign='top' align='right' style="border: 1px solid black;padding: 1px;"><?php echo number_format(($pritem->price * $pritem->qty), 2, '.', ','); ?>&nbsp;</td>												
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo ($pritem->vendorname == "") ? "-" : $pritem->vendorname; ?>&nbsp;</td>
                                        <td valign='top' style="border: 1px solid black;padding: 1px;"><?php echo $pritem->mr_number; ?>&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>                    
                        </table>    
                    </center>
                    <br/>
                    <br/>
                    <br/>
                    <table border='0' width='70%' align='left' style="float: bottom">
                        <tr>
                            <td class='approved'>Prepared</td>
                            <td class='approved'>Checked</td>
                            <td class='approved'>Acknowledge</td>
                            <td class='approved'>Approved</td>
                        </tr>
                        <tr>
                            <?php
                            foreach ($approval as $result) {
                                if ($result->outstanding == 't') {
                                    echo "<td valign='top' style='color:blue'>Out Standing<br/></td>";
                                } else {
                                    echo "<td valign='top'>" . $result->timeapprove . "<br/></td>";
                                }
                            }
                            ?>
                        </tr>
                        <tr>
                            <?php
                            foreach ($approval as $result) {
                                echo "<td valign='top'>" . $result->name . "<br/></td>";
                            }
                            ?>
                        </tr>
                    </table>
                </fieldset>
            </td>        
        </tr>
    </table>
    <?php
    if ($st == 0) {
        ?>
                    <!--<a href="<?php echo base_url() . 'index.php/pr/preview/' . $prid . "/1"; ?>" target="blank"><button>Print</button></a>-->
        <?php
    } else if ($st == 1) {
        echo "<script>window.print()</script>";
    } else if ($st == 2) {
        echo "<button onclick='pr_approve(" . $prid . "," . $this->model_approval->getOutStandingApprovalIdByEmployeeAndPr($this->session->userdata('id'), $prid) . ",1,2)'>Approve</button>";
        echo "<button onclick='pr_approve(" . $prid . "," . $this->model_approval->getOutStandingApprovalIdByEmployeeAndPr($this->session->userdata('id'), $prid) . ",2,2)'>Pending</button>";
        echo "<button onclick='pr_approve(" . $prid . "," . $this->model_approval->getOutStandingApprovalIdByEmployeeAndPr($this->session->userdata('id'), $prid) . ",3,2)'>Reject</button><br/>";
    }
    ?>
    <br/>
    <br/>
</center>