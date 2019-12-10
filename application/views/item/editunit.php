<input type="hidden" name="itemid" id="itemid" value="<?php echo $itemid ?>" />
<table width="300" class="tablesorter">
    <thead>
        <tr>
            <th width="30%">From</th>
            <th width="15%">Act</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $lastunit = 0;
        $no = 1;
        foreach ($allunit as $result) {
            ?>
            <tr>
                <td>
                    <select name="unitid[]" style="width:100%">                        
                        <?php
                        foreach ($unit as $result2) {
                            if ($result->unitfrom == $result2->id) {
                                echo "<option value='" . $result2->id . "' selected>" . $result2->codes . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="item_edit_this_unit(<?php echo $itemid . "," . $result->unitfrom ?>)"><img src='images/edit.png'/>Edit</a>
                </td>
            </tr>
            <?php
            $no++;
            $lastunit = $result->unitfrom;
        }
        ?>    
    </tbody>    
</table>
<br/>
<!--<center>
    <button style="font-size: 11px;"onclick="item_addunit(<?php echo $itemid . "," . $lastunit ?>)">Add Unit</button>
</center>-->