<table id="table_directlabour" class="table table-striped table-bordered " cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="1%">NO</th>
            <th>Description</th>
            <th width="150">Unit</th>            
            <th width="100">Percentage(%)</th>
            <th width="100">Price (Rp)</th>
            <th width="200">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($directlabor as $result) {
            ?>
            <tr>
                <td align="right"><?php echo $no++; ?></td>
                <td><?php echo $result->description ?></td>
                <td align="center"><?php echo $result->unit ?></td>
                <td align="center"><?php echo $result->percentage ?></td>
                <td align="right">
                    <?php
                    if (in_array('view_price', $accessmenu)) {
                        echo number_format($result->price, 0, ',', '.');
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td align="center">
                    <?php
                    if (in_array('edit', $accessmenu)) {
                        echo "<a href='javascript:directlabour_edit($result->id)'><img src='images/edit.png' class='miniaction'/>&nbsp;Edit&nbsp;</a>";
                    }
                    if (in_array('delete', $accessmenu)) {
                        echo "<a href='javascript:directlabour_delete($result->id)'><img src='images/delete.png' class='miniaction'/>&nbsp;Delete</a>";
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
			<input type="hidden" id="offset" value="<?php echo ($offset - 1) ?>" />
			<ul class="pagination">
				<li class="">
					<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="directlabour_search(0)">
						<strong><span class="fa fa-refresh"></span> Refresh</strong>
					</a> 
				</li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
				
				<li class="page-item">
					<a class="page-link" href="#" onclick="directlabour_search(<?php echo $first ?>)">First</a>
				</li>
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Previous" onclick="directlabour_search(<?php echo $prev ?>)">
			        <img src="images/prev.png" onclick="directlabour_search(<?php echo $prev ?>)" class="miniaction"/>
			      </a>
			    </li>
				
				<li class="page-item">
					<a class="page-link"><?php echo $page ?></a>
				</li>
				
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Next" onclick="directlabour_search(<?php echo $next ?>)">
			        <img src="images/next.png" onclick="directlabour_search(<?php echo $next ?>)" class="miniaction"/>
			      </a>
			    </li>
			    
				<li class="page-item">
					<a class="page-link" href="#" onclick="directlabour_search(<?php echo $last ?>)">Last</a>
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
	    var table = $('#table_directlabour').DataTable( {
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
