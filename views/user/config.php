<div style="width: 400px">
    <table id="user_listsearch" class="table table-striped table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th width="40%">Menu</th>
                <th width="60%">Action</th>
            </tr>            
        </thead>
        <tbody>
            <?php
            foreach ($menu as $menu) {
                $checked = "";
                if ($this->model_user->isHaveAccess($userid, $menu->scriptview) > 0) {
                    $checked = "checked";
                }
                echo "<tr>
                            <td>" . $menu->label . "</td>
                            <td>
                            <input type='checkbox' disabled name='menu' value='" . $menu->scriptview . "' " . $checked . " />
                            <a href=javascript:user_setaction('" . $userid . "','" . str_replace("/", "_", $menu->scriptview) . "')>
                                <img src='images/setting.png'/> Setting</a>&nbsp;";
                if ($checked != "") {
                    echo "<a href=javascript:user_removeaction('" . $userid . "','" . $menu->scriptview . "')>
                                <img src='images/erase.png'/> Remove</a>";
                }

                echo "</td>
                        </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#user_listsearch').DataTable( {
	        scrollY: "350px",
	        scrollX: true,
	        scrollCollapse: true,
	        paging: false,
	        ordering: false,
	        info: false,
	        searching: false,
	        autoWidth: true,
	    } );
	} );
</script>
