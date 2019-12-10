<html>
    <head>
        <title>Ebako Resources Planning</title>       
        <!--<link type="text/css" rel="stylesheet" href="jquery-ui-1.9.2.custom/development-bundle/demos/demos.css"  />-->
        <!--<link type="text/css" rel="stylesheet" href="jquery-ui-1.9.2.custom/development-bundle/themes/custom-theme/jquery.ui.all.css" />-->
        <link type="text/css" rel="stylesheet" href="jquery-ui-1.9.2.custom/development-bundle/themes/custom-theme/jquery-ui.css" />        
        <!--<link type="text/css" rel="stylesheet" href="css/layout-default-latest.css">-->
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <script type="text/javascript">var url ='<?php echo base_url() ?>' + 'index.php/';</script>
        <script type="text/javascript" src="jquery-ui-1.9.2.custom/js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="jquery/ajaxfileupload.js"></script>        
        <script type="text/javascript" src="jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script type="text/javascript" src="jquery/jquery.scrollableFixedHeaderTable.js" ></script>
        <script type="text/javascript" src="jquery/jquery.cookie.pack.js" ></script>
        <script type="text/javascript" src="jquery/jquery.layout-latest.js" ></script>
        <script type="text/javascript" src="jquery/jquery.validate.js" ></script>
<!--        <script type="text/javascript" src="jquery/jquery.dimensions.min.js" ></script>-->
        <script type="text/javascript" src="js/global.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('body').layout({applyDemoStyles: true});
            });
        </script>
    </head>
    <body id="bodydata">
        <div class="ui-layout-north header" style="height: 180px;">
            <table cellpadding="0" cellspacing="0" width="100%" border="0">
                <tr valign="top">
                    <td width="70%" style="padding-left: 5px;">
                        <span style="font-size: 32px;text-shadow: inherit; color: #f7ff1d; letter-spacing: 5px;font-weight: bold;font-family: Georgia,'Times New Roman',Times,serif;">ERP</span><br/>
                        <span style="color: #ffffff;font-size: 12px;font-style:inherit;">Ebako Resources Planning</span>
                    </td>                            
                    <td width="30%">
                        <div style="float: right; position: relative;bottom: 0;right: 0;vertical-align: bottom;padding-top: 35px;">
                            <span style="font-size: 12px;color: #ebf3ff;">Login as: </span>
                            <img src="images/account.png" style="cursor: pointer;vertical-align: middle"/>
                            <span style="font-size: 12px;color: #f7ff1d;"><?php echo $this->session->userdata('id') . "/" . $this->model_employee->getNameById($this->session->userdata('id')) ?></span>
                            | <a href="<?php echo base_url() ?>index.php/home/logout" style="text-decoration: none;"><span style="font-size: 12px;color: #b02121;">&nbsp;Log out</span>&nbsp;&nbsp;<img src="images/Logout-icon.png" style="cursor: pointer;vertical-align: middle"/>&nbsp;</a>
                        </div>
                    </td>
                </tr>
            </table>
            <div id='cssmenu'>
                <ul>
                    <li><a href="<?php echo base_url() ?>"><img src="images/home.png"/>&nbsp;<span>HOME</span></a></li>
                    <?php
                    //if ($this->session->userdata('id') == "admin") {
                    ?>
                    <li><a href="javascript:void(0)" onclick="user_view()"><img src="images/user_group.png"/>&nbsp;<span>User & Groups</span></a></li>
                    <?php
                    //}
                    ?>

                    <li><a href="javascript:void(0)" onclick="user_changepassword()"><img src="images/password2.png"/>&nbsp;<span>Change Password</span></a></li>                                

                </ul>
            </div>
        </div>
        <div class="ui-layout-west">
            <div class="panel2" style="border: none;width: 200px">
                <h4>Menu</h4>
                <div class="menu_simple">                                        
                    <ul><span style="font-weight: bold;color: black"></span>
                        <li><a href="<?php echo base_url() ?>">&nbsp;HOME</a></li>
                        <?php
                        foreach ($accessmenu as $result) {
                            ?>
                            <li><a href="javascript:void(0)" onclick="<?php echo str_replace("/", "_", $result->scriptmenu) ?>_view()">&nbsp;<?php echo $result->label ?></a></li>
                            <?php
                        }
                        ?>
