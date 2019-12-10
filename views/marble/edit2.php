<table width="300">
    <tr>
        <td><label class="labelelement">name</label></td>
        <td>
            <input type="hidden" id="e_id" value="<?php echo $marble->id ?>" />
            <input type="text" id="e_name" value="<?php echo $marble->name ?>"/>
        </td>
    </tr>
    <tr>
        <td><label class="labelelement">description</label></td>
        <td><textarea id="e_description"><?php echo $marble->description ?></textarea></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><button onclick="marble_update()">update</button></td>
    </tr>
</table>