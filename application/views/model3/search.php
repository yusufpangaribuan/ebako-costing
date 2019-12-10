<div class="col-sm-12">
	<div style="margin-bottom: 5px; margin-top: 5px;" class="pull-right">
		<nav class="pagination pagination-sm">
			<input type="hidden" id="offset" value="<?php echo ($offset - 1) ?>" />
			<ul class="pagination">
				<li class=""><a class="page-link-2"
					style="color: #167495; cursor: pointer;" onclick="model_search(0)">
						<strong><span class="fa fa-refresh"></span> Refresh</strong>
				</a></li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>

				<li class="page-item"><a class="page-link" href="#"
					onclick="model_search(<?php echo $first ?>)">First</a></li>
				<li class="page-item"><a class="page-link" href="#"
					aria-label="Previous" onclick="model_search(<?php echo $prev ?>)">
						<img src="images/prev.png"
						onclick="model_search(<?php echo $prev ?>)" class="miniaction" />
				</a></li>

				<li class="page-item"><input
					class="form-control form-control-sm page-number" type="text"
					size="2" id="page" name="page" readonly=""
					value="<?php echo $page ?>" /></li>

				<li class="page-item"><a class="page-link" href="#"
					aria-label="Next" onclick="model_search(<?php echo $next ?>)"> <img
						src="images/next.png" onclick="model_search(<?php echo $next ?>)"
						class="miniaction" />
				</a></li>

				<li class="page-item"><a class="page-link" href="#"
					onclick="model_search(<?php echo $last ?>)">Last</a></li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<li class=""><a class="page-link-2"> Total: <strong><?php echo $num_page ?></strong>
						Page(s), <strong><?php echo $num_rows ?></strong> Row(s)
				</a></li>
			</ul>
		</nav>
	</div>
</div>


