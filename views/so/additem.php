<tr>
    <td>
        <input type="hidden" id="id<?php echo $counter ?>" name="id[]" value="0" />
        <input type="text" style="width: 80%" id="modelcode<?php echo $counter ?>"/>
        <input type="hidden" id="modelid<?php echo $counter ?>" name="modelid[]"/>
        <input type="hidden" id="rfqdetailid" name="rfqdetailid[]" value="0"/>
        <img src="images/list.png" class="miniaction" onclick="model_choose2('model',<?php echo $counter ?>)" />
    </td>                                    
    <td><textarea id="modeldescription<?php echo $counter ?>"style="width: 100%" readonly=""></textarea></td>
    <td><textarea id="modelfinishing<?php echo $counter ?>" style="width: 100%" readonly=""></textarea></td>
    <td><textarea id="modelfabrication<?php echo $counter ?>" style="width: 100%" readonly=""></textarea></td>
    <td><input type="text" style="width: 100%;text-align: center" id="qty<?php echo $counter ?>" name="qty[]" value="1" onchange="if($(this).val()=='' || $(this).val()=='0' || isNaN($(this).val())){alert('Required NUMBER and Not Allow 0 or NULL');$(this).val(1)}"/></td>   
<!--    <td><input type="text" style="width: 100%" id="remark<?php echo $counter ?>" name="remark[]"/></td>-->
    <td align="center"><img src="images/delete.png" onclick="so_deleteitem(this)" style="cursor: pointer"/> </td>
</tr>