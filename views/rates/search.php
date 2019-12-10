<table id="table_rates" class="table table-striped table-bordered " cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th width="9%">ID</th>
            <th width="8%">Date</th>            
            <th width="6%">Currency</th>            
            <th width="10%">Exchange Rate</th>
            <th width="10%">Input By</th>
            <th width="10%">Input Time</th>
            <th width="12%">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = ($offset > 0 ? $offset + 1 : 1);
        foreach ($rates as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $number++ ?></td>
                <td><?php echo $result->evidence_number ?>&nbsp;</td>
                <td align="center"><?php echo date('d-m-Y', strtotime($result->date)) ?></td>
                <td align="center"><?php echo $result->currency ?></td>
                <td align="right"><?php echo number_format($result->exchange_rate, 2) ?></td>
                <td><?php echo $result->user_inserted_name ?></td>
                <td align="right"><?php echo date('d-m-Y h:i:s', strtotime($result->insert_time)) ?></td>
                <td>
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:rates_edit($result->id)'><img class='miniaction' src='images/edit.png'>Edit&nbsp;&nbsp;&nbsp;</a>";
                    }if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:rates_delete($result->id)'><img class='miniaction' src='images/delete.png'>Delete&nbsp;</a>";
                    }
                    ?>                            
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<div class="col-sm-12">
	<div style="margin-top: 5px;" class="pull-right">
		<nav class="pagination pagination-sm">
			<input type="hidden" id="offset" value="<?php echo ($offset > 0 ? $offset - 1 : 0) ?>" />
			<ul class="pagination">
				<li class="">
					<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="rates_search(0)">
						<strong><span class="fa fa-refresh"></span> Refresh</strong>
					</a> 
				</li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
				
				<li class="page-item">
					<a class="page-link" href="#" onclick="rates_search(<?php echo $first ?>)">First</a>
				</li>
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Previous" onclick="rates_search(<?php echo $prev ?>)">
			        <img src="images/prev.png" onclick="rates_search(<?php echo $prev ?>)" class="miniaction"/>
			      </a>
			    </li>
				
				<li class="page-item">
					<a class="page-link"><?php echo $page ?></a>
				</li>
				
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Next" onclick="rates_search(<?php echo $next ?>)">
			        <img src="images/next.png" onclick="rates_search(<?php echo $next ?>)" class="miniaction"/>
			      </a>
			    </li>
			    
				<li class="page-item">
					<a class="page-link" href="#" onclick="rates_search(<?php echo $last ?>)">Last</a>
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
	$(document).ready(function() {
	    var table = $('#table_rates').DataTable( {
	        scrollY: "500px",
	        scrollX:true,
	        scrollCollapse: true,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: true,
	    } );
	} );
</script>
