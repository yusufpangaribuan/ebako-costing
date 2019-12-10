<div style="width: 400px">
    <table width="100%">
        <tr>
            <td width="30%"><label class="labelelement">name</label></td>
            <td width="50%"><label class="labelelement">description</label></td>
            <td width="10%">&nbsp;</td>
            <td width="10%">&nbsp;</td>
        </tr>
        <tr>
            <td><input type="text" style="width:100%" id="packingname"/></td>
            <td><input type="text" style="width:100%" id="_packingdescription"/></td>
            <td><button>search</button></td>
            <td><button onclick="packing_save()">save</button></td>
        </tr>
    </table>
    <table width="100%" class="tablesorter">
        <thead>
            <tr>
                <th width="5%">&nbsp;</th>
                <th width="5%">NO</th>
                <th width="25%">NAME</th>
                <th width="50%">DESCRIPTION</th>
                <th width="15%">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($packing as $packing) {
                ?>
                <tr>
                    <td><img src="images/check.png" class="miniaction" onclick="packing_settomodel(<?php echo $packing->id ?>)"/></td>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $packing->name ?><input type="hidden" id="name<?php echo $packing->id ?>" value="<?php echo $packing->name ?>" /></td>
                    <td><?php echo $packing->description ?><input type="hidden" id="description<?php echo $packing->id ?>" value="<?php echo $packing->description ?>"/></td>
                    <td align="center">                        
                        <img src="images/edit.png" class="miniaction" onclick="packing_edit2(<?php echo $packing->id ?>)"/>
                        <img src="images/delete.png" class="miniaction" onclick="packing_delete2(<?php echo $packing->id ?>)"/>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>