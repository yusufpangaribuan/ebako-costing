<script src="js/model.js"></script>
<script src="js/model_special_requirement.js"></script>
<br/>
<div id="model-tabs" class="tab-base">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#model_master_56y">Detail</a></li>
        <li><a data-toggle="tab" href="#model_harware_56y">Hardware</a></li>
        <li><a data-toggle="tab" href="#model_upholstry_56y">Upholstry</a></li>
        <li><a data-toggle="tab" href="#glass_mirror">Glass/Mirror [ <span style="font-style: italic;color: #f75d3f;font-size: 11px;">picklist</span> ]</a></li>
        <li><a data-toggle="tab" href="#model_marble_u6y">Marble [ <span style="font-style: italic;color: #f75d3f;font-size: 11px;">picklist</span> ]</a></li>
        <li><a data-toggle="tab" href="#model_frame_in_lay_56y">Inlay [ <span style="font-style: italic;color: #f75d3f;font-size: 11px;">picklist</span> ]</a></li>
        <li><a data-toggle="tab" href="#model_packing_material_56y">Packing Material</a></li>
        <li><a data-toggle="tab" href="#model_veneer">Veneer</a></li>
        <li><a data-toggle="tab" href="#model_solidwood">Solid Wood</a></li>
        <li><a data-toggle="tab" href="#model_plywood">Plywood/Panel [ <span style="font-style: italic;color: #f75d3f;font-size: 11px;">board</span> ]</a></li>
    </ul>
   <div class="tab-content">
	    <div id="model_master_56y" class="tab-detail tab-pane fade active in">
	        <table cellspacing="0" width="100%">
	        	<tbody>	
		            <tr style="vertical-align: top;">
		                <td style="60%">
		                    <table id="table_model_master_56y" class="table table-striped table-bordered" cellspacing="0" style="width: 100%;">
		                       <thead>
		                            <tr> 
		                                <th align="center">Image</td>
		                                <th align="center">Finishing Overview</td>
		                                <th align="center">Construction Overview</td>
		                            </tr>   
		                        </thead>
		                        <tbody>
		                            <tr valign="top">
		                                <td align="center" style="padding: 10px;<?php echo @$model->is_temporary_photo == 't'? 'background-color: #f75d3f;' : '' ?>">
		                                    <?php
		                                    
		                                    if ($model->filename == "") {
		                                        ?>
		                                        <img src="images/no-image.jpg" width=50%/>
		                                        <?php
		                                    } else {
		                                        ?>                                        
		                                        <img src="files/<?php echo $model->filename ?>" class="miniaction" onclick="model_imageview('<?php echo $model->filename ?>')" style="max-width: 100px;max-height: 100px;;width: 100px;height: 100px;"/>
		                                        <?php
		                                    }
		                                    ?>
		                                </td>
		                                <td>
		                                    <?php
		                                    $strarray = str_replace(array("{", "}"), "", $model->finishoverview);
		                                    $arrfinishoverview = explode(',', $strarray);
		                                    foreach ( $finishoverview as $result2 ) {
		                                        if (in_array($result2->id, $arrfinishoverview)) {
		                                            echo $result2->name . "<br/>";
		                                        }
		                                    }
		                                    ?>
		                                </td>
		                                <td>
		                                    <?php
		                                    $strarray = str_replace(array("{", "}"), "", $model->constructionoverview);
		                                    $arrconstructionoverview = explode(',', $strarray);
		                                    foreach ( $constructionoverview as $result2 ) {
		                                        if (in_array($result2->id, $arrconstructionoverview)) {
		                                            echo $result2->name . "<br/>";
		                                        }
		                                    }
		                                    ?>
		                                </td>
		                            </tr> 
		                       	</tbody>
		                    </table>
		                </td>
		                <td style="width: 50%">
		                    <?php
		                    if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
		                        ?>
		                        <table width="100%" border="0">
		                        	<thead></thead>
		                        	<tbody>        
			                            <tr valign="top">            
			                                <td>
			                                    <a href="javascript:void(0)" onclick="model_material_overview(<?php echo $id ?>)"><b>- Material Overview</b></a><br/>
			                                    <br/>
			                                    <a href="javascript:void(0)" onclick="model_special_requirement(<?php echo $id ?>)"><b>- Special Requirement</b></a><br/>
			                                    <br/>
			                                    <a href="javascript:void(0)" onclick="model_layout(<?php echo $id ?>)"><b>- Construction And Veneer Layout</b></a><br/>
			                                    <br/>
			                                    <a href="javascript:void(0)" onclick="model_reviewnotesandhistory(<?php echo $id ?>)"><b>- Review Notes and Product History</b></a><br/>
			                                    <br/>
			                                    <a href="javascript:void(0)" onclick="model_additionalnotes(<?php echo $id ?>)"><b>- Additional Notes</b></a><br/>
			                                </td>
			                                <td align="center" vertical-align="middle">
			                                    <?php
			                                    if (in_array('allow_create_bom', $accessmenu)) {
			                                        if ($model->ishavebom == 'f') {
			                                            echo "<button onclick='model_createbom(" . $id . ")' style='width:150px;height:30px;'>Create BOM</button>";
			                                        } else {
			                                            echo "<button onclick='model_createbom(" . $id . ")' style='width:150px;height:30px;'>Re-Create BOM</button>";
			                                            echo "<br/><br/><a href='" . base_url() . "index.php/model/print_bom/" . $id . "' target='blank'><img src='images/print.png' class='miniaction'/> Print BOM</a>";
			                                        }
			                                    }
			                                    ?>
			                                </td>
			                            </tr>       
			                         </tbody>    
		                        </table>
		                    <?php } ?>
		                    &nbsp;
		                </td>
		            </tr>
	            </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_model_master_56y').DataTable( {
				        scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	
	    <div id="model_harware_56y" class="tab-detail tab-pane fade">
	        <div style="margin-bottom: 6px;">        
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_addhardware($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <?php
	        if (!empty($hardwaretype)) {
	        	$counter = 0;
	            foreach ($hardwaretype as $hardwaretype) {
	            	$counter ++;
	                $hardware = $this->model_model->selectItemHarwareByModelId($id, $hardwaretype->hardwaretypeid);
	                ?>
	                <br/>
	                <span style="display: inline-block"><img class="miniaction" src="images/title.gif"><?php echo $hardwaretype->name ?></span>
	                <table id="table_model_harware_56y__<?php echo $counter; ?>" class="table table-striped table-bordered" cellspacing="0" style="width: 100%;">
	                	<thead>
	                        <tr>
	                            <th width="1%">No</th>
	                            <th width="10%">Material Code</th>
	                            <th width="20%">Material Description</th>
	                            <th width="5%">Qty</th>
	                            <th width="5%">Unit</th>                            
	                            <th width="15%">Location</th>                                                        
	                            <th width="">Supplier</th>
	                            <th width="12%">Notes</th>                                                        
	                            <th width="80px">Is Picklist?</th>                                                        
	                            <th width="120px">Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>    
	                        <?php
	                        $no = 1;
	                        foreach ($hardware as $hardware) {
	                            ?>
	                            <tr id="row-<?php echo $hardware->id ?>">
	                                <td align="right" class="no"><?php echo $no++ ?></td>
	                                <td class="partnumber"><?php echo $hardware->partnumber ?></td>
	                                <td class="description"><?php echo $hardware->description ?></td>
	                                <td align="center"><?php echo round($hardware->qty, 3); ?></td>
	                                <td align="center"><?php echo $hardware->unitcode ?></td>
	                                <td><?php echo $hardware->location ?></td>
	                                <td><?php echo $hardware->supplier ?></td>
	                                <td><?php echo $hardware->notes ?></td>
	                                <td><?php echo $hardware->is_picklist == 't' ? "Yes" : "No"; ?></td>
	                                <td>
	                                    <?php
	                                    if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                        if (in_array('edit_material', $accessmenu)) {
	                                            echo "<a href='javascript:void(0)' onclick = 'model_edithardware(" . $id . ", " . $hardware->id . ")'><img src='images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                        }
	                                        if (in_array('delete_material', $accessmenu)) {
	                                            echo "<a href='javascript:void(0)' onclick = 'model_deletehardware(" . $id . ", " . $hardware->id . ")'><img src='images/delete.png' class = 'miniaction' />Delete</a>";
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
	                <script type="text/javascript">
						$(document).ready(function() { 
						    var table = $('#table_model_harware_56y__<?php echo $counter; ?>').DataTable( {
						        scrollY: "300px",
						        scrollX: true,
						        scrollCollapse: true,
						        paging: false,
						        ordering: false,
						        info: false,
						        searching: false,
						        autoWidth: false,
						    } );
						    
						} );
					</script>
	                <?php
	            }
	        }
	        ?>
	
	    </div>
	    <div id="model_upholstry_56y" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setupholstry($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_model_upholstry_56y" class="table table-striped table-bordered" cellspacing="0" width="100%">
	        	<thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Material Code</th>
	                    <th rowspan="2" width="">Material Description</th>
	                    <th colspan="3" width="15%" style="text-align: center">Dimension</th>
	                    <th rowspan="2" width="5%">Qty</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th rowspan="2" width="10%">Location</th>
	                    <th rowspan="2" width="10%">Specification</th>
	                    <th rowspan="2" width="60">Is Picklist?</th>
	                    <th rowspan="2" width="120">Act</th>
	                </tr>
	                <tr>
	                    <th width="">Thickness</th>
	                    <th width="">Length</th>
	                    <th width="">Width</th>
	                </tr>
	                
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($upholstry)) {
	                    $no = 1;
	                    foreach ($upholstry as $result) {
	                        ?>
	                        <tr>
	                            <td><?php echo $no++; ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="description"> <?php echo $result->description ?></td>
	                            <td align="center"><?php echo $result->thickness ?></td>
	                            <td align="center"><?php echo $result->length ?></td>
	                            <td align="center"><?php echo $result->width ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td align="center"><?php echo $result->unitcode ?></td>
	                            <td><?php echo $result->location ?></td>
	                            <td><?php echo $result->specifications ?></td>
	                            <td style="text-align: center;"><?php echo $result->is_picklist == 't' ? "Yes" : "No"; ?></td>
	                            <td>
	                                <?php
		                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
		                                    if (in_array('edit_material', $accessmenu)) {
		                                        echo "<a href='javascript:void(0)' onclick = 'model_editupholstry(" . $id . ", " . $result->id . ")'><img src='images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
		                                    }
		                                    if (in_array('delete_material', $accessmenu)) {
		                                        echo "<a href='javascript:void(0)' onclick = 'model_delete_upholstry(" . $id . ", " . $result->id . ")'><img src='images/delete.png' class = 'miniaction' />Delete</a>";
		                                    }
		                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_model_upholstry_56y').DataTable( {
				        scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    <div id="glass_mirror" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">            
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setglass($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_glass_mirror" class="table table-striped table-bordered" cellspacing="0" width="100%">
	           <thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Material Code</th>
	                    <th rowspan="2" width="">Material Description</th>
	                    <th colspan="3" width="15%" style="text-align: center">Dimension</th>
	                    <th rowspan="2" width="5%">Qty</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Action</th>
	                </tr>
	                <tr>
	                    <th width="">Thickness</th>
	                    <th width="">Length</th>
	                    <th width="">Width</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($glass)) {
	                    $no = 1;
	                    foreach ($glass as $result) {
	                        ?>
	                        <tr id="model_glass_mirror_row-<?php echo $result->id ?>">
	                            <td><?php echo $no++ ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td align="center"><?php echo $result->thickness ?></td>
	                            <td align="center"><?php echo $result->length ?></td>
	                            <td align="center"><?php echo $result->width ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td><?php echo $result->codes ?></td>
	                            <td><?php echo $result->location ?></td>
	                            <td><?php echo $result->specifications ?></td>
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editglass(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deleteglass(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_glass_mirror').DataTable( {
				        scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    <div id="model_marble_u6y" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick='model_setmarble($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_model_marble_u6y" class="table table-striped table-bordered" cellspacing="0" width="100%">
	        	<thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Material Code</th>
	                    <th rowspan="2" width="">Material Description</th>
	                    <th colspan="3" width="15%" style="text-align: center">Dimension</th>
	                    <th rowspan="2" width="5%">Qty</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Action</th>
	                </tr>
	                <tr>
	                    <th width="">Thickness</th>
	                    <th width="">Length</th>
	                    <th width="">Width</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($marble)) {
	                    $no = 1;
	                    foreach ($marble as $result) {
	                        ?>
	                        <tr id="model_marble_row-<?php echo $result->id ?>">
	                            <td><?php echo $no++; ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td align="center"><?php echo $result->thickness ?></td>
	                            <td align="center"><?php echo $result->length ?></td>
	                            <td align="center"><?php echo $result->width ?></td>                          
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td align="center"><?php echo $result->codes ?></td>  
	                            <td><?php echo $result->location ?></td>
	                            <td><?php echo $result->specifications ?></td>
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editmarble(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deletemarble(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_model_marble_u6y').DataTable( {
				        scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    <div id="model_frame_in_lay_56y" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setlatherinlay($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_model_frame_in_lay_56y" class="table table-striped table-bordered" cellspacing="0" width="100%">
	        	<thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Material Code</th>
	                    <th rowspan="2" width="">Material Description</th>
	                    <th colspan="3" width="15%" style="text-align: center">Dimension</th>
	                    <th rowspan="2" width="5%">Qty</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Action</th>
	                </tr>
	                <tr>
	                    <th>Thick</th>
	                    <th>Length</th>
	                    <th>Width</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($latherinlay)) {
	                    $no = 1;
	                    foreach ($latherinlay as $result) {
	                        ?>
	                        <tr id="model_latherinlay_row-<?php echo $result->id ?>">
	                            <td align="right"><?php echo $no++; ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td align="center"><?php echo $result->thickness ?></td>
	                            <td align="center"><?php echo $result->length ?></td>
	                            <td align="center"><?php echo $result->width ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td align="center"><?php echo $result->codes ?></td>
	                            <td><?php echo $result->location ?></td>
	                            <td><?php echo $result->specifications ?></td>
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editlatherinlay(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deletelatherinlay(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	            </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_model_frame_in_lay_56y').DataTable( {
				        scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    <div id="model_packing_material_56y" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setpacking($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_model_packing_material_56y" class="table table-striped table-bordered" cellspacing="0" width="100%">
	           <thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Material Code</th>
	                    <th rowspan="2" width="">Material Description</th>
	                    <th colspan="3" width="15%" style="text-align: center">Dimension</th>
	                    <th rowspan="2" width="5%">Qty</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Action</th>
	                </tr>
	                <tr>
	                    <th>Thick</th>
	                    <th>Length</th>
	                    <th>Width</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($packing)) {
	                    $no = 1;
	                    foreach ($packing as $result) {
	                        ?>
	                        <tr id="model_packing_row-<?php echo $result->id ?>">
	                            <td align="right"><?php echo $no++; ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td align="center"><?php echo $result->width ?></td>
	                            <td align="center"><?php echo $result->depth ?></td>
	                            <td align="center"><?php echo $result->height ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td><?php echo $result->unitcode ?></td>
	                            <td><?php echo $result->location ?></td>
	                            <td><?php echo $result->specifications ?></td>
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editpacking(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deletepacking(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_model_packing_material_56y').DataTable( {
				        scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>   
	    </div>
	    
	    <!-- Veneer -->
	    <div id="model_veneer" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">            
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setveneer($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_veneer" class="table table-striped table-bordered" style="width:100%">
				<thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Code</th>
	                    <th rowspan="2" width="">Species</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th colspan="3" style="text-align: center">Qty (cbm)</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Act</th>
	                </tr>
	                <tr>
	                    <th width="5%">Yield</th>
	                    <th width="5%">Cutting List</th>
	                    <th width="5%">Requirement</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($veneer)) {
	                    $no = 1;
	                    foreach ($veneer as $result) {
	                        ?>
	                        <tr id="model_veneer_row-<?php echo $result->id ?>">
	                            <td><?php echo $no++ ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td><?php echo $result->codes ?></td>
	                            <td align="center"><?php echo $result->yield ?></td>
	                            <td align="center"><?php echo round($result->cutting_list, 3); ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td align="center"><?php echo $result->location ?></td>
	                            <td align="center"><?php echo $result->specifications ?></td>
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editveneer(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deleteveneer(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_veneer').DataTable( {
				    	scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    
	    <!-- Solid Wood -->
	    <div id="model_solidwood" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">            
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setsolidwood($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_solidwood" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Code</th>
	                    <th rowspan="2" width="">Species</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th colspan="3" style="text-align: center">Qty (cbm)</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Act</th>
	                </tr>
	                <tr>
	                    <th width="5%">Yield</th>
	                    <th width="5%">Cutting List</th>
	                    <th width="5%">Requirement</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($solidwood)) {
	                    $no = 1;
	                    foreach ($solidwood as $result) {
	                        ?>
	                        <tr id="model_solidwood_row-<?php echo $result->id ?>">
	                            <td><?php echo $no++ ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td><?php echo $result->codes ?></td>
	                            <td align="center"><?php echo $result->yield ?></td>
	                            <td align="center"><?php echo round($result->cutting_list, 3) ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td align="center"><?php echo $result->location ?></td>
	                            <td align="center"><?php echo $result->specifications ?></td>
	                            
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editsolidwood(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deletesolidwood(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_solidwood').DataTable( {
				    	scrollY: "300px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    
	    <!-- PlyWood -->
	    <div id="model_plywood" class="tab-detail tab-pane fade">
	        <div style="margin-top: 5px;margin-bottom: 6px">            
	            <?php
	            if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                if (in_array('add_material', $accessmenu)) {
	                    echo "<button class='btn btn-success' onclick = 'model_setplywood($id)'>Add</button>";
	                }
	            }
	            ?>
	        </div>
	        <table id="table_plywood" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
	                <tr>
	                    <th rowspan="2" width="2%">No</th>
	                    <th rowspan="2" width="10%">Code</th>
	                    <th rowspan="2" width="">Species</th>
	                    <th rowspan="2" width="5%">Unit</th>
	                    <th colspan="3" style="text-align: center">Qty (cbm)</th>
	                    <th rowspan="2" width="15%">Location</th>
	                    <th rowspan="2" width="15%">Specification</th>
	                    <th rowspan="2" width="120">Act</th>
	                </tr>
	                <tr>
	                    <th width="5%">Yield</th>
	                    <th width="5%">Cutting List</th>
	                    <th width="5%">Requirement</th>
	                </tr>
	                
	            </thead>
	            <tbody>
	                <?php
	                if (!empty($plywood)) {
	                    $no = 1;
	                    foreach ($plywood as $result) {
	                        ?>
	                        <tr id="model_solidwood_row-<?php echo $result->id ?>">
	                            <td><?php echo $no++ ?></td>
	                            <td class="partnumber"><?php echo $result->partnumber ?></td>
	                            <td class="descriptions"><?php echo $result->descriptions ?></td>
	                            <td><?php echo $result->codes ?></td>
	                            <td align="center"><?php echo $result->yield ?></td>
	                            <td align="center"><?php echo round($result->cutting_list, 3); ?></td>
	                            <td align="center"><?php echo round($result->qty, 3); ?></td>
	                            <td align="center"><?php echo $result->location ?></td>
	                            <td align="center"><?php echo $result->specifications ?></td>
	                            
	                            <td align="center">
	                                <?php
	                                if ($this->session->userdata('department') == 4 || $this->session->userdata('department') == 9 /*RND or CST*/) {
	                                    if (in_array('edit_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_editplywood(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
	                                    }
	                                    if (in_array('delete_material', $accessmenu)) {
	                                        echo "<a href='javascript:void(0)' onclick = 'model_deleteplywood(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
	                                    }
	                                }
	                                ?>
	                            </td>
	                        </tr>
	                        <?php
	                    }
	                }
	                ?>
	           </tbody>
	        </table>
	        <script type="text/javascript">
				$(document).ready(function() {
				    var table = $('#table_plywood').DataTable( {
				        scrollY: "500px",
				        scrollX: true,
				        scrollCollapse: true,
				        paging: false,
				        ordering: false,
				        info: false,
				        searching: false,
				        autoWidth: false,
				    } );
				    
				} );
			</script>
	    </div>
	    
	</div>
</div>