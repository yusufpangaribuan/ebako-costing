<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_so_qzx').scrollableFixedHeaderTable('100%', '500');
    });
</script>
<table class="tablesorter scrollableFixedHeaderTable" width="99%"  id="tbl_s_so_qzx">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="5%">SO</th>
            <th width="5%">Date</th>
            <th width="10%">Customer</th>
            <th width="10%">Ship To</th>
            <th width="25%">Shipping Address</th>
            <th width="5%">Ship Schedule</th>
            <th width="10%">Testing</th>                        
            <th width="5%">PO No.</th>            
            <th width="10%">Sales Person</th>
            <th width="5%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($so)) {
            $no = 1;
            foreach ($so as $result) {
                $bgcolor = "";
                if ($result->finishbymarketing == 'f') {
                    $bgcolor = 'bgcolor="#ffe6e6"';
                } else {
                    if ($result->finishbyrnd == 'f') {
                        $bgcolor = 'bgcolor="#ffe4c9"';
                    }
                }
                ?>
                <tr <?php echo $bgcolor ?>>
                    <td align="right"><?php echo $no++; ?></td>                                
                    <td align="center">
                        <?php
                        if ($this->model_user->haspermission($this->session->userdata('id'), 'so', 'view_detail')) {
                            echo "<a href='javascript:so_edit(" . $result->id . ")'>" . $result->number . "</a>";
                        } else {
                            echo $result->number;
                        }
                        ?>
                    </td>
                    <td align="center"><?php echo date('d/m/Y', strtotime($result->date)); ?></td>
                    <td><?php echo $result->billtoname; ?></td>
                    <td><?php echo $result->shiptoname; ?></td>
                    <td><?php echo nl2br($result->shippingaddress); ?></td>
                    <td align="center"><?php echo date('d/m/Y', strtotime($result->shipmentschedule)); ?></td>
                    <td>
                        <?php
                        $strarray = str_replace(array("{", "}"), "", $result->testing);
                        $arrtesting = explode(',', $strarray);
                        foreach ($testing as $resulttesting) {
                            if (in_array($resulttesting->id, $arrtesting)) {
                                echo "-" . $resulttesting->name . "<br/>";
                            }
                        }
                        ?>
                    </td>                                
                    <td align="center"><?php echo $result->ponumber; ?></td>
                    <td><?php echo $result->salesperson; ?></td>
                    <td align="center">
                        <?php
                        if ($result->finishbymarketing == 'f') {
                            echo "New";
                        } else {
                            if ($result->finishbyrnd == 'f') {
                                echo "On R&D";
                            } else {
                                if ($result->iscreatemrp == 'f') {
                                    echo "On PPC";
                                } else {
                                    if ($result->status == 0) {
                                        if ($this->session->userdata('department') == 2) {
                                            echo "<button onclick='so_doproduction(" . $result->id . ")'>Production</button>";
                                        } else {
                                            echo "Ready Production";
                                        }
                                    } else if ($result->status == 1) {
                                        if ($this->session->userdata('department') == 3) {
                                            echo "<button onclick='so_dofinish(" . $result->id . ")'>Finish</button>";
                                        } else {
                                            echo "Production";
                                        }
                                    } else if ($result->status == 2) {
                                        echo "Finish";
                                    }
                                }
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
<div style="margin-bottom: 5px;margin-top: 5px;">
    <img src="images/first.png" onclick="so_search(<?php echo $first ?>)" class="miniaction"/>
    <img src="images/prev.png" onclick="so_search(<?php echo $prev ?>)" class="miniaction"/>
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
    <img src="images/next.png" onclick="so_search(<?php echo $next ?>)" class="miniaction"/>
    <img src="images/last.png" onclick="so_search(<?php echo $last ?>)" class="miniaction"/>
    &nbsp;&nbsp;
    Total Page
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
    Total Rows
    <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
</div>