<div style="width: 800px">
   <div style="margin: 2px 0 2px 0;">
      <span class="labelelement">Code : </span>
      <input type="text" id="partnumber_s" style="width: 80px;" onkeypress="if(event.keyCode==13){item_searchOrderRecommendation('<?php echo $elid ?>')}"/>
      <span class="labelelement">Description :</span>
      <input type="text" id="description_s" style="width: 80px;" onkeypress="if(event.keyCode==13){item_searchOrderRecommendation('<?php echo $elid ?>')}" />
      <span class="labelelement">Class :</span>
      <select id="isstock_s" style="width: 80px;" onchange="item_searchOrderRecommendation('<?php echo $elid ?>')">
         <option value="0">--All--</option>
         <option value="true">Stock</option>
         <option value="false">Non Stock</option>
      </select>
      <span class="labelelement">Group :</span>
      <select id="groupid_s" style="width: 120px;" onchange="item_searchOrderRecommendation('<?php echo $elid ?>')">
         <option value="0">--All--</option>
         <?php
         foreach ($group as $result) {
            echo "<option value='" . $result->id . "'>[" . $result->codes . "] " . $result->names . "</option>";
         }
         ?>
      </select>        
      <button onclick="item_searchOrderRecommendation('<?php echo $elid ?>')">Search</button>
   </div>
   <table class="tablesorter" width="99%">
      <thead>
         <tr>
            <th width="20%">Code#</th> 
            <th width="30%">Item Description</th>
            <th width="10%">Class</th>                
            <th width="10%">Group</th>
            <th width="5%">MOQ</th>
            <th width="8%">R-O Point</th>
            <th width="13%">Image</th>
            <th width="4%">Action</th>
         </tr>            
      </thead>
      <tbody id="listsearch">
         <?php
         if (!empty($item)) {
            $no = 1;
            foreach ($item as $result) {
               $allunit = $this->model_item->getAllUnit($result->id);
               ?>
               <tr>                        
                  <td>
                     <input type="hidden" id="unitid_r<?php echo $result->id ?>" value="<?php echo $allunit ?>" />
                     <input type="hidden" id="id_r<?php echo $result->id ?>" value="<?php echo $result->id ?>"/>
                     <input type="hidden" id="partnumber_r<?php echo $result->id ?>" value="<?php echo $result->partnumber ?>"/>
                     <input type="hidden" id="names_r<?php echo $result->id ?>" value="<?php echo $result->names ?>"/>
                     <input type="hidden" id="moq_r<?php echo $result->id ?>" value="<?php echo $result->moq ?>"/>
                     <input type="hidden" id="descriptions_r<?php echo $result->id ?>" value="<?php echo strip_tags($result->descriptions) ?>"/>
                     <?php echo $result->partnumber ?>
                  </td>
                  <td><?php echo nl2br($result->descriptions) ?></td>
                  <td><?php echo ($result->isstock == 't') ? 'Stock' : 'Non Stock'; ?></td>
                  <td><?php echo $result->groupname ?></td>
                  <td align="center"><?php echo $result->moq ?></td>
                  <td align="center"><?php echo $result->reorderpoint ?></td>
                  <td align="center">
                     <?php
                     if ($result->images != "") {
                        echo "<a href=javascript:void(0) onclick=item_viewimage('" . $result->images . "')> <img src = 'images/attachment.png' class = 'miniaction'/> Image</a>";
                     }
                     ?>
                  </td>
                  <td align="center"><img src="images/check.png" class="miniaction" onclick="item_selectToPr(<?php echo $result->id . "," . $elid ?>)" /></td>
               </tr>
               <?php
            }
         }
         ?>
      </tbody>
   </table>
</div>
