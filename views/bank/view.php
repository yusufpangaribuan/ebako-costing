<div style="height:600px;" id="">    
    <h4>BANK</h4>
    <center>
        <div style="width: 99%;">
            <div align="left" style="padding-top: 5px;padding-bottom: 5px;">
                <span class="labelelement">Code</span><input type="text" id="code" name="code" size="10"/>
                <span class="labelelement">Name</span><input type="text" id="name" name="name" size="10" />    
                <span class="labelelement">Branch</span><input type="text" id="branch" name="branch" size="10" />
                <span class="labelelement">City</span><input type="text" id="city" name="city" size="10" />
                <span class="labelelement">Country</span><input type="text" id="country" name="country" size="10" />
                <span class="labelelement">Kliring</span><input type="text" id="kliring" name="kliring" size="10" />
                <span class="labelelement">Rtgs</span><input type="text" id="rtgs" name="rtgs" size="10" />
                <span class="labelelement">Swift</span><input type="text" id="swift" name="swift" size="10" />
                <button>Search</button>
                <?php
                if (in_array('add', $accessmenu)) {
                    echo "<button onclick = 'bank_add()'>Add</button>";
                }
                ?>
            </div>
            <table class="tablesorter2" width="100%">
                <thead>
                    <tr>
                        <th width="10">No</th>
                        <th>Code</th>
                        <th>Name</th>            
                        <th>Branch</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>KLIRING</th>
                        <th>RTGS</th>
                        <th>SWIFT</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($bank)) {
                        $number = 1;
                        foreach ($bank as $result) {
                            ?>
                            <tr>
                                <td>&nbsp;<?php echo $number++ ?></td>
                                <td>&nbsp;<?php echo $result->code ?></td>
                                <td>&nbsp;<?php echo $result->name ?></td>
                                <td>&nbsp;<?php echo $result->branch ?></td>
                                <td>&nbsp;<?php echo $result->city ?></td>
                                <td>&nbsp;<?php echo $result->country ?></td>
                                <td>&nbsp;<?php echo $result->kliring ?></td>
                                <td>&nbsp;<?php echo $result->rtgs ?></td>
                                <td>&nbsp;<?php echo $result->swift ?></td>
                                <td>
                                    <?php
                                    if (in_array('edit', $accessmenu)) {
                                        echo "<a href='javascript:bank_edit($result->id)'><img class='miniaction' src='images/edit.png'>&nbsp;Edit&nbsp;</a>";
                                    }if (in_array('delete', $accessmenu)) {
                                        echo "<a href='javascript:bank_delete($result->id)'><img class='miniaction' src='images/delete.png'>&nbsp;Delete&nbsp;</a>";
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
        </div>
    </center>
</div>



