		<div class="col-sm-12">
			<div style="margin-top: 5px;" class="pull-right">
				<nav class="pagination pagination-sm">
					<input type="hidden" id="offset" value="<?php echo ($offset - 1) ?>" />
					<ul class="pagination">
						<li class="">
							<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="costing_search(0)">
								<strong><span class="fa fa-refresh"></span> Refresh</strong>
							</a> 
						</li>
						<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
						
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_search(<?php echo $first ?>)">First</a>
						</li>
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Previous" onclick="costing_search(<?php echo $prev ?>)">
					        <img src="images/prev.png" onclick="costing_search(<?php echo $prev ?>)" class="miniaction"/>
					      </a>
					    </li>
						
						<li class="page-item">
							<a class="page-link"><?php echo $page ?></a>
						</li>
						
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Next" onclick="costing_search(<?php echo $next ?>)">
					        <img src="images/next.png" onclick="costing_search(<?php echo $next ?>)" class="miniaction"/>
					      </a>
					    </li>
					    
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_search(<?php echo $last ?>)">Last</a>
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
		</div>
	
		<div>
		<table id="table_costing" class="stripe row-border" style="width:100%">
		    <thead>
		        <tr>
		            <th style="width: 10px">No</th>                        
		            
		            <th>Image</th>
		            <th>Model Code</th>
		            <th>Cust. Code</th>
		            <th>Description</th>
		            <th>Finish Overview</th>
		            <th>Constr. Overview</th>
		            
		            <th>W</th>
		            <th>D</th>
		            <th>H</th>
		            <th>NW</th>
		            <th>GW</th>
		            
		            <th>Customer</th>
		            
		            <th>Date</th>
		            
		            <th>Rate</th>
		            
		            <?php if(in_array('view_fob_price_and_profit', $accessmenu)){?>
		            <th>Prof(%).</th>
		            <th>FOB Price</th>    
		            <?php }?>
		            
		            <th width="8%" align=center>Prepared By</th>
					<th with="8%" align=center>Checked By</th>
					<th width="8%" align=center>Approved By</th>                    
		            
		            <th>Action</th>
		        </tr>
			</thead>
			<tbody>
			
				<?php
	        $no = $offset;
	        
	        foreach ($costing as $result) {
	            $time1 = strtotime($result->date);
	            $nextexpired = strtotime('+1 year', $time1);
	            $time2 = strtotime(date('Y-m-d'));
	            $msg = "";
	            $bgcolor = "";
	            if (($nextexpired - $time2) < 2592000 || ($time2 > $nextexpired )) {
	                if (($time2 >= $nextexpired)) {
	                    $msg = "<br/><span style='color:red;font-size:11px;'><i>Need To Review<br/>Costing Expired </i></span>";
	                } else {
	                    $days = (($nextexpired - $time2) / 86400);
	                    $msg = "<br/><span style='color:red;font-size:11px;'><i>Need To Review<br/>Will be expired in $days days</i></span>";
	                }
	                $bgcolor = "bgcolor='#ffe1e4'";
	            }
	            if ($result->fob_price == '') {
	                $bgcolor = "bgcolor='#ffffd7'";
	                $msg = "";
	            }if ($result->needmodify == 't') {
	                $bgcolor = "bgcolor='#ffffd7'";
	                $msg = "<br/><span style='color:red;font-size:11px;'><i>Need to modify because some items have been changed by the R & D</i></span>";
	            }
	            ?>
	            <tr valign="top">
	                <td align="right"><?php echo $no++; ?></td>
	                <td align="center" style="<?php echo @$result->is_temporary_photo == 't'? "background-color: #f75d3f" : "" ?>">
			            <img src="files/<?php echo @$result->filename; ?>" class="miniaction" onclick="model_imageview('<?php echo @$result->filename; ?>')" style="max-width: 40px;max-height: 40px;width: 40px;height: 40px;">
                    </td>
                    
	                <td>
	                    <?php
	                    echo $result->code;
	                    echo $msg;
	                    ?>
	                </td>
	                <td><strong><?php echo $result->custcode ?></strong></td>
	                <td><?php echo $result->description ?></td>
	                
	                <td>
                        <?php
                        	$strarray = str_replace(array("{", "}"), "", $result->finishoverview);
                            $arrfinishoverview = explode(',', $strarray);
                            $arrconstructionoverview = explode(',', $strarray);
                            foreach ($finishoverview as $fo) {
                            	if (in_array($fo->id, $arrfinishoverview)) {
                                	echo $fo->name . "<br/>";
                                }
                            }
                    	?>
                    </td>
                    <td>
                    	<?php
                        	$strarray = str_replace(array("{", "}"), "", $result->constructionoverview);
                        	$arrconstructionoverview = explode(',', $strarray);
                            foreach ($constructionoverview as $co) {
                            	if (in_array($co->id, $arrconstructionoverview)) {
                                	echo $co->name . "<br/>";
                                }
                             }
                         ?>
                    </td>
	                
	                <td><?php echo @$result->dw; ?></td>
	                <td><?php echo @$result->dd; ?></td>
	                <td><?php echo @$result->dht; ?></td>
	                <td><?php echo @$result->nw; ?></td>
	                <td><?php echo @$result->gw; ?></td>
	                
	                <td><?php echo $result->customername ?></td>
	                <td align="center"><?php echo (!empty($result->date)) ? date('d/m/Y', strtotime($result->date)) : ''; ?></td>
	                
	                <td align="right"><?php echo $result->ratevalue ?></td>
	                
		            <?php if( in_array('view_fob_price_and_profit', $accessmenu) ){?>
		            
	                <td align="center"><?php echo $result->profit_percentage ?></td>
	                <td align="right"><?php echo $result->fob_price ?></td>
	                
	                <?php }?>
	                
	                <td><?php echo $result->preparedby ?></td>
					<td>
	                    <?php
					          echo $result->checkedby_name;
					          if ($result->checkedstatus != "") {
					            echo "<br/><font color='green'>Checked at: <br/>" . date('d/m/Y H:i:s', strtotime($result->checkedtime)) . "</font>";
		                 		echo "<br/><font color='green'>Status: <br/> <b>";
		                 		
		                 		if( $result->checkedstatus == 1 ){ //Approved
		                 			?>
                 		        	<a class="btn-success" style="padding:0px;padding-left:2px;padding-right:2px;"> Approved </a>
                 		        	<?php	
                 		        }else if( $result->checkedstatus == 2 ){ //Panding
                 		        	?>
                 		        	<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="costing_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->checkedstatus?>', 1);"> Panding </a>
                 		        	<?php 
                 		        }else{ //Reject
                 		        	?>
                 		        	<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="costing_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->checkedstatus?>', 1);"> Reject </a>
                 		        	<?php 
                 		        }
                 		        echo "</b></font>" ;
					                 		
					          } else {
						            if ($result->checkedby == $this->session->userdata('id') && $result->checkedstatus == "") {
						              echo "<br/><button onclick=costing_approve(" . $result->id . ",'" . $result->checkedby . "',1,1,0)>Approve</button>&nbsp;";
						              echo "<button onclick=costing_approve(" . $result->id . ",'" . $result->checkedby . "',2,1,0)>Pending</button>&nbsp;";
						              echo "<button onclick=costing_approve(" . $result->id . ",'" . $result->checkedby . "',3,1,0)>Reject</button>";
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
            	                 		<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="costing_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->approvedstatus?>', 2);"> Panding </a>
            	                 		<?php 
            	                 	}else{ //Reject
            	                 		?>
            	                 		<a href="javascript:void(0)" class="btn-warning" style="padding:0px;padding-left:2px;padding-right:2px;" onclick="costing_view_approval_notes('<?php echo $result->id ?>','<?php echo $result->approvedstatus?>', 2);"> Reject </a>
            	                 		<?php 
            	                 	}
            	                 	echo "</b></font>" ;					            
					            	
					          } else {
					            if ($result->approvedby == $this->session->userdata('id') && $result->approvedstatus == "") {
					              echo "<br/><button onclick=costing_approve(" . $result->id . ",'" . $result->approvedby . "',1,2,0)>Approve</button>&nbsp;";
					              echo "<button onclick=costing_approve(" . $result->id . ",'" . $result->approvedby . "',2,2,0)>Pending</button>&nbsp;";
					              echo "<button onclick=costing_approve(" . $result->id . ",'" . $result->approvedby . "',3,2,0)>Reject</button>";
					            } else {
					              echo "<br/><font color='blue'>Need to Approved</font>";
					            }
					        }
				          ?>
	                </td>
                
	                <td>
	                    <?php
	                        if (empty($result->rateid)) {
	                            if (in_array('add', $accessmenu)) {
	                                echo '<button class="btn btn-sm btn-primary" onclick="costing_createfromrequest(' . $result->id .')">Create</button>';
	                            }
	                        } else {
	                            if ($result->locked == 'f') {
	                                if (in_array('edit', $accessmenu)) {
	                                    echo '<a href="javascript:costing_edit(' . $result->id . ')"><button class="btn btn-sm btn-primary"> <i class="fa fa-edit fa-sm"></i> Edit Header</button> </a><br/>';
	                                }
	                            }
	                            if (in_array('view_detail', $accessmenu)) {
		                            echo '<a href="' . base_url() . 'costing/edit_print_out/' . $result->id . '/print/0" target="blank"><button class="btn btn-sm btn-success"> <i class="glyphicon glyphicon-search fa-sm"></i> View Detail</button> </a><br/>';
	                            }
	                            
	                            if (in_array('print', $accessmenu)) {
	                            	echo '<a href="' . base_url() . 'costing/prints/' . $result->id . '/print/0" target="_blank"><button class="btn btn-sm btn-warning"> <i class="glyphicon glyphicon-print fa-sm"></i> Print</button> </a><br/>';
	                            }
	                            
	                            if ($result->locked == 'f') {
	                                if (in_array('delete', $accessmenu)) {
	                                	echo '<a href="javascript:costing_delete(' . $result->id . ')"><button class="btn btn-sm btn-delete btn-danger"> Delete</button> </a><br/>';
	                                }
	                            }
	                        }
	                    
	                    	if (in_array('view_additional_notes', $accessmenu)) {
	                    		echo '<a href="javascript:costing_view_additional_notes(' . $result->id . ')"><button class="btn btn-sm btn-default" style="padding: 3px 7px;"> <i class="fa fa-edit fa-sm"></i> Notes</button> </a><br/>';
	                    	}
	                    
	                        if ($result->locked == 't') {
		                    	if (in_array('unlock', $accessmenu)) {
		                    		echo '<a href="javascript:costing_unlock(' . $result->id . ')"><button class="btn btn-sm btn-default" style="padding: 3px 7px;"> <img src = "images/unlock.png"/> Unlock</button> </a><br/>';
		                    	}
	                        }
	                        
	                        if (in_array('prints_cost_material_only_by_PRCH', $accessmenu)) {
		                    	echo '<a href="' . base_url() . 'costing/prints_cost_material_only/' . $result->id . '/print/0" target="blank"><button class="btn btn-sm btn-warning"> <i class="glyphicon glyphicon-print fa-sm"></i> Print Cost</button> </a><br/>';
		                    }
		                    
	                    ?>
	                </td>

	            </tr>
	            <?php
	        }
	        ?>
			</tbody>
		</table>
		</div>
		
		<div class="col-sm-12">
			<div style="margin-bottom: 5px;margin-top: 5px;" class="pull-right">
				<nav class="pagination pagination-sm">
					<input type="hidden" id="offset" value="<?php echo ($offset - 1) ?>" />
					<ul class="pagination">
						<li class="">
							<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="costing_search(0)">
								<strong><span class="fa fa-refresh"></span> Refresh</strong>
							</a> 
						</li>
						<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
						
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_search(<?php echo $first ?>)">First</a>
						</li>
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Previous" onclick="costing_search(<?php echo $prev ?>)">
					        <img src="images/prev.png" onclick="costing_search(<?php echo $prev ?>)" class="miniaction"/>
					      </a>
					    </li>
						
						<li class="page-item">
							<a class="page-link"><?php echo $page ?></a>
						</li>
						
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Next" onclick="costing_search(<?php echo $next ?>)">
					        <img src="images/next.png" onclick="costing_search(<?php echo $next ?>)" class="miniaction"/>
					      </a>
					    </li>
					    
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_search(<?php echo $last ?>)">Last</a>
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
		</div>


<script type="text/javascript">

	function model_imageview(filename){
		App.createContainer('model_imageview_temp');
		var bbox = bootbox.dialog({
			title: 'Image',
			message: $('#model_imageview_temp'),
			closeButton: true,
		});
		bbox.init(function () {
			$.get(url + 'model/imageview/' + filename, function (content) {
				$('#model_imageview_temp').empty().append(content);
			}).done(function () {
			}).fail(function (data) {
				bbox.modal("hide");
				Client.message.error({'data': data});
			});
		});
	}

	$(document).ready(function() {
		
	    var table = $('#table_costing').DataTable( {
	    	scrollY: "400px",
	        scrollX: true,
	        scrollCollapse: false,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: false,
	        "columnDefs": [
	        	{ "width": "10px", "targets": 1 }
	        ],
			fixedColumns: {
				leftColumns: 3,
				rightColumns: 3
			},
			
	    } );
	    
	} );
</script>