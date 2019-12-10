<table id="table_user" class="table table-striped table-bordered " cellspacing="0" width="100%">
    <thead>
        <tr>
            <th width="10">No</th>
            <th width="100">ID</th>
            <th width="200">Name</th>                        
            <th width="200">Department</th>
            <?php
                if ($this->session->userdata('id') == 'admin') {
            ?>
            <th>Action</th>
            <?php } ?>
                
        </tr>
    </thead>
    <tbody>
            <?php
            $number = $offset + 1;
            foreach ($users as $users) {
                ?>
                <tr>
                    <td align="right"><?php echo $number++ ?></td>
                    <td align="left"><?php echo $users->id ?></td>
                    <td align="left"><?php echo $users->name ?></td>
                    <td align="left"><?php echo $users->departmentname ?></td>
                    <?php
                    if ($this->session->userdata('id') == 'admin') {
                        ?>
                        <td>
                            <a style="padding-right: 20px;" href="javascript:user_adminchangepassword('<?php echo $users->id ?>')"><img title="Change Password" src="images/change_password.png" />&nbsp;Change Password</a>
                            <a style="padding-right: 20px;" href="javascript:user_delete('<?php echo $users->id ?>')"><img title="Delete" src="images/delete.png">&nbsp;Delete</a>
                            <a style="padding-right: 20px;" href="javascript:user_config('<?php echo $users->id ?>')"><img title="Configure User" src="images/user_config.png">Access</a>
                            <?php
                            if ($users->enabled == 't') {
                                echo "<a href=javascript:user_enable('" . $users->id . "','FALSE')><img title='Enable User' src='images/disable.png'>Disable</a>";
                            } else {
                                echo "<a href=javascript:user_enable('" . $users->id . "','TRUE')><img title='Disabled User' src='images/enable.png'>Enable</a>";
                            }
                            ?>
                        </td>
                    <?php } ?>
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
					<a class="page-link-2" style="color: #167495;cursor: pointer;" onclick="user_search(0)">
						<strong><span class="fa fa-refresh"></span> Refresh</strong>
					</a> 
				</li>
				<li class="">&nbsp;&nbsp;&nbsp;&nbsp;</li>
				
				<li class="page-item">
					<a class="page-link" href="#" onclick="user_search(<?php echo $first ?>)">First</a>
				</li>
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Previous" onclick="user_search(<?php echo $prev ?>)">
			        <img src="images/prev.png" onclick="user_search(<?php echo $prev ?>)" class="miniaction"/>
			      </a>
			    </li>
				
				<li class="page-item">
					<a class="page-link"><?php echo $page ?></a>
				</li>
				
				<li class="page-item">
			      <a class="page-link" href="#" aria-label="Next" onclick="user_search(<?php echo $next ?>)">
			        <img src="images/next.png" onclick="user_search(<?php echo $next ?>)" class="miniaction"/>
			      </a>
			    </li>
			    
				<li class="page-item">
					<a class="page-link" href="#" onclick="user_search(<?php echo $last ?>)">Last</a>
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
	    var table = $('#table_user').DataTable( {
	        scrollY: "360px",
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
