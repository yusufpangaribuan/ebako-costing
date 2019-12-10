		<div class="col-sm-12">
			<div style="margin-top: 5px;" class="pull-right">
				<nav class="pagination pagination-sm">
					<input type="hidden" id="offset" value="<?php echo ($offset - 1) ?>" />
					<ul class="pagination">
						<li class="">
							<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="costing_pricelist_search(0)">
								<strong><span class="fa fa-refresh"></span> Refresh</strong>
							</a> 
						</li>
						<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
						
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_pricelist_search(<?php echo $first ?>)">First</a>
						</li>
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Previous" onclick="costing_pricelist_search(<?php echo $prev ?>)">
					        <img src="<?php echo base_url()?>/images/prev.png" onclick="costing_pricelist_search(<?php echo $prev ?>)" class="miniaction"/>
					      </a>
					    </li>
						
						<li class="page-item">
							<a class="page-link"><?php echo $page ?></a>
						</li>
						
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Next" onclick="costing_pricelist_search(<?php echo $next ?>)">
					        <img src="<?php echo base_url()?>/images/next.png" onclick="costing_pricelist_search(<?php echo $next ?>)" class="miniaction"/>
					      </a>
					    </li>
					    
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_pricelist_search(<?php echo $last ?>)">Last</a>
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
		<table id="table_costing_pricelist" class="stripe row-border" style="width:100%">
			<?php 
				$ranges_length = sizeof($ranges);
			?>
		
		    <thead>
		        <tr>
		            <th rowspan="2">No</th>                        
		            <th rowspan="2">Image</th>
		            <th rowspan="2">Model Code</th>
		            <th rowspan="2">Cust. Code</th>
		            <th rowspan="2">Customer</th>
		            <th rowspan="2">Target Price</th>
		            <th colspan="<?php echo $ranges_length?>" style="text-align: center;">
		            	<b><?php echo @$price_list_base_on == "rate"? "Rate" : "Profit (%)" ;?></b>
		            </th>
		        </tr>
		        <tr>
		        	<?php 
		        		foreach ($ranges as $range){
		        			echo "<th>" . $range . "</th>";
		        		}
		        	?>
		        </tr>
			</thead>
			<tbody>
				<?php
			        $no = $offset;
			        foreach ($costing as $result) {
			            ?>
			            <tr valign="top">
			                <td align="right"><?php echo $no++; ?></td>
			                <td align="center">
					            <img src=" <?php echo base_url()?>/files/<?php echo @$result->filename; ?>" 
					            class="miniaction" onclick="model_imageview('<?php echo @$result->filename; ?>')" 
					            style="max-width: 40px;width: 40px;">
		                    </td>
		                    
			                <td> <?php echo $result->code; ?> </td>
			                <td><strong><?php echo $result->custcode ?></strong></td>
			                <td><?php echo $result->customername ?></td>
			                <td><?php echo @$target_price ?></td>
			                
			                <?php 
				        		foreach ($ranges as $range){
				        			echo "<td>" . $costing_details[ $result->id ][ $range ] . "</td>";
				        		}
				        	?>
			                
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
							<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="costing_pricelist_search(0)">
								<strong><span class="fa fa-refresh"></span> Refresh</strong>
							</a> 
						</li>
						<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
						
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_pricelist_search(<?php echo $first ?>)">First</a>
						</li>
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Previous" onclick="costing_pricelist_search(<?php echo $prev ?>)">
					        <img src="<?php echo base_url()?>/images/prev.png" onclick="costing_pricelist_search(<?php echo $prev ?>)" class="miniaction"/>
					      </a>
					    </li>
						
						<li class="page-item">
							<a class="page-link"><?php echo $page ?></a>
						</li>
						
						<li class="page-item">
					      <a class="page-link" href="#" aria-label="Next" onclick="costing_pricelist_search(<?php echo $next ?>)">
					        <img src="<?php echo base_url()?>/images/next.png" onclick="costing_pricelist_search(<?php echo $next ?>)" class="miniaction"/>
					      </a>
					    </li>
					    
						<li class="page-item">
							<a class="page-link" href="#" onclick="costing_pricelist_search(<?php echo $last ?>)">Last</a>
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
		
	    var table = $('#table_costing_pricelist').DataTable( {
	    	scrollY: "300px",
	        scrollX: true,
	        scrollCollapse: false,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: false,

			fixedColumns: {
				leftColumns: 2,
				//rightColumns: 1
			},
			
	    } );
	    
	} );
</script>