<table class="fixed_header" id="table_model" class="table table-striped table-bordered">
		<thead>
		<tr>
			<th width="2%" align=center>No</th>
			<th width="1%" align=center>&nbsp;</th>
			<th width="10%" align=center>Code</th>
			<th width="10%" align=center>Cust Code</th>
			<th width="18%" align=center>Description</th>
			<th width="10%" align=center>Color Finish</th>
			<th width="2%" align=center>W</th>
			<th width="2%" align=center>D</th>
			<th width="2%" align=center>HT</th>
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
			<td align="right"  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)"
				bgcolor='<?php echo $colour_td;?>'><?php echo $counter++ ?></td>
			<td align="center"
				onclick="model_viewdetail(<?php echo $result->id ?>)"
				bgcolor='<?php echo $colour_td;?>'><input type="checkbox"
				id="mdlid<?php echo $result->id ?>" name="mdl[]" /></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->no ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->custcode ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->description ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->color ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dw ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dd ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)" align="center"><?php echo $result->dht ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'
				onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->preparedby ?></td>
			<td  bgcolor='<?php echo $colour_td;?>'>

                    <?php
          echo $result->checkedby_name;
          if ($result->checkedstatus != "") {
            echo "<br/><font color='green'>Checked at: <br/>" .
                 date('d/m/Y H:i:s', strtotime($result->checkedtime)) . "</font>";
          } else 
            if ($result->checkedby == $this->session->userdata('id') &&
                 $result->checkedstatus == "") {
              echo "<br/><button onclick=model_approve(" . $result->id . ",'" .
               $result->checkedby . "',1,1,0)>Approve</button>&nbsp;";
              echo "<button onclick=model_approve(" . $result->id . ",'" .
                   $result->checkedby . "',2,1,0)>Pending</button>&nbsp;";
              echo "<button onclick=model_approve(" . $result->id . ",'" .
                   $result->checkedby . "',3,1,0)>Reject</button>";
            } else {
              echo "<br/><font color='blue'>Need to Checked</font>";
            }
          ?>
                </td>
			<!--<td     bgcolor='<?php echo $colour_td;?>' onclick="model_viewdetail(<?php echo $result->id ?>)"><?php echo $result->approvedby_name ?></td>-->
			<td  bgcolor='<?php echo $colour_td;?>'>

                    <?php
          echo $result->approvedby_name;
          if ($result->checkedstatus != "") {
            echo "<br/><font color='green'>Checked at: <br/>" .
                 date('d/m/Y H:i:s', strtotime($result->checkedtime)) . "</font>";
          } else 
            if ($result->approvedby == $this->session->userdata('id') &&
                 $result->approvedstatus == "") {
              echo "<br/><button onclick=model_approve(" . $result->id . ",'" .
               $result->approvedby . "',1,1,0)>Approve</button>&nbsp;";
              echo "<button onclick=model_approve(" . $result->id . ",'" .
                   $result->approvedby . "',2,1,0)>Pending</button>&nbsp;";
              echo "<button onclick=model_approve(" . $result->id . ",'" .
                   $result->approvedby . "',3,1,0)>Reject</button>";
            } else {
              echo "<br/><font color='blue'>Need to Approved</font>";
            }
          ?>
                </td>
			<td>
                    <?php
          // if (in_array('edit', $accessmenu)) {
          // echo "<a href='javascript:model_edit(" . $result->id . ")'><img
          // src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
          // }
          // if (in_array('delete', $accessmenu)) {
          // echo "<a href='javascript:model_delete(" . $result->id . ")'><img
          // src='images/delete.png'
          // class='miniaction'/>&nbsp;Delete&nbsp;</a>";
          // }
          //
          ?>
                    <div class="drop">
					<!-- 					<ul class="drop_menu"> -->
					<!-- 						<li> -->
					<!-- 							<a href='#'><img src='images/options.png' class='miniaction' />Options >></a> -->
					<!-- 							<ul> -->
                                    <?php
          if (in_array('edit', $accessmenu)) {
            echo "<a href='javascript:model_edit(" . $result->id .
                 ");model_viewdetail(" . $result->id .
                 ")'><img src='images/edit.png' class='miniaction'/></a>";
          }
          echo "&nbsp;&nbsp;&nbsp;";
          if (in_array('delete', $accessmenu)) {
            echo "<a href='javascript:model_delete(" . $result->id .
                 ");model_viewdetail(" . $result->id .
                 ")'><img src='images/delete.png' class='miniaction'/></a>";
          }
          if ($this->session->userdata('department') == 4) {
            if (in_array('copy', $accessmenu)) {
              echo "<a href='javascript:model_copy2(" . $result->id .
                   ");model_viewdetail(" . $result->id . ")'>Copy</a>";
            }
            if (in_array('view_cdss', $accessmenu)) {
              echo "<a href='javascript:model_cdsprint2(" . $result->id .
                   ");model_viewdetail(" . $result->id . ")'>Cdss</a>";
            }
            if (in_array('view_cutting_list', $accessmenu)) {
              echo "<a href='javascript:model_bom2(" . $result->id .
                   ");model_viewdetail(" . $result->id . ")'>Cutting List</a>";
            }
          }
          ?>                                    
<!--                                 </ul></li> -->
					<!-- 					</ul> -->
				</div>
			</td>
		</tr>
<?php
        }
        ?>
</table>
<!-- 
<div style="margin-bottom: 5px; margin-top: 5px;">
	<input type="hidden" id="offset" value="<?php echo $offset ?>" /> <img
		src="images/first.png" onclick="model_search(<?php echo $first ?>)"
		class="miniaction" /> <img src="images/prev.png"
		onclick="model_search(<?php echo $prev ?>)" class="miniaction" /> <input
		type="text" size="2" id="page" name="page" readonly=""
		value="<?php echo $page ?>" style="text-align: center" /> <img
		src="images/next.png" onclick="model_search(<?php echo $next ?>)"
		class="miniaction" /> <img src="images/last.png"
		onclick="model_search(<?php echo $last ?>)" class="miniaction" />
	&nbsp;&nbsp; Total Page <input type="text" size="2" id="page"
		name="page" readonly="" value="<?php echo $num_page ?>"
		style="text-align: center" /> Total Rows <input type="text" size="2"
		id="numrows" name="numrows" readonly=""
		value="<?php echo $num_rows ?>" style="text-align: center" />
</div>
-->

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#table_costing').DataTable( {
	        scrollY: "500px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: true,
			//fixedColumns: {
		    //    leftColumns: 3
		    //}
	    
	    } );
	    
	} );
</script>
