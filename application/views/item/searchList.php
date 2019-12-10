<?php 
foreach ($item as $result) {
	$allunit = $this->model_item->getAllUnit($result->id);
	?>
	
	<tr>
                    <td>
                        <input type="hidden" id="unitid_r<?php echo $result->id ?>" value="<?php echo $allunit ?>" />
                        <input type="hidden" id="id_r<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                        <input type="hidden" id="partnumber_r<?php echo $result->id ?>" value="<?php echo $result->partnumber ?>"/>
                        <input type="hidden" id="names_r<?php echo $result->id ?>" value="<?php echo $result->names ?>"/>
                        <input type="hidden" id="moq_r<?php echo $result->id ?>" value="<?php echo $result->moq ?>"/>
                        <input type="hidden" id="descriptions_r<?php echo $result->id ?>" value="<?php echo strip_tags($result->descriptions) ?>"/>
                        <?php echo $result->partnumber ?>
                    </td>
                    <td><?php echo nl2br($result->descriptions) ?></td>
                    <td><?php echo ($result->isstock == 't') ? 'Stock' : 'Non Stock'; ?></td>
                    <td><?php echo $result->groupname ?></td>
                    <td align="center"><?php echo $result->moq ?></td>
                    <td align="center"><?php echo $result->reorderpoint ?></td>
                    <td align="center">
                        <?php
                        if ($result->images != "") {
                            echo "<a href=javascript:void(0) onclick=item_viewimage('" . $result->images . "')> <img src = 'images/attachment.png' class = 'miniaction'/> Image</a>";
                        }
                        ?>
                    </td>
                    <td align="center"><img src="images/check.png" class="miniaction" onclick="item_selectToPr(<?php echo $result->id . "," . $elid ?>)" /></td>
       </tr>
	
	<?php 
}

?>
