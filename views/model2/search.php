<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_model76d_qzx').scrollableFixedHeaderTable('102%', '200', null, null, null, 'tbl_s_model76d_qzx');
    });
</script>
<style>
    .ui-menu { position: absolute; width: 100px; }
</style>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_model76d_qzx">
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="1%">&nbsp;</th>                                                    
            <th width="10%">Code</th>            
            <th width="10%">Cust Code</th>
            <th width="18%">Description</th>
            <th width="10%">Color Finish</th>
            <th width="2%">W</th>
            <th width="2%">D</th>
            <th width="2%">HT</th>            
            <th width="8%">Prepared By</th>
            <th width="8%">Checked By</th>
            <th width="8%">Approved By</th>
            <th width="8%">Action</th>
        </tr>                            
    </thead>
    <tbody>
        <?php
        $counter = $offset + 1;
        foreach ($model as $result) {
            ?>
            <tr>                
                <td align="right" class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $counter++ ?></td>                                            
                <td align="center" onclick="model_viewdetail(<?php echo $result->id ?>)" ><input type="checkbox" id="mdlid<?php echo $result->id ?>" name="mdl[]"/></td>
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->no ?></td>
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->custcode ?></td>
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->description ?></td>                
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->color ?></td>
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dw ?></td>
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dd ?></td>
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dht ?></td>                
                <td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->preparedby ?></td>
                <td class="data22">

                    <?php
                    echo $result->checkedby_name;
                    if($result->checkedstatus !=""){
                        echo "<br/><font color='green'>Checked at: <br/>" . date('d/m/Y H:i:s', strtotime($result->checkedtime)) . "</font>";
                    }
                    else if ($result->checkedby == $this->session->userdata('id') && $result->checkedstatus == "") {
                        echo "<br/><button onclick=model_approve(" . $result->id . ",'" . $result->checkedby . "',1,1,0)>Approve</button>&nbsp;";
                        echo "<button onclick=model_approve(" . $result->id . ",'" . $result->checkedby . "',2,1,0)>Pending</button>&nbsp;";
                        echo "<button onclick=model_approve(" . $result->id . ",'" . $result->checkedby . "',3,1,0)>Reject</button>";
                    } else {
                        echo "<br/><font color='blue'>Need to Checked</font>";
                    }
                    ?>
                </td>
                <!--<td class="data22" onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->approvedby_name ?></td>-->
                <td class="data22">

                    <?php
                    echo $result->approvedby_name;
                    if($result->checkedstatus !=""){
                        echo "<br/><font color='green'>Checked at: <br/>" . date('d/m/Y H:i:s', strtotime($result->checkedtime)) . "</font>";
                    }
                    else if ($result->approvedby == $this->session->userdata('id') && $result->approvedstatus == "") {
                        echo "<br/><button onclick=model_approve(" . $result->id . ",'" . $result->approvedby . "',1,1,0)>Approve</button>&nbsp;";
                        echo "<button onclick=model_approve(" . $result->id . ",'" . $result->approvedby . "',2,1,0)>Pending</button>&nbsp;";
                        echo "<button onclick=model_approve(" . $result->id . ",'" . $result->approvedby . "',3,1,0)>Reject</button>";
                    } else {
                        echo "<br/><font color='blue'>Need to Approved</font>";
                    }
                    ?>
                </td>
                <td>
                    <?php
//                    if (in_array('edit', $accessmenu)) {
//                        echo "<a href='javascript:model_edit(" . $result->id . ")'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
//                    }
//                    if (in_array('delete', $accessmenu)) {
//                        echo "<a href='javascript:model_delete(" . $result->id . ")'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete&nbsp;</a>";
//                    }
//                    
                    ?>
                    <div class="drop">
                        <ul class="drop_menu">
                            <li>
                                <a href='#'><img src='images/options.png' class='miniaction'/>Options >></a>
                                <ul>
                                    <?php
                                    if (in_array('edit', $accessmenu)) {
                                        echo "<li><a href='javascript:model_edit(" . $result->id . ");model_viewdetail(" . $result->id . ")'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a></li>";
                                    }
                                    if (in_array('delete', $accessmenu)) {
                                        echo "<li><a href='javascript:model_delete(" . $result->id . ");model_viewdetail(" . $result->id . ")'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete&nbsp;</a><li>";
                                    }
                                    if ($this->session->userdata('department') == 4) {
                                        if (in_array('copy', $accessmenu)) {
                                            echo "<a href='javascript:model_copy2(" . $result->id . ");model_viewdetail(" . $result->id . ")'>Copy</a>";
                                        }
                                        if (in_array('view_cdss', $accessmenu)) {
                                            echo "<a href='javascript:model_cdsprint2(" . $result->id . ");model_viewdetail(" . $result->id . ")'>Cdss</a>";
                                        }
                                        if (in_array('view_cutting_list', $accessmenu)) {
                                            echo "<a href='javascript:model_bom2(" . $result->id . ");model_viewdetail(" . $result->id . ")'>Cutting List</a>";
                                        }
                                    }
                                    ?>                                    
                                </ul>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<div style="margin-bottom: 5px;margin-top: 5px;">
    <input type="hidden" id="offset" value="<?php echo $offset ?>" />
    <img src="images/first.png" onclick="model_search(<?php echo $first ?>)" class="miniaction"/>
    <img src="images/prev.png" onclick="model_search(<?php echo $prev ?>)" class="miniaction"/>
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
    <img src="images/next.png" onclick="model_search(<?php echo $next ?>)" class="miniaction"/>
    <img src="images/last.png" onclick="model_search(<?php echo $last ?>)" class="miniaction"/>
    &nbsp;&nbsp;
    Total Page
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
    Total Rows
    <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
</div>