<table width="300">
    <tr>
        <td><label class="labelelement">name</label></td>
        <td>
            <input type="hidden" id="e_id" value="<?php echo $latherinlay->id ?>" />
            <input type="text" id="e_name" value="<?php echo $latherinlay->name ?>"/>
        </td>
    </tr>
    <tr>
        <td><label class="labelelement">description</label></td>
        <td><textarea id="e_description"><?php echo $latherinlay->description ?></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><button onclick="latherinlay_update()">update</button></td>
    </tr>
</table>