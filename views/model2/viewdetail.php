<div>    
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
    <br/>
    <table class="child" width="100%">
        <tr>
            <td align="center"><span class="labelelement">Image</span></td>
            <td align="center"><span class="labelelement">Finishing Overview</span></td>
            <td align="center"><span class="labelelement">Construction Overview</span></td>
        </tr>   
        <tr valign="top">
            <td align="center">
                <?php
                if ($model->filename == "") {
                    ?>
                    <img src="images/no-image.jpg" style="max-width: 60px;max-height: 60px;;width: 60px;height: 60px;"/>
                    <?php
                } else {
                    ?>                                        
                    <img src="files/<?php echo $model->filename ?>" class="miniaction" onclick="model_imageview('<?php echo $model->filename ?>')" style="max-width: 60px;max-height: 60px;;width: 60px;height: 60px;"/>
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
    </table>
</div>
<table width="100%" border="0">
    <tr valign="top">
        <td width="50%">
            <div style="margin-bottom: 6px">
                <img src="images/title.gif" class="miniaction"/> <b>HARDWARE</b>            
                <?php
                if ($this->session->userdata('department') == 4) {
                    if (in_array('add_material', $accessmenu)) {
                        echo "<button onclick = 'model_addhardware($id)' style = 'float: right;'>Add</button>";
                    }
                }
                ?>
            </div>
            <?php
            if (!empty($hardwaretype)) {
                foreach ($hardwaretype as $hardwaretype) {
                    $hardware = $this->model_model->selectItemHarwareByModelId($id, $hardwaretype->hardwaretypeid);
                    ?>
                    <table class="child" width="100%" align="center">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="30%"><?php echo $hardwaretype->name ?></th>
                                <th width="20%">Code</th>
                                <th width="10%">Qty</th>
                                <th width="5%">Unit</th>                            
                                <th width="25%">Location</th>
                                <th width="5%">Act</th>
                            </tr>
                        </thead>    
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($hardware as $hardware) {
                                ?>
                                <tr>
                                    <td align="right"><?php echo $no++ ?></td>
                                    <td><?php echo $hardware->description ?></td>
                                    <td><?php echo $hardware->partnumber ?></td>
                                    <td align="center"><?php echo $hardware->qty ?></td>
                                    <td align="center"><?php echo $hardware->unitcode ?></td>
                                    <td align="center"><?php echo $hardware->location ?></td>
                                    <td align="center">
                                        <?php
                                        if ($this->session->userdata('department') == 4) {
                                            if (in_array('delete_material', $accessmenu)) {
                                                echo "<img src = 'images/delete.png' class = 'miniaction' onclick = 'model_deletehardware(" . $id . ", " . $hardware->id . ")'/>";
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
            <div style="margin-top: 5px;margin-bottom: 6px">
                <img src="images/title.gif" class="miniaction"/> <b>GLASS / MIRROR</b>
                <?php
                if ($this->session->userdata('department') == 4) {
                    if (in_array('add_material', $accessmenu)) {
                        echo "<button onclick = 'model_setglass($id)' style = 'float: right'>Add</button>";
                    }
                }
                ?>
            </div>
            <table width="100%" class="child">
                <thead>
                    <tr>
                        <th rowspan="2" width="30%">Material</th>
                        <th colspan="3" width="20%">Dimension</th>
                        <th rowspan="2" width="5%">Qty</th>
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
                    if (!empty($glass)) {
                        foreach ($glass as $result) {
                            ?>
                            <tr>
                                <td><?php echo $result->descriptions ?></td>
                                <td align="center"><?php echo $result->thickness ?></td>
                                <td align="center"><?php echo $result->length ?></td>
                                <td align="center"><?php echo $result->width ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td><?php echo $result->location ?></td>
                                <td align="center">
                                    <?php
                                    if ($this->session->userdata('department') == 4) {
                                        if (in_array('delete_material', $accessmenu)) {
                                            echo "<img src='images/delete.png' class='miniaction' onclick='model_deleteglass(" . $id . "," . $result->id . ")'/>";
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
                            <td colspan="7">&nbsp;</td>                                        
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div style="margin-top: 5px;margin-bottom: 6px">
                <img src="images/title.gif" class="miniaction"/> <b>MARBLE</b>
                <?php
                if ($this->session->userdata('department') == 4) {
                    if (in_array('add_material', $accessmenu)) {
                        echo "<button onclick='model_setmarble($id)' style='float: right'>Add</button>";
                    }
                }
                ?>
            </div>
            <table width="100%" class="child">
                <thead>
                    <tr>
                        <th rowspan="2" width="30%">Type</th>
                        <th colspan="3" width="20%">Dimension</th>
                        <th rowspan="2" width="5%">Qty</th>
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
                        foreach ($marble as $result) {
                            ?>
                            <tr>
                                <td><?php echo $result->type ?></td>
                                <td align="center"><?php echo $result->thickness ?></td>
                                <td align="center"><?php echo $result->length ?></td>
                                <td align="center"><?php echo $result->width ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td><?php echo $result->location ?></td>
                                <td align="center">
                                    <?php
                                    if ($this->session->userdata('department') == 4) {
                                        if (in_array('delete_material', $accessmenu)) {
                                            echo "<img src = 'images/delete.png' class = 'miniaction' onclick = 'model_deletemarble(" . $id . ", " . $result->id . ")' />";
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
                            <td colspan="7">&nbsp;</td>                                        
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div style="margin-top: 5px;margin-bottom: 6px">
                <img src="images/title.gif" class="miniaction"/> <b>FRAME / INLAY</b>
                <?php
                if ($this->session->userdata('department') == 4) {
                    if (in_array('add_material', $accessmenu)) {
                        echo "<button onclick = 'model_setlatherinlay($id)' style = 'float: right'>Add</button>";
                    }
                }
                ?>
            </div>
            <table width="100%" class="child">
                <thead>
                    <tr>
                        <th rowspan="2" width="30%">Material</th>
                        <th colspan="3" width="20%">Dimension</th>
                        <th rowspan="2" width="5%">Qty</th>
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
                    if (!empty($latherinlay)) {
                        foreach ($latherinlay as $result) {
                            ?>
                            <tr>
                                <td><?php echo $result->descriptions ?></td>
                                <td align="center"><?php echo $result->thickness ?></td>
                                <td align="center"><?php echo $result->length ?></td>
                                <td align="center"><?php echo $result->width ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td><?php echo $result->location ?></td>
                                <td align="center">
                                    <?php
                                    if ($this->session->userdata('department') == 4) {
                                        if (in_array('delete_material', $accessmenu)) {
                                            echo "<img src = 'images/delete.png' class = 'miniaction' onclick = 'model_deletelatherinlay(" . $id . ", " . $result->id . ")'/>";
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
                            <td colspan="7">&nbsp;</td>                                        
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>            
            <div style="margin-top: 5px;margin-bottom: 6px">
                <img src="images/title.gif" class="miniaction"/> <b>PACKING MATERIAL</b>
                <?php
                if ($this->session->userdata('department') == 4) {
                    if (in_array('add_material', $accessmenu)) {
                        echo "<button style = 'float: right' onclick = 'model_setpacking($id)'>Add</button>";
                    }
                }
                ?>
            </div>
            <table width="100%" class="child">
                <thead>
                    <tr>
                        <th rowspan="2" width="30%">Material</th>
                        <th colspan="3" width="20%">Dimension</th>
                        <th rowspan="2" width="5%">Qty</th>
                        <th rowspan="2" width="20%">Location</th>
                        <th rowspan="2" width="5%">Act</th>
                    </tr>
                    <tr>
                        <th>Width</th>
                        <th>Dept</th>
                        <th>Height</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($packing)) {
                        foreach ($packing as $result) {
                            ?>
                            <tr>
                                <td><?php echo $result->descriptions ?></td>
                                <td align="center"><?php echo $result->width ?></td>
                                <td align="center"><?php echo $result->depth ?></td>
                                <td align="center"><?php echo $result->height ?></td>
                                <td align="center"><?php echo $result->qty ?></td>
                                <td><?php echo $result->location ?></td>
                                <td align="center">
                                    <?php
                                    if ($this->session->userdata('department') == 4) {
                                        if (in_array('delete_material', $accessmenu)) {
                                            echo "<img src = 'images/delete.png' class = 'miniaction' onclick = 'model_deletepacking(" . $id . ", " . $result->id . ")'/>";
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
                            <td colspan="7">&nbsp;</td>                                        
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>            
        </td>
    </tr>
</table>