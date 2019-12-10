<table class="tablesorter" width="100%">
    <thead>
        <tr>
            <th width="10">NO</th>
            <th>Code</th>
            <th>Name</th>            
            <th>Description</th>
            <th width="100">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($department)) {
            $number = $offset + 1;
            foreach ($department as $result) {
                ?>
                <tr>
                    <td align="right">&nbsp;<?php echo $number++ ?></td>
                    <td>&nbsp;<?php echo $result->code ?></td>
                    <td>&nbsp;<?php echo $result->name ?></td>
                    <td>&nbsp;<?php echo $result->description ?></td>
                    <td>
                        <?php
                        if (in_array('edit', $accessmenu)) {
                            echo "<a href='javascript:department_edit($result->id)'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
                        }
                        if (in_array('delete', $accessmenu)) {
                            if (!in_array($result->id, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11))) {
                                echo "<a href='javascript:department_delete($result->id)'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete</a>";
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
<center>
    <div style="margin-bottom: 5px;margin-top: 5px;">
        <input type="hidden" id="offset" value="<?php echo $offset ?>" />
        <img src="images/first.png" onclick="department_search(<?php echo $first ?>)" class="miniaction"/>
        <img src="images/prev.png" onclick="department_search(<?php echo $prev ?>)" class="miniaction"/>
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
        <img src="images/next.png" onclick="department_search(<?php echo $next ?>)" class="miniaction"/>
        <img src="images/last.png" onclick="department_search(<?php echo $last ?>)" class="miniaction"/>
        &nbsp;&nbsp;
        Page
        <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
        Rows
        <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
    </div>
</center>