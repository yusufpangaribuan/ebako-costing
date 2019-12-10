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
					<input class="form-control form-control-sm page-number" type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>"/>
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

<div class="col-sm-12">
		<table class="table table-responsive-sm table-bordered table-striped table-hover table-outline mb-0">
		    <thead class="thead-light" style="background: #f9f9f9 !important;">
		        <tr style="border-top: 4px solid #ec9821;">
		            <th width="2%" rowspan="2">No</th>                        
		            <th width="16%" colspan="2" class="text-center">Model</th>
		            <th width="16%" rowspan="2">Description</th>
		            <th width="13%" rowspan="2">Customer</th>
		            <th width="5%" rowspan="2">Date</th>
		            <th width="5%" rowspan="2">Rate</th>
		            <th width="10%" colspan="3" class="text-center">Cost (%)</th>
		            <th width="3%" rowspan="2">Prof(%).</th>
		            <th width="10%" rowspan="2">FOB Price</th>                        
		            <th width="10%" rowspan="2">Action</th>
		            <th width="5%" rowspan="2">Status</th>
		        </tr>
		        <tr>
		            <th width="10%">Code</th>
		            <th width="6%">Cust. Code</th>
		            <th width="3%">Fixed</th>
		            <th width="4%">Var</th>
		            <th width="3%">Port</th>
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
	            <tr valign="top" <?php echo $bgcolor ?>>
	                <td align="right" class="pinned"><?php echo $no++; ?></td>
	                <td>
	                    <?php
	                    echo $result->code;
	                    echo $msg;
	                    ?>
	                </td>
	                <td><strong><?php echo $result->custcode ?></strong></td>
	                <td><?php echo $result->description ?></td>
	                <td><?php echo $result->customername ?></td>
	                <td align="center"><?php echo (!empty($result->date)) ? date('d/m/Y', strtotime($result->date)) : ''; ?></td>
	                <td align="right"><?php echo $result->ratevalue ?></td>
	                <td align="center"><?php echo $result->fixed_cost ?></td>
	                <td align="center"><?php echo $result->variable_cost ?></td>
	                <td align="center"><?php echo $result->port_origin_cost ?></td>
	                <td align="center"><?php echo $result->profit_percentage ?></td>
	                <td align="right"><?php echo $result->fob_price ?></td>
	                <td>
	                    <?php
	                    if ($this->session->userdata('department') == 9) {
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
	                                echo '<a href="javascript:costing_build('.$result->id.',1)"><button class="btn btn-sm btn-success"> <i class="fa search-plus fa-sm"></i> View Detail</button> </a><br/>';
	                            }
	                            
	                            echo '<a href="costing/prints/' . $result->id . '/print/0" target="blank"><button class="btn btn-sm btn-warning"> <i class="glyphicon glyphicon-print fa-sm"></i> Print</button> </a><br/>';
	                            
	                            echo '<a href="javascript:costing_history(' . $result->id . ')"><button class="btn btn-sm btn-primary"> History</button> </a><br/>';
	                            
	                            if ($result->isreviewed == 'f' || $result->locked == 'f') {
	                                if (in_array('delete', $accessmenu)) {
	                                	echo '<a href="javascript:costing_delete(' . $result->id . ')"><button class="btn btn-sm btn-delete btn-danger"> Delete</button> </a><br/>';
	                                }
	                            }
	                        }
	                    }
	                    if ($this->session->userdata('department') == 1) {
	                        if ($result->locked == 't') {
	                            echo "<span onclick = 'costing_unlock(" . $result->id . ")' class = 'miniaction' style = 'margin-right: 50px;'><img src = 'images/unlock.png'/>&nbsp;UnLock</span><br/>";
	                        }
	                        echo "<a href='javascript:costing_build($result->id,1)'><img src='images/configuration.png'>&nbsp;View Detail</a><br/>";
	                        echo "<a href='" . base_url() . "index.php/costing/prints/$result->id/print/0' target='blank'><img src='images/print.png'>&nbsp;Print</a><br/>";
	                    }
	                    ?>
	                </td>
	                <td align="center">
	                    <?php
	                    if ($result->locked == 't') {
	                        if ($result->approve == 'f') {
	                            if ($this->session->userdata('department') == 9) {
	                                echo "<button onclick='costing_approve($result->id)'>Approve</button>";
	                            }
	                        } else {
	                            echo "Approved";
	                        }
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
					<input class="form-control form-control-sm page-number" type="text" size="2" id="page" name="page" readonly="" value="<?php echo $page ?>"/>
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