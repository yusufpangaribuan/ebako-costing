<script type="text/javascript">
    /* make the table scrollable with a fixed header */
    $(function () {
        $('#tbl_s_vendor_qzx').scrollableFixedHeaderTable('100%', '500');
    });
</script>
<table class="tablesorter2 scrollableFixedHeaderTable" width="100%" id="tbl_s_vendor_qzx">
    <thead>
        <tr>
            <th width="10">No</th>            
            <th width="5%">ID</th>
            <th width="10%">Name</th>
            <th width="10%">Address</th>
            <th width="10%">Contact</th>
            <th width="10%">Phone</th>
            <th width="10%">Fax</th>
            <th width="10%">E-mail</th>
            <th width="10%">Service</th>            
            <th width="10%">Tax</th>
            <th width="10%">Currency</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($vendor as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $number++ ?></td>
                <td align="center"><?php echo $result->vendornumber ?></td>
                <td><?php echo $result->name ?></td>
                <td><?php echo $result->address1 ?></td>                                            
                <td><?php echo $result->contact ?></td>
                <td><?php echo $result->phone ?></td>
                <td><?php echo $result->fax ?></td>
                <td><?php echo $result->email ?></td>
                <td><?php echo $result->service ?></td>                
                <td><?php echo $result->taxnumber ?></td>
                <td align="center">
                    <?php
                    echo $result->curr . " " . ($result->curr2 != '' ? "," . $result->curr2 : '') . " " . ($result->curr3 != '' ? "," . $result->curr3 : '') . "";
                    ?>
                </td>
                <td align="center">
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:vendor_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                    }if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:vendor_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>                
<div style="margin-bottom: 3px;margin-top: 3px;">
    <input type="hidden" id="offset" value="<?php echo $offset ?>" />
    <img src="images/first.png" onclick="vendor_search(<?php echo $first ?>)" class="miniaction"/>
    <img src="images/prev.png" onclick="vendor_search(<?php echo $prev ?>)" class="miniaction"/>
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
    <img src="images/next.png" onclick="vendor_search(<?php echo $next ?>)" class="miniaction"/>
    <img src="images/last.png" onclick="vendor_search(<?php echo $last ?>)" class="miniaction"/>
    &nbsp;&nbsp;
    Total Page
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
    Total Rows
    <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
</div>