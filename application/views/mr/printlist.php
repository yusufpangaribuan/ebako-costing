<html>
    <head>
        <title>&nbsp;</title>        
        <STYLE>
            <!-- 
            BODY,table{ font-family:"verdana"; font-size:8pt; }
            table
            {
                border-collapse:collapse;
            }
            table, td, th
            {
                border:1px solid black;
            }
            -->
        </STYLE>
    </style>
</head>
<body>
<center>
    <div style="width: 900px">
        <table width="100%" style="border: none">
            <tr>
                <td style="border: none" width="35%">
                    <?php 
                    echo $company->name."<br/>".  nl2br($company->address);
                    ?>
                </td>
                <td style="border: none;text-align: center;"><h2>MATERIAL REQUEST</h2></td>
            </tr>
        </table><br/>

        <table width="100%" class="tablesorter">
            <thead>
                <tr bgcolor="#d8d8d8">
                    <th width="20">No</th>
                    <th>MR No.</th>
                    <th>DATE</th>                        
                    <th>REQUESTED BY</th>                        
                    <th>DEPARTMENT</th>
                    <th>MUST RECEIVE AT</th>
                    <th>REASON OF REQUIREMENT</th>
                    <th>APP SUPERVISOR</th>
                    <th>APP MANAGER</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($mr)) {
                    $no = 1;
                    foreach ($mr as $mr) {
                        ?>
                        <tr>
                            <td widtd="20" align="right"><?php echo $no++; ?></td>
                            <td align="center"><?php echo $mr->number ?></td>
                            <td align="center"><?php echo date('d/m/Y', strtotime($mr->date)); ?></td>
                            <td><?php echo $mr->namerequestby ?></td>                                
                            <td align="center"><?php echo $mr->departmentcode ?></td>
                            <td align="center"><?php echo ($mr->datemustreceive != "") ? date('d/m/Y', strtotime($mr->datemustreceive)) : ""; ?></td>
                            <td align="center"><?php echo $mr->reasonrequirement ?></td>                                
                            <td>
                                <?php
                                if ($mr->supervisorapproval != "") {
                                    echo $mr->supervisor . "<br/>[" . $mr->supervisorapproval . "]";
                                    if ($mr->supervisorstatusapproval == 1) {
                                        echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font>";
                                    } else if ($mr->supervisorstatusapproval == 2) {
                                        echo "<br/><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font>";
                                    } else if ($mr->supervisorstatusapproval == 3) {
                                        echo "<br/><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->supervisortimeapproved)) . "</font>";
                                    }
                                    if ($mr->supervisorapproval == $this->session->userdata('id') && ($mr->supervisorstatusapproval != 1)) {
                                        echo "<br/><button onclick='mr_approve(" . $mr->id . ",1,1)'>approve</button>&nbsp;";
                                        echo "<button onclick='mr_approve(" . $mr->id . ",2,1)'>pending</button>&nbsp;";
                                        echo "<button onclick='mr_approve(" . $mr->id . ",3,1)'>reject</button>";
                                    } else {
                                        if ($mr->supervisorstatusapproval == 0) {
                                            echo "<br/><font color='blue'>Outstanding</font>";
                                        }
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($mr->managerapproval != "") {
                                    echo $mr->manager . "<br/>" . "[" . $mr->managerapproval . "]";
                                    if ($mr->supervisorapproval == "" || $mr->supervisorstatusapproval == 1) {
                                        if ($mr->managerstatusapproval == 1) {
                                            echo "<br/><font color='green'>Approve at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font>";
                                        } else if ($mr->managerstatusapproval == 2) {
                                            echo "<br/><font color='#e7a75b'>Pending at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font>";
                                        } else if ($mr->managerstatusapproval == 3) {
                                            echo "<br/><font color='red'>Reject at: <br/>" . date('d/m/Y H:i:s', strtotime($mr->managertimeapproved)) . "</font>";
                                        }
                                        if ($mr->managerapproval == $this->session->userdata('id') && ($mr->managerstatusapproval != 1)) {
                                            echo "<br/><button onclick='mr_approve(" . $mr->id . ",1,2)'>approve</button>&nbsp;";
                                            echo "<button onclick='mr_approve(" . $mr->id . ",2,2)'>pending</button>&nbsp;";
                                            echo "<button onclick='mr_approve(" . $mr->id . ",3,2)'>reject</button>";
                                        } else {
                                            if ($mr->managerstatusapproval == 0) {
                                                echo "<br/><font color='blue'>Outstanding</font>";
                                            }
                                        }
                                    } else {
                                        echo "<br/><font color='#966e02'>Waiting</font>";
                                    }
                                }
                                ?>
                            </td>   
                            <td align="center">
                                <?php
                                    if ($mr->status == 0) {
                                        echo "Waiting to approve";
                                    } else if ($mr->status == 1) {
                                        echo "Open";
                                    } else if ($mr->status == 2) {
                                        echo "Finish";
                                    } else if ($mr->status == 3) {
                                        echo "Close";
                                    }
                                ?>
                            </td>
                            </td>                             
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <span style="float: left">Print on <?php echo date('d/m/Y H:i:s') ?></span>
    </div>
    <script>window.print()</script>
</center>
</body>
</html>