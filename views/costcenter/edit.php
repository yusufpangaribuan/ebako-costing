<div style="width: 300px;">
    <form id="costcenter_edit_form" class="table_form">
        <table width="100%">
            <tr valign="top">
                <td align="right" width="25%"><span class="labelelement">Code :</span></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $costcenter->id ?>" />
                    <input type="text" name="code" required="true" value="<?php echo $costcenter->code ?>" style="width: 100%"/>
                </td>
            </tr>
            <tr valign="top">
                <td align="right" width="25%"><span class="labelelement">Description :</span></td>
                <td><textarea name="description" style="width: 100%;height: 40px"><?php echo $costcenter->description ?></textarea></td>
            </tr>
        </table>
    </form>
</div>