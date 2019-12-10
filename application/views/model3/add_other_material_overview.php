<div style="width: 300px;height: 50px;">
    <table width="100%">
        <tr>
            <td><label class="labelelement"> Description :</label></td>
            <td>
                <input type="hidden" id="_id" value="<?php echo $id ?>" />
                <input type="hidden" id="model_id" value="<?php echo $modelid ?>" />
                <input type="hidden" id="type_id" value="<?php echo $typeid ?>" />
                <input type="text" name="description_" id="description_" value="<?php echo $description?>"/>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button onclick="model_save_other_material_overview()">Save</button></td>
        </tr>
    </table>
</div>
