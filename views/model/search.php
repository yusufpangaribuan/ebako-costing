	<div style="margin-bottom: 5px;margin-top: 5px;" class="pull-right">
		<nav class="pagination pagination-sm">
			<input type="hidden" id="offset" value="<?php echo ($offset < 1 ? 0 : ($offset - 1) ) ?>" />
			<ul class="pagination">
				<li class="">
					<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="model_search(0)">
						<strong><span class="fa fa-refresh"></span> Refresh</strong>
					</a> 
				</li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
				
				<li class="page-item">
					<a class="page-link" href="#" onclick="model_search(<?php echo $first ?>)">First</a>
				</li>
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Previous" onclick="model_search(<?php echo $prev ?>)">
			        <img src="images/prev.png" onclick="model_search(<?php echo $prev ?>)" class="miniaction"/>
			      </a>
			    </li>
				
				<li class="page-item">
					<a class="page-link"><?php echo $page ?></a>
				</li>
				
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Next" onclick="model_search(<?php echo $next ?>)">
			        <img src="images/next.png" onclick="model_search(<?php echo $next ?>)" class="miniaction"/>
			      </a>
			    </li>
			    
				<li class="page-item">
					<a class="page-link" href="#" onclick="model_search(<?php echo $last ?>)">Last</a>
				</li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<li class="">
					<a class="page-link-2">
						Total:  <strong><?php echo $num_page ?></strong> Page(s),
					    <strong><?php echo $num_rows ?></strong> Row(s)
					</a> 
				</li>
			</ul>
		</nav>
	</div>

<table id="table_model" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr style="border-top: 4px solid #ec9821;">
			<th width="2%" align=center>No</th>
			<th width="10%" align=center>Code</th>
			<th width="10%" align=center>Cust Code</th>
			<th width="18%" align=center>Description</th>
			<th width="10%" align=center>Color Finish</th>
			<th width="2%" align=center>W</th>
			<th width="2%" align=center>D</th>
			<th width="2%" align=center>HT</th>
			
			<th width="2%" align=center>GW</th>
			<th width="2%" align=center>NW</th>
			
			
			<th width="8%" align=center>Prepared By</th>
			<th with="8%" align=center>Checked By</th>
			<th width="8%" align=center>Approved By</th>
			<th width="8%" align=center>Action</th>
		</tr>
	</thead>
        <?php
        $counter = $offset + 1;
        foreach ($model as $result) {
          $colour_td = "white";
          if ($counter % 2 == 0)
            $colour_td = "#ccffff";
          ?>
            <tr>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" align="right"><?php echo $counter++ ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)"  ><?php echo $result->no ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->custcode ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->description ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->color ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dw ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dd ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dht ?></td>
			
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->gw ?></td>
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->nw ?></td>
			
			<td onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $result->preparedby ?></td>
			<td >

          <?php
          echo $result->checkedby_name;
          if ($result->checkedstatus != "") {
            echo "<br/><font color='green'>Checked at: <br/>" .
                 date('d/m/Y H:i:s', strtotime($result->checkedtime)) . "</font>";
            echo "<br/><font color='green'>Status: <br/> <b>";
            
            	if( $result->checkedstatus == 1 ){ //Approved
            		?> 
            			<a class="btn-success" style="padding:0px;padding-left:2px;padding-right:2px;"> Approved </a>
            		<?php	
            	}else if( $result->checkedstatus == 2 ){ //Panding
            		?>
            			<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="model_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->checkedstatus?>', 1);"> Panding </a>
            		<?php 
            	}else{ //Reject
            		?>
            			<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="model_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->checkedstatus?>', 1);"> Reject </a>
            		<?php 
            	}
                echo "</b></font>" ;
                
          } else {
	            if ($result->checkedby == $this->session->userdata('id') &&
	                 $result->checkedstatus == "") {
	              echo "<br/><button onclick=model_approve(" . $result->id . ",'" . $result->checkedby . "',1,1,0)>Approve</button>&nbsp;";
	              echo "<button onclick=model_approve(" . $result->id . ",'" . $result->checkedby . "',2,1,0)>Pending</button>&nbsp;";
	              echo "<button onclick=model_approve(" . $result->id . ",'" . $result->checkedby . "',3,1,0)>Reject</button>";
	            } else {
	              echo "<br/><font color='blue'>Need to Checked</font>";
	            }
          }
          ?>
                </td>
				<td>
                    <?php
			          echo $result->approvedby_name;
			          if ($result->approvedstatus != "") {
			            		echo "<br/><font color='green'>Checked at: <br/>" . date('d/m/Y H:i:s', strtotime($result->approvedtime)) . "</font>";
			            
			            		echo "<br/><font color='green'>Status: <br/> <b>";
			            	
			            		if( $result->approvedstatus == 1 ){ //Approved
			            		?>
            	            			<a class="btn-success" style="padding:0px;padding-left:2px;padding-right:2px;"> Approved </a>
            	            		<?php	
            	            	}else if( $result->approvedstatus == 2 ){ //Panding
            	            		?>
            	            			<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="model_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->approvedstatus?>', 2);"> Panding </a>
            	            		<?php 
            	            	}else{ //Reject
            	            		?>
            	            			<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="model_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->approvedstatus?>', 2);"> Reject </a>
            	            		<?php 
            	            	}
            	                echo "</b></font>" ;			            	
			            	
			          } else 
			            if ($result->approvedby == $this->session->userdata('id') &&
			                 $result->approvedstatus == "") {
			              echo "<br/><button onclick=model_approve(" . $result->id . ",'" . $result->approvedby . "',1,2,0)>Approve</button>&nbsp;";
			              echo "<button onclick=model_approve(" . $result->id . ",'" . $result->approvedby . "',2,2,0)>Pending</button>&nbsp;";
			              echo "<button onclick=model_approve(" . $result->id . ",'" . $result->approvedby . "',3,2,0)>Reject</button>";
			            } else {
			              echo "<br/><font color='blue'>Need to Approved</font>";
			            }
			          ?>
                </td>
			<td>
             		<div class="drop">
                    	<?php
					           if (in_array('view_cdss', $accessmenu)) {
					              echo '<a href="javascript:model_cdsprint2(' . $result->id . ');"><button class="btn btn-sm btn-primary"> <i class="glyphicon glyphicon-print fa-sm"></i> CDSS</button></a>';
					           }
				          
					          if (in_array('edit', $accessmenu)) {
					            echo '<a href="javascript:model_edit(' . $result->id .
					                 ');"><button class="btn btn-sm btn-success"> <i class="fa fa-edit fa-sm"></i> Edit </button></a>';
					            echo '<a href="javascript:model_copy(' . $result->id .
					                 ');"><button class="btn btn-sm btn-primary"> <i class="fa fa-copy fa-sm"></i> Copy </button></a>';
					          }
					          
					          if (in_array('delete', $accessmenu)) {
						        echo "&nbsp;&nbsp;&nbsp;";
					          	echo '<a href="javascript:model_delete(' . $result->id . ');"><button class="btn btn-sm btn-delete btn-danger"> Delete</button></a>';
					          }
			          ?>                                    
				</div>
			</td>
		</tr>
<?php
        }
        ?>
</table>
<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#table_model').DataTable( {
	        scrollY: "300px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: true,
	        select: true,
	    } );
	    
	} );
</script>
