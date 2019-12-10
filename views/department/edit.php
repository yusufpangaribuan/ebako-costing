<div style="width: 300px">
    <form id="department_form_edit" onsubmit="false">
        <table width="100%">
            <tr>
                <td width="25%" align="right" valign="top"><span class="labelelement">Code :</span></td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $department[0]->id ?>"/>
                    <input type="text" name="code" style="width: 100%" required="true" value="<?php echo $department[0]->code ?>"/>
                </td>
            </tr>
            <tr>
                <td align="right" valign="top"><span class="labelelement">Name :</span></td>
                <td><input type="text" name="name" style="width: 100%" value="<?php echo $department[0]->name ?>"/></td>
            </tr>    
            <tr>
                <td align="right"><span class="labelelement">Description :</span></td>
                <td><textarea name="description"  style="width: 100%;height: 40px"><?php echo $department[0]->description ?></textarea></td>  
            </tr>
        </table>        
    </form>
</div>