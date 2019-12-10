<script type="text/javascript">  
    $(document).ready(function()  {
        $("#tree").treeTable({ expandable: true });        
    });  
</script>
<table id="tree" class="tablesorter" width="100%">
    <tbody>
        <?php
        foreach ($modelitem as $result) {
            ?>            
            <tr id="node-1">                
                <td width="180"><?php echo $result->itempartnumber?></td>
                <td width="180"><?php echo $result->itemname?></td>                
                <td width="180">Revision</td>                
                <td width="20"><?php echo $result->qty?></td>
                <td width="30">Unit</td>
                <td width="200">Reference Designator</td>
                <td><?php echo $result->remark?></td>
                <td width="70" align="center">
                    <img src="images/add.png" />
                    <img src="images/edit.png" />
                    <img src="images/delete.png" />
                </td>
            </tr>
            <?php
        }
        ?>

        <tr id="node-1">                
            <td width="180">                
                Part Number
            </td>
            <td width="180">Part Name</td>
            <td width="180">Revision</td>                
            <td width="20">Qty</td>
            <td width="30">Unit</td>
            <td width="200">Reference Designator</td>
            <td>Notes</td>
            <td width="70" align="center">
                <img src="images/add.png" />
                <img src="images/edit.png" />
                <img src="images/delete.png" />
            </td>
        </tr>
        <tr id="node-11" class="child-of-node-1">
            <td>Part Number</td>
            <td>Part Name</td>
            <td>Revision</td>                
            <td>Qty</td>
            <td>Unit</td>
            <td>Reference Designator</td>
            <td>Notes</td>
            <td width="70" align="center">
                <img src="images/add.png" />
                <img src="images/edit.png" />
                <img src="images/delete.png" />
            </td>
        </tr>
        <tr id="node-12" class="child-of-node-11">
            <td>Part Number</td>
            <td>Part Name</td>
            <td>Revision</td>                
            <td>Qty</td>
            <td>Unit</td>
            <td>Reference Designator</td>
            <td>Notes</td>
            <td width="70" align="center">
                <img src="images/add.png" />
                <img src="images/edit.png" />
                <img src="images/delete.png" />
            </td>
        </tr>
        <tr id="node-3">                
            <td>Part Number</td>
            <td>Part Name</td>
            <td>Revision</td>                
            <td>Qty</td>
            <td>Unit</td>
            <td>Reference Designator</td>
            <td>Notes</td>
            <td width="70" align="center">
                <img src="images/add.png" />
                <img src="images/edit.png" />
                <img src="images/delete.png" />
            </td>
        </tr>
        <tr id="node-31" class="child-of-node-3">
            <td>Part Number</td>
            <td>Part Name</td>
            <td>Revision</td>                
            <td>Qty</td>
            <td>Unit</td>
            <td>Reference Designator</td>
            <td>Notes</td>
            <td width="70" align="center">
                <img src="images/add.png" />
                <img src="images/edit.png" />
                <img src="images/delete.png" />
            </td>
        </tr>
        <tr id="node-32" class="child-of-node-31">
            <td>Part Number</td>
            <td>Part Name</td>
            <td>Revision</td>                
            <td>Qty</td>
            <td>Unit</td>
            <td>Reference Designator</td>
            <td>Notes</td>
            <td width="70" align="center">
                <img src="images/add.png" />
                <img src="images/edit.png" />
                <img src="images/delete.png" />
            </td>
        </tr>
    </tbody>
</table>