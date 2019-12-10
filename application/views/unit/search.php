<table class="tablesorter2" width="100%">
    <thead>
        <tr>
            <th width="10">No</th>
            <th>Code</th>
            <th>Name</th>            
            <th>Remark</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($unit as $result) {
            ?>
            <tr>
                <td align="right">&nbsp;<?php echo $number++ ?></td>
                <td>&nbsp;<?php echo $result->codes ?></td>
                <td>&nbsp;<?php echo $result->names ?></td>
                <td>&nbsp;<?php echo $result->remark ?></td>
                <td align="center">
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:unit_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                    }
                    if ($this->model_user->haspermission($this->session->userdata('id'), 'unit', 'delete')) {
                        echo "<a href='javascript:unit_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
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
        <img src="images/first.png" onclick="unit_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="unit_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="unit_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="unit_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Total Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Total Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>
