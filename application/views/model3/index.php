<script src="js/global.js"></script>
<script src="js/model.js"></script>
<script src="js/item.js"></script>
<div style="height: 50%; width: 100%; border-bottom: 4px #ddd inset">
	<h4>Model</h4>
	<table width="100%" border="0">
		<tr>
			<td width="70%">
				<div align="left" style="padding-top: 2px;">
					<input type="hidden" id="modelid" value="0" /> <span
						class="labelelement">Find :</span> <input type="text"
						name="code_s" placeholder="Code" id="code_s" size="10"
						onkeypress="if (event.keyCode == 13) {
                                       model_search(0);
                                   }" /> <input type="text"
						name="custcode_s" placeholder="Customer Code" id="custcode_s"
						size="15"
						onkeypress="if (event.keyCode == 13) {
                                model_search(0)
                            }" /> <input type="text"
						placeholder="Description" name="description_s" id="description_s"
						size="15"
						onkeypress="if (event.keyCode == 13) {
                                model_search(0)
                            }" /> <select id="modeltypeid_s"
						onchange="model_search(0)" style="width: 80px">
						<option value="0">Type</option>
                        <?php
                        foreach ($modeltype as $modeltype) {
                          echo "<option value='" . $modeltype->id . "'>" .
                               $modeltype->name . "</option>";
                        }
                        ?>
                    </select>
					<button onclick="model_search(0)">Search</button>
                    <?php
                    if ($this->session->userdata('department') == 4) {
                      if (in_array('add', $accessmenu)) {
                        echo "<button onclick = 'model_create()'>Add</button>";
                      }
                      if (in_array('copy', $accessmenu)) {
                        echo "<button onclick = 'model_copy()'>Copy</button>";
                      }
                      if (in_array('view_cdss', $accessmenu)) {
                        echo "<button onclick = 'model_cdsprint()'>Cdss</button>";
                      }
                      if (in_array('view_cutting_list', $accessmenu)) {
                        echo "<button onclick = 'model_bom()'>Cutting List</button>";
                      }
                    }
                    ?>
                </div>
			</td>
			<!-- 
			<td width="30%">
                <?php
                if ($numberrequest > 0 &&
                     $this->session->userdata('department') == 4) {
                  ?>
                    <div style="font-size: 12px; margin: 5px;">
					<a href="javascript:void(0)" style="color: #fa0202;"
						onclick="model_viewrequest()"><?php echo $numberrequest ?> Request for New Model</a>
				</div>
                <?php } ?>
            </td> -->
		</tr>
		<tr>
			<td colspan="2">
				<div id="modeldata" align="center" style="overflow-x: hidden">                    
                    <?php
                    $data['offset'] = $offset;
                    $this->load->view('model/search', $data);
                    ?>
                </div>
			</td>
		</tr>
	</table>
</div>
<div style="height: 50%; width: 100%;" id="modeldetail"></div>