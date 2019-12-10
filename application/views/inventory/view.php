<div style="height:600px;" id="">    
    <h4>inventory</h4>
    <center>
        <div style="width: 99%;">
            <div align="left" style="margin-top: 5px;margin-bottom: 5px;">
                <span class="labelelement" >TYPE</span>
                <select id="type" onchange="inventory_change()">
                    <option value="2">Component</option>
                    <option value="1">Material</option>
                </select>
                <span class="labelelement">CODE</span><input type="text" id="codes" name="codes" />
                <span class="labelelement">NAME</span><input type="text" id="names" name="names" />    
                <span class="labelelement">DESCRIPTION</span><input type="text" id="description" name="description" />
                <button>Search</button>
                <button style="display: none;" id="btnaddmaterial">Add Row material</button>
            </div>
            <div id="inventorydata">
                <table class="tablesorter2" width="100%">
                    <thead>
                        <tr>
                            <th width="2%">NO</th>
                            <th width="10%">TYPE</th>
                            <th width="18%">CODE</th>       
                            <th width="40%">DESCRIPTION</th>
                            <th width="10%">UNIT</th>
                            <th width="10%">STOCK</th>                        
                            <th width="10%">COST</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        <?php
                        $no = 1;
                        foreach ($component as $component) {
                            ?>
                            <tr>
                                <td align="right"><?php echo $no++ ?></td>
                                <td>COMPONENT</td>
                                <td><?php echo $component->partnumber ?></td>
                                <td><?php echo $component->description ?></td>
                                <td><?php echo $component->unitcode ?></td>
                                <td><?php echo $component->stock ?></td>
                                <td align="right"><?php echo number_format($component->price,2,'.',',') ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>               
            </div>
        </div>
    </center>
</div>



