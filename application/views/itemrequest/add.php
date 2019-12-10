<div style="width: 350px">
    <form id="itemrequest_add_form" onsubmit="return false">
        <table align="center" border="0" width="100%">                
            <tr>
                <td align="right" width="25%"><span class="labelelement">Group :</span></td>
                <td width="75%">
                    <select id="groupid" name="groupid" style="width: 200px" required="true" class="required">
                        <option value="">--Group--</option>
                        <?php
                        foreach ($group as $result) {
                            echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" id="flag" value="1" />
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Description :</span></td>
                <td><textarea id="description" required="true" class="required" name="description" style="width: 100%;height: 60px;"></textarea></td>  
            </tr>                
            <tr valign="top">
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select name="unitid" id="unitid" required="true" class="required" style="width: 100px">
                        <option value="">--Unit--</option>
                        <?php
                        foreach ($unit as $result) {
                            echo "<option value='" . $result->id . "'>" . $result->codes . "</option>";
                        }
                        ?>
                    </select>                        
                </td>
            </tr>
        </table>
    </form>
</div>