<tr valign="top">                                
    <td>
        <select>
            <option>--Choose Vendor--</option>
            <?php
            foreach ($vendor as $vendor){
                echo "<option value='".$vendor->id."'>".$vendor->name."</option>";
            }
            ?>
        </select>
    </td>
    <td>
        <select>
            <option>Curr</option>
            <?php
            foreach ($currency as $currency){
                echo "<option value='".$currency->curr."'>".$currency->curr."</option>";
            }
            ?>
        </select>
    </td>
    <td><input type="text" size="20" /></td>
    <td><textarea style="width: 100%; height: 50px;"></textarea></td>
    <td>
        <img src="images/delete.png" title="Use to PR"/>
        <img src="images/set.png" title="Use to PR" />
    </td>                                
</tr>