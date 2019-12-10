<input type="hidden" id="itemid" value="<?php echo $itemid ?>" />
<table width="300" class="tablesorter">
    <thead>
        <tr>
            <th width="40%">From</th>            
            <th width="40%">To</th>
            <th width="20%">Conversion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <select id="newunitfrom" style="width:100%"> 
                    <option value="0">--Unit--</option>
                    <?php
                    //print_r($unit);
                    foreach ($unit as $result) {
                        if ($unitidref != $result->id) {
                            echo "<option value='" . $result->id . "'>" . $result->codes . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <select id="newunitto" style="width:100%">    
                    <?php
                    foreach ($unit as $result) {
                        if ($unitidref == $result->id) {
                            echo "<option value='" . $result->id . "'>" . $result->codes . "</option>";
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <input type="text" id="valueconversion" value="0" style="text-align: center;width: 100%" onblur="if ($(this).val() == '' || parseFloat($(this).val()) < 0 || isNaN($(this).val())) {
                            alert('Required NUMBER not Allow Negative Number');
                            $(this).val(0)
                        }"/></td>
        </tr> 
    </tbody> 
</table>