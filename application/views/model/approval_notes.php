<div style="width:400px">
    <table width="100%">
    	<?php foreach ($notes as $row) {?>
        <tr style="border: 1px solid;">
            <td style="padding: 5px;">
            	<b><?php echo "[ ". $row->checked_by . " - " . $row->timeapprove . " ] "?> </b> <br/><br/>
            	Notes:<br/>
            	<?php echo "<p>" . nl2br($row->notes) . "</p>";?>
            </td>
        </tr>
        <?php }?>
        
        <tr>
        	<td style="height: 50px;"></td>
        </tr>
        
        <tr>
        	<td>
        		<?php
        				if ($model->checkedby == $this->session->userdata('id')) {
        					echo "Or Change status to: <br/>";
        					echo "<br/><button onclick=model_approve(" . $model->id . ",'" . $model->checkedby . "',1,".$who.",0)>Approve</button>&nbsp;";
        					echo "<button onclick=model_approve(" . $model->id . ",'" . $model->checkedby . "',2,".$who.",0)>Pending</button>&nbsp;";
        					echo "<button onclick=model_approve(" . $model->id . ",'" . $model->checkedby . "',3,".$who.",0)>Reject</button>";
        				}
        		?>
        	</td>
        </tr>
        
    </table>
</div>
