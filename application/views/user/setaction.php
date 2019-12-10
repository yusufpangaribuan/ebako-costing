    <input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>"/>
    <input type="hidden" name="accessmenu" id="accessmenu" value="<?php echo $accessmenu ?>"/>    
    
    <center>
	    <table class="tablesorter" style="width: 100%">
	        <thead>
	            <tr>
	                <th width="20%">Choose</th>
	                <th width="80%">Action</th>
	            </tr>
	        </thead> 
	        <tbody>
	            <?php
	            $actionlist = explode('|', $action);
	            $user_action = explode('|', $useraction);
	            //print_r($user_action);
	            for ($i = 0; $i < count($actionlist); $i++) {
	                $checked = "";
	                if (in_array($actionlist[$i], $user_action)) {
	                    $checked = "checked='true'";                   
	                }
	                 //echo $actionlist."<br/>";
	                ?>
	                <tr>
	                    <td align="center"><input type='checkbox' <?php echo $checked ?> name='action' value='<?php echo $actionlist[$i] ?>'/></td>
	                    <td><?php echo $actionlist[$i] ?></td>
	                </tr>
	                <?php
	            }
	            ?>
	        </tbody>
	    </table>
    </center>
    <br/>
