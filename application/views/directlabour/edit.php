        <table width="100%">    
            <tr>
                <td align="right"><span class="labelelement">Description :</span></td>
                <td>
                    <input type="hidden" id="id" value="<?php echo $directlabour->id ?>" size="30" />
                    <input type="text" id="description" size="30" value="<?php echo $directlabour->description ?>" />
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Unit :</span></td>
                <td>
                    <select id="unitid">
                        <option value="0"></option>
                        <?php
                        foreach ($unit as $result) {
                            if ($directlabour->unit == $result->codes) {
                                echo "<option value='" . $result->codes . "' selected>" . $result->codes . "</option>";
                            } else {
                                echo "<option value='" . $result->codes . "'>" . $result->codes . "</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">Price :</span></td>
                <td><input type="text" name="names" id="price" size="15" value="<?php echo $directlabour->price ?>" style="text-align: right;" onblur="if(isNaN($(this).val())){alert('Required Number');$(this).val('')}" style="text-align: center; width: 100%;"/></td>
            </tr>  
            <tr>
                <td align="right"><span class="labelelement">Percentage :</span></td>
                <td><input type="text" name="percentage" id="percentage" size="15" style="text-align: right;" value="<?php echo $directlabour->percentage ?>" style="text-align: center; width: 100%;"/></td>
            </tr> 
        </table>
