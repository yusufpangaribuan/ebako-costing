<div style="width: 350px">
    <form id="itemrequest_edit_form" onsubmit="return false">
        <table align="center" border="0" width="100%">                
            <tr>
                <td align="right" width="25%"><span class="labelelement">Group :</span></td>
                <td width="75%">
                    <input type="hidden" id="id" name="id" value="<?php echo $itemrequest->id ?>" />
                    <select id="groupid" name="groupid" style="width: 200px" required="true"  class="required">
                        <option value="">--Group--</option>
                        <?php
                        foreach ($group as $result) {
                            if ($itemrequest->groupid == $result->id) {
                                echo "<option value='" . $result->id . "' selected>[" . $result->codes . "] " . $result->names . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="hidden" id="flag" value="1" />
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Description :</span></td>
                <td><textarea id="description" required="true" class="required" name="description"   style="width: 100%;height: 60px;"><?php echo $itemrequest->description ?></textarea></td>  
            </tr>                
            <tr valign="top">
                <td align="right"><span class="labelelement">Smallest Unit :</span></td>
                <td>
                    <select name="unitid" id="unitid" required="true"  class="required" style="width: 100px">
                        <option value="">--Unit--</option>
                        <?php
                        foreach ($unit as $result) {
                            if ($itemrequest->unitid == $result->id) {
                                echo "<option value='" . $result->id . "' selected>" . $result->codes . "</option>";
                            } else {
                                echo "<option value='" . $result->id . "'>" . $result->codes . "</option>";
                            }
                        }
                        ?>
                    </select>                        
                </td>
            </tr>
        </table>
    </form>
</div>