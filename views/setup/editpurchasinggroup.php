<table>
    <tr>
        <td width="100" align="right"><span class="labelelement">Group Name :</span></td>
        <td>
            <input type="hidden" id="id" value="<?php echo $purchasing->id ?>" />
            <input type="text" name="name" id="name" value="<?php echo $purchasing->name ?>"/>
        </td>
    </tr> 
    <tr>
        <td width="100" align="right"><span class="labelelement">Allow Access To :</span></td>
        <td>
            <?php
            $strarray = str_replace(array("{", "}"), "", $purchasing->itemgroup);
            $arritemgroup = explode(',', $strarray);
            foreach ($itemgroup as $result) {
                if (in_array($result->id, $arritemgroup)) {
                    echo "<input type='checkbox' value='" . $result->id . "' name='itemgroup[]' checked>&nbsp;" . $result->names . "<br/>";
                } else {
                    echo "<input type='checkbox' value='" . $result->id . "' name='itemgroup[]'>&nbsp;" . $result->names . "<br/>";
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <br/>
            <button onclick="setup_updatepurchasinggroup()" style="font-size: 11px;">Save</button>
            <button onclick="setup_editpurchasinggroup(<?php echo $purchasing->id ?>)" style="font-size: 11px;">Reset</button>
            <button onclick="$('#dialog').dialog('close')">Cancel</button>
        </td>
    </tr>
</table>