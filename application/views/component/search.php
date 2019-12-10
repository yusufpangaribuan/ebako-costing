<table class="tablesorter2" width="100%">
    <thead>
        <tr>
            <th width="10" rowspan="2">No</th>
            <th rowspan="2">Code</th>            
            <th rowspan="2">Description</th>            
            <th rowspan="2">Wood</th>
            <th colspan="4">Veneer</th>
            <th colspan="4">Process</th>
            <th colspan="3">Final Size</th>
            <th colspan="3">Rough Size</th>            
            <th width="170" rowspan="2">Action</th>
        </tr>                                        
        <tr>
            <th>Type</th>
            <th>S1S</th>
            <th>DGB</th>
            <th>S2S</th>
            <th>Turn</th>
            <th>Lam</th>
            <th>Carv</th>
            <th>Mall</th>
            <th>T</th>
            <th>W</th>
            <th>L</th>
            <th>T</th>
            <th>W</th>
            <th>L</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($component)) {
            foreach ($component as $result) {
                ?>
                <tr>
                    <td align="right"><?php echo $number++ ?></td>                    
                    <td><?php echo $result->partnumber ?></td>                                                    
                    <td><?php echo $result->description ?></td>                    
                    <td><?php echo $result->woodname ?></td>
                    <td><?php echo $result->ven_type ?></td>
                    <td align="center"><?php echo $result->ven_s1s ?></td>
                    <td align="center"><?php echo $result->ven_dgb ?></td>
                    <td align="center"><?php echo $result->ven_s2s ?></td>
                    <td align="center"><?php echo $result->turn ?></td>
                    <td align="center"><?php echo $result->lam ?></td>
                    <td align="center"><?php echo $result->carv ?></td>
                    <td align="center"><?php echo $result->mall ?></td>
                    <td align="center"><?php echo $result->ft ?></td>
                    <td align="center"><?php echo $result->fw ?></td>
                    <td align="center"><?php echo $result->fl ?></td>
                    <td align="center"><?php echo $result->rt ?></td>
                    <td align="center"><?php echo $result->rw ?></td>
                    <td align="center"><?php echo $result->rl ?></td>
                    <td align="center">
                        <?php
                        //if ($this->session->userdata('department') == 4) {
                        if (in_array('edit', $accessmenu)) {
                            echo "<a href='javascript:component_edit($result->id)'><img src = 'images/edit.png' class = 'miniaction'/> Edit </a>";
                        }
                        if (in_array('delete', $accessmenu)) {
                            echo "<a href='javascript:component_delete($result->id)'><img src = 'images/delete.png' class = 'miniaction'/> Delete </a>";
                        }
                        //}
                        $images = 'no-image.png';
                        if ($result->image != "") {
                            $images = $result->image;
                        }
                        ?>
                        <a href="javascript:void(0)" onclick="componen_view_images('<?php echo $images ?>')"><img src = 'images/attachment.png' class = 'miniaction'/> Image</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
<div style="margin-bottom: 5px;margin-top: 5px;">
    <input type="hidden" id="offset" value="<?php echo $offset ?>" />
    <img src="images/first.png" onclick="component_search(<?php echo $first ?>)" style="cursor: pointer"/>
    <img src="images/prev.png" onclick="component_search(<?php echo $prev ?>)" style="cursor: pointer" />
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>" style="text-align: center" />
    <img src="images/next.png" onclick="component_search(<?php echo $next ?>)"  style="cursor: pointer"/>
    <img src="images/last.png" onclick="component_search(<?php echo $last ?>)"  style="cursor: pointer"/>
    &nbsp;&nbsp;
    Total Page
    <input type="text" size="2" id="page" name="page" readonly="" value="<?php echo $num_page ?>" style="text-align: center" />
    Total Rows
    <input type="text" size="2" id="numrows" name="numrows" readonly="" value="<?php echo $num_rows ?>" style="text-align: center"/>                    
</div>
