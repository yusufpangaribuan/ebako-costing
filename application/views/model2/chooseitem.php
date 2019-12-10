<div style="margin-bottom: 3px">
<span class="labelelement">Code :</span>
<input type="text" id="code_s" name="code_s" size="10" onkeyup="component_searchfordialog2(event)"/>
<span class="labelelement">Description :</span>
<input type="text" id="description_s" name="description_s" size="20" onkeyup="component_searchfordialog2(event)"/>
<button onclick="component_searchfordialog()">Search</button>
</div>
<table width="100%" class="tablesorter">
    <thead>
        <tr>            
            <th rowspan="2" width="10%">Code</th>
            <th rowspan="2" width="20%">Description</th>            
            <th rowspan="2" width="5%">Wood</th>
            <th colspan="4" width="15%">Veneer</th>
            <th colspan="3" width="15%">Final size</th>
            <th colspan="3" width="15%">Rough size</th>
            <th colspan="4" width="15%">Process</th>
            <th rowspan="2" width="5%">Act</th>
        </tr>
        <tr>
            <th>TYPE</th>
            <th>S1S</th>
            <th>DGB</th>
            <th>S2S</th>
            <th>T</th>
            <th>W</th>
            <th>L</th>
            <th>T</th>
            <th>W</th>
            <th>L</th>
            <th>Turn</th>
            <th>Lam</th>
            <th>Carv</th>
            <th>Mall</th>
            
        </tr>
    </thead>
    <tbody id="componentdatasearchfordialog">
        <?php
        foreach ($component as $component) {
            ?>
            <tr>                
                <td>
                    <?php echo $component->partnumber ?>
                    <input type="hidden" name="idcomponent<?php echo $component->id ?>" id="idcomponent<?php echo $component->id ?>" value="<?php echo $component->id ?>"/>
                </td>
                <td>
                    <?php echo $component->description ?>
                    <input type="hidden" value="<?php echo strip_tags($component->description) ?>" id="descriptioncomponent<?php echo $component->id ?>" />
                </td>
                <td><?php echo $component->woodname; ?></td>
                <td align="center"><?php echo $component->ven_type; ?></td>
                <td align="center"><?php echo $component->ven_s1s; ?></td>
                <td align="center"><?php echo $component->ven_dgb; ?></td>
                <td align="center"><?php echo $component->ven_s2s; ?></td>
                <td align="center"><?php echo $component->ft; ?></td>
                <td align="center"><?php echo $component->fw; ?></td>
                <td align="center"><?php echo $component->fl; ?></td>
                <td align="center"><?php echo $component->rt; ?></td>
                <td align="center"><?php echo $component->rw; ?></td>
                <td align="center"><?php echo $component->rl; ?></td>
                <td align="center"><?php echo $component->turn; ?></td>
                <td align="center"><?php echo $component->lam; ?></td>
                <td align="center"><?php echo $component->carv; ?></td>
                <td align="center"><?php echo $component->mall; ?></td>
                <td align="center"><img src="images/check.png" class="miniaction" onclick="model_bomsetitem('component',<?php echo $component->id ?>)" /></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>