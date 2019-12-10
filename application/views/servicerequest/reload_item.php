<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($servicerequestdetail as $result) {
    ?>
    <tr>
        <td>
            <?php echo "<b>(" . $result->source_item_code . " / " . $result->source_unit_code . ") </b>" . nl2br($result->source_item_description); ?><br/>
        </td>
        <td>
            <?php echo "<b>(" . $result->target_item_code . " / " . $result->target_unit_code . ") </b>" . nl2br($result->target_item_description); ?><br/>                                            
        </td>
        <td><?php echo nl2br($result->remark); ?></td>
        <td align="center"><?php echo $result->qty; ?></td>
        <td>
            <a href="javascript:servicerequest_edititem(<?php echo $result->id . ',' . $result->servicerequestid ?>)"><image src="images/edit.png">Edit</a>&nbsp;
            <a href="javascript:servicerequest_deleteitem(<?php echo $result->id . ',' . $result->servicerequestid ?>)"><image src="images/delete.png">Delete</a>
        </td>
    </tr>
    <?php
}