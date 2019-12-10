<div class="col-sm-12">
    <div align="left" style="padding-top: 2px;padding-bottom: 5px;">
        <input type="hidden" id="temp" value="<?php echo $temp ?>" />
        <input type="hidden" id="id" value="<?php echo $id ?>" />
        <span class="labelelement">Code</span>
        <input type="text" name="code_s" id="code_sd" size="10" onkeypress="if(event.keyCode==13){model_search2(0)}"/>    
        <span class="labelelement">Customer Code</span>
        <input type="text" name="custcode_s" id="custcode_s" size="10" onkeypress="if(event.keyCode==13){model_search2(0)}"/>    
        <span class="labelelement">Description</span>
        <input type="text" name="description_s" id="description_sd" size="20" onkeypress="if(event.keyCode==13){model_search2(0)}"/>
        <select id="modeltypeid_sd" onchange="model_search2(0)">
            <option value="0">Type</option>
            <?php
            foreach ($modeltype as $modeltype) {
                echo "<option value='" . $modeltype->id . "'>" . $modeltype->name . "</option>";
            }
            ?>
        </select>
        <input type="hidden" id="billto_s" value="<?php echo $billto ?>" />
        <button onclick="model_search2(0)">Search</button>
	    </div>
    
		<table class="table table-responsive-sm table-bordered table-striped table-hover table-outline mb-0">
		    <thead class="thead-light" style="background: #f9f9f9 !important;">
	        <tr style="border-top: 4px solid #ec9821;">
		            <th width="2%" rowspan="2">No</th>
                    <th rowspan="2" width="15%">Code</th>
                    <th rowspan="2" width="15%">Customer Code</th>
                    <th rowspan="2"width="30%">Description</th>
                    <th colspan="5">Dimension</th>                        
                    <th rowspan="2" width="5%">Color</th>
                    <th>Volume</th>
                    <th rowspan="2" width="30%">Images</th>
                    <th rowspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th width="5%">w</th>
                    <th width="5%">d</th>
                    <th width="5%">ht</th>
                    <th width="5%">sh</th>
                    <th width="5%">ah</th>                                    
                    <th width="5%">Package</th>
                </tr>
			</thead>
			<tbody>
                <?php
                $counter = 1;
                foreach ($model as $result) {
                    ?>
                    <tr>
                        <td align="right" width="1%" onclick="model_viewdetail(<?php echo $result->id ?>)" ><?php echo $counter++ ?></td>
                        <td>
                            <?php echo $result->no ?>                                        
                            <input type="hidden" id="code<?php echo $result->id ?>" value="<?php echo $result->no ?>"/>
                            <input type="hidden" id="description<?php echo $result->id ?>" value="<?php echo $result->description ?>"/>
                            <input type="hidden" id="finishoverview<?php echo $result->id ?>" value="<?php echo $result->finishoverviewname ?>"/>
                            <input type="hidden" id="constructionoverview<?php echo $result->id ?>" value="<?php echo $result->constructionoverviewname ?>"/>
                        </td>
                        <td><?php echo $result->custcode ?></td>                            
                        <td><?php echo $result->description ?></td>                            
                        <td align="center"><?php echo $result->dw ?></td>
                        <td align="center"><?php echo $result->dd ?></td>
                        <td align="center"><?php echo $result->dht ?></td>
                        <td align="center"><?php echo $result->dsh ?></td>
                        <td align="center"><?php echo $result->dah ?></td>
                        <td align="center"><?php echo $result->color ?></td>                
                        <td align="center"><?php echo $result->volumepackage ?></td>
                        <td align="center">
                            <?php
                            $images = "./files/" . $result->filename;
                            if (!file_exists($images)) {
                                $images = "./images/no-image.jpg";
                            }
                            ?>
                            <img src="<?php echo $images ?>" style="max-width: 100px;max-height: 100px;">
                        </td>
                        <td>
                            <?php
                            if ($billto == 0) {
                                ?>
                                <img src="images/check.png" onclick="costing_model_set(<?php echo $result->id . ",'" . $temp . "'," . $id ?>)" class="miniaction"/>                                
                                <?php
                            } else {
                                ?>
                                <img src="images/check.png" onclick="costing_model_set2(<?php echo $result->id . ",'" . $temp . "'," . $id ?>)" class="miniaction"/>
                                <?php
                            }
                            ?>                            
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
