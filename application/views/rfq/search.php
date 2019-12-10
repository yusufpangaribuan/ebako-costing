<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_rfq_qzx').scrollableFixedHeaderTable('102%', '470');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_rfq_qzx">
    <thead>
        <tr>
            <th>No</th>
            <th>RFQ</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Ship To</th>
            <th>Shipping Address</th>
            <th>Promised Date</th>
            <th>Testing</th>                        
            <th>Sales Person</th>
            <th>Quotation</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>                 
        <?php
        if (!empty($rfq)) {
            $no = 1;
            foreach ($rfq as $result) {
                $bgcolor = '';
                if ($result->isprocess == 'f') {
                    $bgcolor = 'bgcolor="#ffff91"'; //new
                } else {
                    if (!$this->model_rfq->isCompleteCosting($result->id)) {
                        $bgcolor = 'bgcolor="#ccffff"'; //no costing
                        if (!$this->model_rfq->isCompleteModel($result->id)) {
                            $bgcolor = 'bgcolor="#71b8ff"'; //not complete model
                        }
                    } else {
                        if (empty($result->quotationnumber) || $result->quotationnumber == "") {
                            $bgcolor = 'bgcolor="#e4c9c9"'; //No Quotation
                        } else {
                            if ($result->status == '') {
                                $bgcolor = 'bgcolor="#ffa851"'; // Waiting approval customer
                            } else if ($result->status == 2) {
                                $bgcolor = 'bgcolor="#ff8083"'; // Close RFQ
                            }
                        }
                    }
                }
                ?>
                <tr>
                    <td align="right" <?php echo $bgcolor ?>><?php echo $no++ ?></td>
                    <td <?php echo $bgcolor ?>><b><a href="javascript:rfq_edit(<?php echo $result->id ?>)"><?php echo $result->number ?></a></b></td>
                    <td align="center"><?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                    <td><?php echo $result->customer ?></td>
                    <td><?php echo $result->shipto ?></td>
                    <td><?php echo nl2br($result->shippingaddress) ?></td>
                    <td align="center"><?php echo date('d/m/Y', strtotime($result->promiseddate)) ?></td>
                    <td>
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $result->testing);
                        $arrtesting = explode(',', $strarray);
                        $i = 1;
                        foreach ($testing as $resulttesting) {
                            if (in_array($resulttesting->id, $arrtesting)) {
                                echo "-" . $resulttesting->name . "<br/>";
                            }
                        }
                        ?>
                    </td>                        
                    <td><?php echo $result->salesperson ?></td>
                    <td>
                        <?php
                        if (empty($result->quotationnumber) || $result->quotationnumber == "") {
                            if ($this->model_rfq->isCompleteCosting($result->id)) {
                                echo "<center><button onclick='quotation_create(" . $result->id . ")' style='margin-top:2px;'>Create Quo.</button></center>";
                            }
                        } else {
                            echo "<a href='javascript:void(0)' onclick='quotation_edit(" . $result->id . ")'  style='text-decoration: none'><img src='images/quotation.png' class='miniaction'/>Edit</a><br/>";
                            echo "<a href='javascript:void(0)' onclick='rfq_quotation(" . $result->id . ")'  style='text-decoration: none'><img src='images/print-quo.png' class='miniaction'/></a>&nbsp;";
                            echo "<input type='checkbox' id='quokind" . $result->id . "' checked='true'  style='vertical-align: middle'/>&nbsp;Regular item";
                        }
                        ?>                                    
                    </td>
                    <td align="center">
                        <select onChange="rfq_changestatus(this,<?php echo $result->id ?>)">                                        
                            <?php
                            foreach ($rfqstatus as $key => $value) {
                                if (empty($result->quotationnumber)) {
                                    echo "<option value='" . $key . "' disabled>" . $value . "</option>";
                                } else {
                                    if ($result->status == $key) {
                                        echo "<option value='" . $key . "' selected>" . $value . "</option>";
                                    } else {
                                        if ($result->status == 1) {
                                            echo "<option value='" . $key . "' disabled>" . $value . "</option>";
                                        } else {
                                            echo "<option value='" . $key . "'>" . $value . "</option>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </select>
                        <?php
                        if ($result->filename != '') {
                            echo "<br/><a href='" . base_url() . "/files/" . $result->filename . "' target='blank'>Attachment</a>";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <img src="images/first.png" onclick="rfq_searh(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="rfq_searh(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="rfq_searh(<?php echo $next ?>)"   class="miniaction"/>
        <img src="images/last.png" onclick="rfq_searh(<?php echo $last ?>)"   class="miniaction"/><input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" /> &nbsp;Pages                
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/> &nbsp;Rows                    
    </div>
</center>