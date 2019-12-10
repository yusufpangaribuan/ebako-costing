<div id="model-tabs" style="height: 100%">
    <ul>
        <li><a href="#model_master_56y" onclick="model_last_tab = '#model_master_56y';">DETAIL INFORMATION</a></li>
        <li><a href="#model_harware_56y" onclick="model_last_tab = '#model_harware_56y';">HARDWARE</a></li>
        <li><a href="#model_upholstry_56y" onclick="model_last_tab = '#model_upholstry_56y';">UPHOLSTRY</a></li>
        <li><a href="#glass_mirror" onclick="model_last_tab = '#glass_mirror';">GLASS / MIRROR</a></li>
        <li><a href="#model_marble_u6y" onclick="model_last_tab = '#model_marble_u6y';">MARBLE</a></li>
        <li><a href="#model_frame_in_lay_56y" onclick="model_last_tab = '#model_frame_in_lay_56y';">FRAME / INLAY</a></li>
        <li><a href="#model_packing_material_56y" onclick="model_last_tab = '#model_packing_material_56y';">PACKING MATERIAL</a></li>
    </ul>
    <div id="model_master_56y" style="min-height: 250px;overflow-y: auto">
        <table width='100%'>
            <tr valign='top'>
                <td width='50%'>
                    <table class="tablesorter2" width="100%">
                        <thead>
                            <tr>
                                <th align="center">Image</td>
                                <th align="center">Finishing Overview</td>
                                <th align="center">Construction Overview</td>
                            </tr>   
                        </thead>
                        <tbody>
                            <tr valign="top">
                                <td align="center">
                                    <?php
                                    if ($model->filename == "") {
                                        ?>
                                        <img src="images/no-image.jpg" style="max-width: 100px;max-height: 100px;;width: 100px;height: 100px;"/>
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
                                    foreach ($finishoverview as $result2) {
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
                                    foreach ($constructionoverview as $result2) {
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
                <td>
                    <?php
                    if ($this->session->userdata('department') == 4) {
                        ?>
                        <table width="100%" border="0">        
                            <tr valign="top">            
                                <td>
                                    <a href="javascript:void(0)" onclick="model_material_overview(<?php echo $id ?>)"><b>- Material Overview</b></a><br/>
                                    <a href="javascript:void(0)" onclick="model_layout(<?php echo $id ?>)"><b>- Construction And Veneer Layout</b></a><br/>
                                    <a href="javascript:void(0)" onclick="model_reviewnotesandhistory(<?php echo $id ?>)"><b>- Review Notes and Product History</b></a><br/>
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
                        </table>
                    <?php } ?>
                    &nbsp;
                </td>
            </tr>
        </table>
    </div>

    <div id="model_harware_56y" style="height: 250px;overflow-y: auto">
        <div style="margin-bottom: 6px;">        
            <?php
            if ($this->session->userdata('department') == 4) {
                if (in_array('add_material', $accessmenu)) {
                    echo "<button onclick = 'model_addhardware($id)'>Add</button>";
                }
            }
            ?>
        </div>
        <?php
        if (!empty($hardwaretype)) {
            foreach ($hardwaretype as $hardwaretype) {
                $hardware = $this->model_model->selectItemHarwareByModelId($id, $hardwaretype->hardwaretypeid);
                ?>
                <span style="display: inline-block"><img class="miniaction" src="images/title.gif"><?php echo $hardwaretype->name ?></span>
                <table class="tablesorter2" id="tbl_mdl_hardware_11" width="100%" align="center">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="10%">Material Code</th>
                            <th width="29%">Material Description</th>
                            <th width="10%">Qty</th>
                            <th width="5%">Unit</th>                            
                            <th width="15%">Location</th>                                                        
                            <th width="25%">Remark</th>
                            <th width="5%">Act</th>
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
                                <td align="center"><?php echo $hardware->qty ?></td>
                                <td align="center"><?php echo $hardware->unitcode ?></td>
                                <td><?php echo $hardware->location ?></td>
                                <td><?php echo $hardware->supplier ?></td>
                                <td>
                                    <?php
                                    if ($this->session->userdata('department') == 4) {
                                        if (in_array('delete_material', $accessmenu)) {
                                            echo "<a href='javascript:void(0)' onclick = 'model_edithardware(" . $id . ", " . $hardware->id . ")'><img src='images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
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
                <?php
            }
        }
        ?>

    </div>
    <div id="model_upholstry_56y">
        <div style="margin-top: 5px;margin-bottom: 6px">
            <?php
            if ($this->session->userdata('department') == 4) {
                if (in_array('add_material', $accessmenu)) {
                    echo "<button onclick = 'model_setupholstry($id)'>Add</button>";
                }
            }
            ?>
        </div>
        <table width="100%" class="tablesorter2" id="model_upholstry_56y">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">No</th>
                    <th rowspan="2" width="10%">Material Code</th>
                    <th rowspan="2" width="20%">Material Description</th>
                    <th colspan="3" width="15%">Dimension</th>
                    <th rowspan="2" width="5%">Qty</th>
                    <th rowspan="2" width="5%">Unit</th>
                    <th rowspan="2" width="15%">Location</th>
                    <th rowspan="2" width="5%">Act</th>
                </tr>
                <tr>
                    <th width="5%">Thickness</th>
                    <th width="5%">Length</th>
                    <th width="5%">Width</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($upholstry)) {
                    $no = 1;
                    foreach ($upholstry as $result) {
                        ?>
                        <tr id="model_upholstry_row-<?php echo $result->id ?>">
                            <td><?php echo $no++; ?></td>
                            <td class="partnumber"><?php echo $result->partnumber ?></td>
                            <td class="description"> <?php echo $result->description ?></td>
                            <td align="center"><?php echo $result->thickness ?></td>
                            <td align="center"><?php echo $result->length ?></td>
                            <td align="center"><?php echo $result->width ?></td>
                            <td align="center"><?php echo $result->qty ?></td>
                            <td align="center"><?php echo $result->unitcode ?></td>
                            <td><?php echo $result->location ?></td>
                            <td>
                                <?php
                                if ($this->session->userdata('department') == 4) {
                                    if (in_array('delete_material', $accessmenu)) {
                                        echo "<a href='javascript:void(0)' onclick = 'model_editupholstry(" . $id . ", " . $result->id . ")'><img src='images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
                                        echo "<a href='javascript:void(0)' onclick = 'model_delete_upholstry(" . $id . ", " . $result->id . ")'><img src='images/delete.png' class = 'miniaction' />Delete</a>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="10">No Data..</td>                                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="glass_mirror" style="height: 200px;overflow-y: auto">
        <div style="margin-top: 5px;margin-bottom: 6px">            
            <?php
            if ($this->session->userdata('department') == 4) {
                if (in_array('add_material', $accessmenu)) {
                    echo "<button onclick = 'model_setglass($id)'>Add</button>";
                }
            }
            ?>
        </div>
        <table width="100%" class="tablesorter2">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">No</th>
                    <th rowspan="2" width="10%">Material Code</th>
                    <th rowspan="2" width="20%">Material Description</th>
                    <th colspan="3" width="15%">Dimension</th>
                    <th rowspan="2" width="5%">Qty</th>
                    <th rowspan="2" width="5%">Unit</th>
                    <th rowspan="2" width="15%">Location</th>
                    <th rowspan="2" width="5%">Act</th>
                </tr>
                <tr>
                    <th width="5%">Thick</th>
                    <th width="5%">Length</th>
                    <th width="5%">Width</th>
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
                            <td align="center"><?php echo $result->qty ?></td>
                            <td><?php echo $result->codes ?></td>
                            <td><?php echo $result->location ?></td>
                            <td align="center">
                                <?php
                                if ($this->session->userdata('department') == 4) {
                                    if (in_array('delete_material', $accessmenu)) {
                                        echo "<a href='javascript:void(0)' onclick = 'model_editglass(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
                                        echo "<a href='javascript:void(0)' onclick = 'model_deleteglass(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="10">NO Data...</td>                                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="model_marble_u6y" style="height: 200px;overflow-y: auto">
        <div style="margin-top: 5px;margin-bottom: 6px">
            <?php
            if ($this->session->userdata('department') == 4) {
                if (in_array('add_material', $accessmenu)) {
                    echo "<button onclick='model_setmarble($id)'>Add</button>";
                }
            }
            ?>
        </div>
        <table width="100%" class="tablesorter2">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">No</th>
                    <th rowspan="2" width="10%">Type</th>
                    <th rowspan="2" width="10%">Material Code</th>
                    <th rowspan="2" width="20%">Material Description</th>
                    <th colspan="3" width="20%">Dimension</th>
                    <th rowspan="2" width="5%">Qty</th>
                    <th rowspan="2" width="5%">Unit</th>
                    <th rowspan="2" width="20%">Location</th>
                    <th rowspan="2" width="5%">Act</th>
                </tr>
                <tr>
                    <th>Thick</th>
                    <th>Length</th>
                    <th>Width</th>
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
                            <td><?php echo $result->type ?></td>
                            <td class="partnumber"><?php echo $result->partnumber ?></td>
                            <td class="descriptions"><?php echo $result->descriptions ?></td>
                            <td align="center"><?php echo $result->thickness ?></td>
                            <td align="center"><?php echo $result->length ?></td>
                            <td align="center"><?php echo $result->width ?></td>                          
                            <td align="center"><?php echo $result->qty ?></td>
                            <td align="center"><?php echo $result->codes ?></td>  
                            <td><?php echo $result->location ?></td>
                            <td align="center">
                                <?php
                                if ($this->session->userdata('department') == 4) {
                                    if (in_array('delete_material', $accessmenu)) {
                                        echo "<a href='javascript:void(0)' onclick = 'model_editmarble(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
                                        echo "<a href='javascript:void(0)' onclick = 'model_deletemarble(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11">No Data..</td>                                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="model_frame_in_lay_56y" style="height: 200px;overflow-y: auto">
        <div style="margin-top: 5px;margin-bottom: 6px">
            <?php
            if ($this->session->userdata('department') == 4) {
                if (in_array('add_material', $accessmenu)) {
                    echo "<button onclick = 'model_setlatherinlay($id)'>Add</button>";
                }
            }
            ?>
        </div>
        <table width="100%" class="tablesorter2">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">No</th>
                    <th rowspan="2" width="10%">Material Code</th>
                    <th rowspan="2" width="20%">Material Description</th>
                    <th colspan="3">Dimension</th>
                    <th rowspan="2" width="5%">Qty</th>
                    <th rowspan="2" width="5%">Unit</th>
                    <th rowspan="2" width="15%">Location</th>
                    <th rowspan="2" width="5%">Act</th>
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
                            <td align="center"><?php echo $result->qty ?></td>
                            <td align="center"><?php echo $result->codes ?></td>
                            <td><?php echo $result->location ?></td>
                            <td align="center">
                                <?php
                                if ($this->session->userdata('department') == 4) {
                                    if (in_array('delete_material', $accessmenu)) {
                                        echo "<a href='javascript:void(0)' onclick = 'model_editlatherinlay(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
                                        echo "<a href='javascript:void(0)' onclick = 'model_deletelatherinlay(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="10">No Data..</td>                                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div id="model_packing_material_56y" style="height: 200px;overflow-y: auto">
        <div style="margin-top: 5px;margin-bottom: 6px">
            <?php
            if ($this->session->userdata('department') == 4) {
                if (in_array('add_material', $accessmenu)) {
                    echo "<button onclick = 'model_setpacking($id)'>Add</button>";
                }
            }
            ?>
        </div>
        <table width="100%" class="tablesorter2">
            <thead>
                <tr>
                    <th rowspan="2" width="2%">No</th>
                    <th rowspan="2" width="10%">Material Code</th>
                    <th rowspan="2" width="15%">Material Description</th>
                    <th colspan="3">Dimension</th>
                    <th rowspan="2" width="5%">Qty</th>
                    <th rowspan="2" width="5%">Unit</th>
                    <th rowspan="2" width="10%">Location</th>                    
                    <th rowspan="2" width="15%">Remark</th>
                    <th rowspan="2" width="5%">Act</th>
                </tr>
                <tr>
                    <th width="5%">Width</th>
                    <th width="5%">Dept</th>
                    <th width="5%">Height</th>
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
                            <td align="center"><?php echo $result->qty ?></td>
                            <td><?php echo $result->unitcode ?></td>
                            <td><?php echo $result->location ?></td>
                            <td><?php echo $result->remark ?></td>
                            <td align="center">
                                <?php
                                if ($this->session->userdata('department') == 4) {
                                    if (in_array('delete_material', $accessmenu)) {
                                        echo "<a href='javascript:void(0)' onclick = 'model_editpacking(" . $id . ", " . $result->id . ")'><img src = 'images/edit.png' class = 'miniaction'/>Edit</a>&nbsp;|&nbsp;";
                                        echo "<a href='javascript:void(0)' onclick = 'model_deletepacking(" . $id . ", " . $result->id . ")'><img src = 'images/delete.png' class = 'miniaction'/>Delete</a>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11">No Data..</td>                                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>   
    </div>
</div>
<script>
    $(function () {
        $("#model-tabs").tabs();
        $("#model-tabs").tabs("select", model_last_tab);
    });
</script>