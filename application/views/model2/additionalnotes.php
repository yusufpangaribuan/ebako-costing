<div style="width:400px">
    <table width="100%">
        <tr>
            <td>                
                <textarea style="width: 100%" id="additionalnotes"><?php echo $additionalnotes ?></textarea>
            </td>
        </tr>
        <?php
        if (in_array('add_additional_notes', $accessmenu)) {
            ?>
            <tr>
                <td><button style="font-size: 11px;" onclick="model_updateadditionalnotes()">Update</button></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
