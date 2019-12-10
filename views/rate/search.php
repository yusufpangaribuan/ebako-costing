<table id="table_rate" class="table table-striped table-bordered " cellspacing="0" width="100%">
		            <thead>
		                <tr>
		                    <th width="10">No</th>
		                    <th>Currency From</th>
		                    <th>Currency To</th>            
		                    <th>Value</th>
		                    <th style="width: 200px;text-align: center;">Action</th>
		                </tr>
		            </thead>
		            <tbody>
		                <?php
		                $number = 1;
		                foreach ($rate as $result) {
		                    ?>
		                    <tr>
		                        <td>&nbsp;<?php echo $number++ ?></td>
		                        <td>&nbsp;<?php echo $result->currency_from ?></td>
		                        <td>&nbsp;<?php echo $result->currency_to ?></td>
		                        <td align="right">&nbsp;<?php echo number_format($result->value, 2, '.', ',') ?></td>
		                        <td align="center">
		                            <?php
		                            //if (in_array('edit', $accessmenu)) {
		                                echo "<a href='javascript:rate_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
		                            //}if (in_array('delete', $accessmenu)) {
		                                echo "<a href='javascript:rate_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
		                            //}
		                            ?>                            
		                        </td>
		                    </tr>
		                    <?php
		                }
		                ?>
		            </tbody>
		        </table> 