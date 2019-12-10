<div style="width: 250px">
    <form id="item_edit_this_unit_form">
        <table width="100%">
            <tr>
                <td width="40%"><label class="labelelement">New Unit</label></td>
                <td width="60%">
                    <input type="hidden" name="itemid" value="<?php echo $itemid ?>" />
                    <input type="hidden" name="unitfrom" value="<?php echo $unitfrom ?>" />
                    <select style="width:100%" name="new_unitid" id="unitid<?php echo $result->id ?>" >                        
                        <?php
                        foreach ($unit as $result2) {
                            if ($unitfrom == $result2->id) {
                                echo "<option value='" . $result2->id . "' selected>" . $result2->codes . "</option>";
                            } else {
                                echo "<option value='" . $result2->id . "'>" . $result2->codes . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><br/><button type="button" onclick="item_do_edit_this_unit()">Save</button></td>
            </tr>
        </table>
    </form>
</div>

