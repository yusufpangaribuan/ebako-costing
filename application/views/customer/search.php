<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_customer_qzx').scrollableFixedHeaderTable('100%', '500');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_customer_qzx">
    <thead>
        <tr>
            <th width="1%">No</th>  
            <th width="5%">ID</th>
            <th width="10%">Name</th>
            <th>Address</th>            
            <th width="5%">City</th>
            <th width="5%">State</th>
            <th width="5%">Zip Code</th>
            <th width="5%">Country</th>
            <th width="8%">Contact</th>
            <th width="10%">Service</th>
            <th width="8%">Phone</th>
            <th width="5%">Fax</th>
            <th width="5%">Email</th>            
            <th width="5%">Curr</th>
            <th width="110">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($customer as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $number++ ?></td>
                <td align="center"><?php echo $result->customernumber ?></td>
                <td><?php echo $result->name ?></td>
                <td><?php echo nl2br($result->address1) ?></td>
                <td><?php echo $result->city ?></td>
                <td><?php echo $result->state ?></td>
                <td><?php echo $result->zipcode ?></td>
                <td><?php echo $result->country ?></td>
                <td><?php echo $result->contact ?></td>
                <td><?php echo $result->service ?></td>
                <td><?php echo $result->phone ?></td>
                <td><?php echo $result->fax ?></td>
                <td><?php echo $result->email ?></td>                                
                <td>
                    <?php
                    echo $result->curr . " " . ($result->curr2 != '' ? "," . $result->curr2 : '') . " " . ($result->curr3 != '' ? "," . $result->curr3 : '') . "";
                    ?>
                </td>
                <td>
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:customer_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                    }if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:customer_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
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
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="customer_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="customer_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="customer_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="customer_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>