<!--                                            <li><a href="javascript:void(0)" onclick="report_view()">&nbsp;<span>Report</span></a></li>                                -->
                    </ul>                                
                </div>
            </div>
        </div>
        <div class="ui-layout-center" id='messagelistcontainer'>
            <h4>Dash Board</h4>
            <div style="margin-top: 10px;text-align: center;font-size: 11pt;color: #2c5c29;">
                Welcome! <?php echo $this->model_employee->getNameById($this->session->userdata('id')) ?><br/>
                You have <?php echo count($proutstanding) . " PR , " . count($mat_req_outstanding) . " MR , " . count($sroutstanding) . " SR, " . count($mroutstanding) . " MW, " . count($po) . " PO Close approval/outstanding"; ?>
            </div><br/>
            <div style="width: 100%">
                <table width="100%" border="0">
                    <tr>
                        <td width="50%" align="center">
                            <div style="width: 100%">
                                <span style="font-size: 12px;color: #2c5c29;font-weight:bold;">Your PR Outstanding Approval</span>
                                <script type="text/javascript">
                                    /* make the table scrollable with a fixed header */
                                    $(function () {
                                        $('#my_pr_pending').scrollableFixedHeaderTable('100%', '120');
                                    });
                                </script><br/>
                                <table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="my_pr_pending" align="center">
                                    <thead>
                                        <tr>
                                            <th width="10">No.</th>
                                            <th width="30%">PR NO</th>
                                            <th width="30%">Date</th>
                                            <th width="30%">Department</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($proutstanding)) {
//                                            print_r($proutstanding);
                                            $no = 1;
                                            foreach ($proutstanding as $result) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $no++; ?></td>
                                                    <td align="center"><a onclick="pr_preview(<?php echo $result->id ?>, 2)" style="text-decoration: none;" href="javascript:void(0)"><?php echo $result->requestnumber ?></a></td>
                                                    <td align="center"><?php echo date('d/m/Y', strtotime($result->requestdate)) ?></td>
                                                    <td align="center"><?php echo $result->departmentname ?></td>                                    
                                                </tr>                                                
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5">No PR Outstanding..</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </td>
                        <td width="50%" align="center">
                            <div style="width: 100%">
                                <span style="font-size: 12px;color: #2c5c29;font-weight:bold;">Your MW Outstanding Approval</span>
                                <script type="text/javascript">
                                    /* make the table scrollable with a fixed header */
                                    $(function () {
                                        $('#my_mw_outstanding').scrollableFixedHeaderTable('102%', '120');
                                    });
                                </script><br/>
                                <table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="my_mw_outstanding" align="center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>MW NO</th>
                                            <th>Date</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                       
                                        <?php
                                        if (!empty($mroutstanding)) {
                                            $no = 1;
                                            foreach ($mroutstanding as $result) {
//                                            print_r($result);
                                                if ($result->supervisorapproval == $this->session->userdata('id') && ($result->supervisorstatusapproval == 0 || $result->supervisorstatusapproval == 2)) {
                                                    ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no++; ?></td>
                                                        <td align="center">
                                                            <a onclick="mr_viewdetail(<?php echo $result->id ?>, 2)" href="javascript:void(0)"><?php echo $result->number ?></a></td>
                                                        <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                                                        <td align="center"><?php echo $this->model_department->getNameById($result->departmentid) ?></td>
                                                        <td align="center">
                                                            <?php
                                                            echo "<button onclick=mr_approve(" . $result->id . ",'" . $this->session->userdata("id") . "',1,1,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=mr_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',2,1,1)>Pending</button>&nbsp;";
                                                            echo "<button onclick=mr_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',3,1,1)>Reject</button>";
                                                            ?>
                                                        </td>
                                                    </tr>                                                
                                                    <?php
                                                } else if ($result->managerapproval == $this->session->userdata('id') && $result->supervisorstatusapproval == 1) {
                                                    ?>
                                                    <tr>
                                                        <td align="center"><?php echo $no++; ?></td>
                                                        <td align="center">
                                                            <a onclick="mr_viewdetail(<?php echo $result->id ?>, 2)" href="javascript:void(0)"><?php echo $result->number ?></a></td>
                                                        <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                                                        <td align="center"><?php echo $this->model_department->getNameById($result->departmentid) ?></td>
                                                        <td align="center">
                                                            <?php
                                                            echo "<button onclick=mr_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',1,2,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=mr_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',2,2,1)>Pending</button>&nbsp;";
                                                            echo "<button onclick=mr_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',3,2,1)>Reject</button>";
                                                            ?>
                                                        </td>
                                                    </tr>                                                
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="5">No MW Outstanding..</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td width="50%" align="center">
                            <div style="width: 100%">
                                <span style="font-size: 12px;color: #2c5c29;font-weight:bold;">Your MR Outstanding Approval</span>
                                <script type="text/javascript">
                                    /* make the table scrollable with a fixed header */
                                    $(function () {
                                        $('#my_mr_outstanding').scrollableFixedHeaderTable('100%', '150');
                                    });
                                </script><br/>
                                <table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="my_mr_outstanding" align="center">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th width="10%">MR NO</th>
                                            <th width="10%">Date</th>                                            
                                            <th width="20%">Request By</th>
                                            <th width="20%">Department</th>                                           
                                            <th width="39%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //print_r($mat_req_outstanding);
                                        if (!empty($mat_req_outstanding)) {
                                            $no = 1;
                                            foreach ($mat_req_outstanding as $result) {
                                                if ($result->supervisorapproval == $this->session->userdata('id') && ($result->supervisorstatusapproval == 0 || $result->supervisorstatusapproval == 2)) {
                                                    ?>
                                                    <tr>
                                                        <td align="right"><?php echo $no++; ?></td>
                                                        <td><a onclick="materialrequisition_viewdetail(<?php echo $result->id ?>, 2)" style="text-decoration: none;" href="javascript:void(0)"><?php echo $result->number ?></a></td>
                                                        <td><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                                                        <td><?php echo $result->name_requested ?></td>                                    
                                                        <td><?php echo $result->departmentname ?></td>                                    
                                                        <td>
                                                            <?php
                                                            echo "<button onclick=materialrequisition_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',1,1,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=materialrequisition_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',2,1,1)>Pending</button>&nbsp;";
                                                            echo "<button onclick=materialrequisition_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',3,1,1)>Reject</button>";
                                                            ?>
                                                        </td>
                                                    </tr>                                                
                                                    <?php
                                                } else if ($result->managerapproval == $this->session->userdata('id') && $result->supervisorstatusapproval == 1) {
                                                    ?>
                                                    <tr>
                                                        <td align="right"><?php echo $no++; ?></td>
                                                        <td><a onclick="materialrequisition_viewdetail(<?php echo $result->id ?>, 2)" style="text-decoration: none;" href="javascript:void(0)"><?php echo $result->number ?></a></td>
                                                        <td><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                                                        <td><?php echo $result->name_requested ?></td>
                                                        <td><?php echo $result->departmentname ?></td>                                    
                                                        <td>
                                                            <?php
                                                            echo "<button onclick=materialrequisition_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',1,2,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=materialrequisition_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',2,2,1)>Pending</button>&nbsp;";
                                                            echo "<button onclick=materialrequisition_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',3,2,1)>Reject</button>";
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No MR Outstanding..</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </td>
                        <td width='50%' align='center'>
                            <div style="width: 100%">
                                <span style="font-size: 12px;color: #2c5c29;font-weight:bold;">Your SR Outstanding Approval</span>
                                <script type="text/javascript">
                                    /* make the table scrollable with a fixed header */
                                    $(function () {
                                        $('#my_sr_outstanding').scrollableFixedHeaderTable('100%', '150');
                                    });
                                </script><br/>
                                <table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="my_sr_outstanding" align="center">
                                    <thead>
                                        <tr>
                                            <th width="1%">No.</th>
                                            <th width="10%">SR NO</th>
                                            <th width="10%">Date</th>                                            
                                            <th width="20%">Request By</th>
                                            <th width="20%">Department</th>                                           
                                            <th width="39%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //print_r($mat_req_outstanding);
                                        if (!empty($sroutstanding)) {
                                            $no = 1;
                                            foreach ($sroutstanding as $result) {
                                                if ($result->approval1 == $this->session->userdata('id') && ($result->approval1_status == 0 || $result->approval1_status == 2)) {
                                                    ?>
                                                    <tr>
                                                        <td align="right"><?php echo $no++; ?></td>
                                                        <td><a onclick="servicerequest_viewdetail(<?php echo $result->id ?>, 2)" style="text-decoration: none;" href="javascript:void(0)"><?php echo $result->number ?></a></td>
                                                        <td><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                                                        <td><?php echo $result->name_requested ?></td>                                    
                                                        <td><?php echo $result->departmentname ?></td>                                    
                                                        <td>
                                                            <?php
                                                            echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',1,1,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',2,1,1)>Pending</button>&nbsp;";
                                                            echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',3,1,1)>Reject</button>";
                                                            ?>
                                                        </td>
                                                    </tr>                                                
                                                    <?php
                                                } else if ($result->approval2 == $this->session->userdata('id') && $result->approval1_status == 1) {
                                                    ?>
                                                    <tr>
                                                        <td align="right"><?php echo $no++; ?></td>
                                                        <td><a onclick="servicerequest_viewdetail(<?php echo $result->id ?>, 2)" style="text-decoration: none;" href="javascript:void(0)"><?php echo $result->number ?></a></td>
                                                        <td><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                                                        <td><?php echo $result->name_requested ?></td>
                                                        <td><?php echo $result->departmentname ?></td>                                    
                                                        <td>
                                                            <?php
                                                            echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',1,2,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',2,2,1)>Pending</button>&nbsp;";
                                                            echo "<button onclick=servicerequest_approve(" . $result->id . ",'" . $this->session->userdata('id') . "',3,2,1)>Reject</button>";
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">No SR Outstanding..</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>  
                            </div>
                        </td>
                    </tr>

                    <?php
                    if (!empty($po)) {
                        ?>
                        <tr>
                            <td width="50%">
                                <div style="width: 100%">
                                    <span style="font-size: 12px;color: #2c5c29;font-weight:bold;">Your PO Close Outstanding Approval</span>
                                    <script type="text/javascript">
                                        /* make the table scrollable with a fixed header */
                                        $(function () {
                                            $('#my_po_close_outstanding').scrollableFixedHeaderTable('100%', '150');
                                        });
                                    </script><br/>
                                    <table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="my_po_close_outstanding">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>PO NO#</th>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($po as $result) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $no++; ?></td>
                                                    <td align="center"><a onclick="po_view_detail_new(<?php echo $result->id ?>, 2)" style="text-decoration: none;" href="javascript:void(0)"><?php echo $result->ponumber ?></a></td>
                                                    <td align="center"><?php echo date('d/m/Y', strtotime($result->dates)) ?></td>
                                                    <td><?php echo $this->model_vendor->getNameById($result->vendorid) ?></td> 
                                                    <td><?php echo $result->statusdescription; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($result->closeapprovallevel1 == $this->session->userdata('id') && ($result->approvallevel1status == 0 || $result->approvallevel1status == 2)) {
                                                            echo "<button onclick=po_approveclose(" . $result->id . ",1,1)>Approve</button>&nbsp;";
                                                            echo "<button onclick=po_approveclose(" . $result->id . ",2,1)>Cancel</button>";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>                                                
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td width="50%">&nbsp;</td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2" align='center'>
                            <?php
                            if (in_array($this->session->userdata('department'), array(1, 2, 9, 6))) {
                                ?>
                                <div align="center" style="width: 100%;min-height: 270px;margin-top: 2px;" class="panel">
                                    <h4>Sales Order Outstanding</h4><br/>
                                    <table class="tablesorter" width="80%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>SO NUMBER</th>
                                                <th>DATE</th>
                                                <th>SHIP TO</th>
                                                <th>SHIP ADDRESS</th>
                                                <th>OUTSTANDING BY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if (!empty($so)) {
                                                foreach ($so as $result) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td align="center"><?php echo $result->number ?></td>
                                                        <td align="center"><?php echo date('d/m/Y', strtotime($result->date)); ?></td>
                                                        <td><?php echo $result->billtoname ?></td>
                                                        <td><?php echo $result->shiptoname ?></td>
                                                        <td align="center">
                                                            <?php
                                                            if ($result->isprocess == 0) {
                                                                echo "MARKETING";
                                                            } else {
                                                                if ($result->rndapprove == 'f') {
                                                                    echo "R & D";
                                                                } else if ($result->costingapproval == 'f') {
                                                                    echo "COSTING";
                                                                } else if ($result->managementapproval == 'f') {
                                                                    echo "MANAGEMENT";
                                                                } else {
                                                                    echo "MARKETING";
                                                                    echo "<br/>Waiting approve from custome";
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            }
                            if ($this->session->userdata('department') == 10) {
                                ?>
                                <div align="center" style="width: 100%;min-height: 270px;margin-top: 2px;" class="panel">
                                    <h4 style="margin-bottom: 5px;">New Order Recommendation</h4>
                                    <table class="tablesorter2 scrollableFixedHeaderTable" id="tbl_s_ord_rec_qzx" width="99%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                                <th>MOQ</th>
                                                <th>R-O point</th>
                                                <th>Stock</th>
                                            </tr>                                                            
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($item)) {
                                                $no = 1;
                                                foreach ($item as $result) {
                                                    ?>
                                                    <tr>
                                                        <td align="right" width="2%"><?php echo $no++ ?></td>
                                                        <td width="10%"><?php echo $result->partnumber ?></td>
                                                        <td width="48%"><?php echo nl2br($result->descriptions) ?></td>
                                                        <td width="10%" align="center"><?php echo $result->unitcode ?></td>
                                                        <td width="10%" align="center"><?php echo $result->moq ?></td>
                                                        <td width="10%" align="center"><?php echo $result->reorderpoint ?></td>
                                                        <td width="10%" align="center"><?php echo $result->totalstock ?></td>
                                                    </tr>
                                                    <?php
                                                    if ($no == 9) {
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>                           

                                    <script type="text/javascript">
                                        /* make the table scrollable with a fixed header */
                                        $(function () {
                                            $('#tbl_s_ord_rec_qzx').scrollableFixedHeaderTable('100%', '210');
                                        });
                                    </script>
                                    There are <?php echo count($item) ?> Item recommended to order <a href="javascript:void(0)" onclick="item_viewallrecommendedtoorder()">View All</a>
                                </div>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>

                </table>
            </div>
        </div>        
        <div class="ui-layout-south" style="background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #458245 0px, #4c9678 50%) repeat-x scroll 0 0;color: #f8f8f8;"><center>Created By PT. Karya Data Solusi 2014</center></div>
        <div id="dialog" style="display: none"></div>
        <div id="dialog2" style="display: none"></div>
        <div id="dialog3" style="display: none"></div>
        <div id="dialog4" style="display: none"></div>
        <div id="dialog_temp" style="display: none"></div>
        <div id="form_dialog" style="display: none"></div>
    </body>
</html>
