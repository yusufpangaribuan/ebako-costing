<span class="labelelement">Description :</span><input type="text" name="description" id="description_s"/>
<button>search</button>
<table width="100%" class="tablesorter">
    <thead>
        <tr>
            <th width="5%">NO</th>
            <th width="30%">CODE</th>
            <th width="30%">NAME</th>
            <th width="30%">UNIT</th>
            <th width="5%">ACTION</th>
        </tr>
    </thead>    
    <tbody
    <?php
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
    $no = 1;
    foreach ($component as $result) {
        ?>
            <tr>
                <td>
                    <?php echo $no++ ?>
                    <input type="hidden" id="id_s<?php echo $result->id ?>" value="<?php echo $result->id ?>"/> 
                </td>
                <td><?php echo $result->partnumber ?></td>
                <td><?php echo $result->description ?><input type="hidden" id="description_s<?php echo $result->id ?>" value="<?php echo $result->description ?>"/></td>
                <td><?php echo $result->unitcode ?></td>
                <td align="center"><button onclick="model_setcomponent(<?php echo "'".$element."',".$result->id?>)">Set</button></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

