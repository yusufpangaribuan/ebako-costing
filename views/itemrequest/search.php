<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_create_item_zxc').scrollableFixedHeaderTable('102%', '490');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id='tbl_create_item_zxc'>
    <thead>
        <tr>
            <th width="2%">No</th>
            <th width="5%">Date</th>            
            <th width="5%">Group</th>            
            <th>Description</th>
            <th width="5%">Unit</th>
            <?php
            if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) {
                echo "<th width=10%>Request By</th>";
            }
            ?>
            <th width="10%">Status</th>
            <th width="10%">Approve / Reject By</th>
            <th width="15%">Notes</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = $offset;
        foreach ($itemrequest as $result) {
            ?>
            <tr>
                <td align="right">&nbsp;<?php echo $number++ ?></td>
                <td align="center">&nbsp;<?php echo date('d/m/Y', strtotime($result->date)) ?></td>
                <td>&nbsp;<?php echo $result->groupname ?></td>                
                <td>&nbsp;<?php echo $result->description ?></td>
                <td align="center">&nbsp;<?php echo $result->unitcode ?></td>
                <?php
                if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) {
                    echo "<td width=10%>" . $result->requestname . "<br/>" . $result->requestby . "</td>";
                }
                ?>
                <td>&nbsp;
                    <?php
                    if ($result->status == 0) {
                        echo "<span style='color:#d5b638;'>Waiting to Approve</span>";
                    } elseif ($result->status == 1) {
                        echo "<span style='color:blue;'>Approve at : <br/>" . date('d/m/Y h:i:s', strtotime($result->datestatus)) . "</span>";
                    } elseif ($result->status == 2) {
                        echo "<span style='color:red;'>Reject at : <br/>" . date('d/m/Y h:i:s', strtotime($result->datestatus)) . "</span>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($result->status == 0) {
                        if ($this->session->userdata('department') == 10 && $this->session->userdata('optiongroup') == 0) {
                            echo "<button onclick='itemrequest_approve(" . $result->id . ")'>Approve</button>";
                            echo "<button onclick='itemrequest_reject(" . $result->id . ")'>Reject</button>";
                        }
                    } else if ($result->status == 1) {
                        echo $result->statusby . "<br>" . $result->statusbyname;
                    } else if ($result->status == 2) {
                        echo $result->statusby . "<br>" . $result->statusbyname;
                    }
                    ?>
                </td>
                <td><?php echo $result->notes ?></td>
                <td align="center">
                    <?php
                    if ($result->status == 0) {
                        if (in_array('edit', $accessmenu)) {
                            echo "<a href='javascript:itemrequest_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                        }
                        if (in_array('delete', $accessmenu)) {
                            echo "<a href='javascript:itemrequest_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
                        }
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>"/>
        <img src="images/first.png" onclick="itemrequest_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="itemrequest_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="itemrequest_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="itemrequest_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>