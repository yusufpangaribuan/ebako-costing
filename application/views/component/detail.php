<?php
if (!empty($material)) {
    foreach ($material as $result) {
        ?>
        <tr>
            <td><?php echo $result->partnumber ?></td>
            <td><?php echo $result->descriptions ?></td>                    
            <td align="center"><?php echo $this->model_unit->getCodeById($result->unitid) ?></td>
            <td align="center"><?php echo $result->qty ?></td>     
            <?php if ($this->session->userdata('department') == 4) { ?>
            <td align="center">                
                <img src="images/delete.png" style="cursor: pointer" onclick="component_deleteitem(<?php echo $result->id . "," . $result->componentid ?>)"/>
            </td>
            <?php } ?>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="5">No Data..</td>
    </tr>
    <?php
}
?>
    
