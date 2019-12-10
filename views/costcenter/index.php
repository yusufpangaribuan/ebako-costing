<h4>Cost Center</h4>    
<div style="width: 100%;margin-left: 3px;">
    <div align="left" style="margin-bottom: 5px;margin-top: 5px;">
        <form id="costcenter_search_form" onsubmit="return false;">
            <span class="labelelement">Search</span>
            <input type="text" name="q" placeholder="Code / Description" style="width: 120px"
                   onkeypress="if (event.keyCode === 13)
                               (costcenter_search(0))"/>
            <button type="button" onclick="costcenter_search(0)">Find</button>
            <?php
            if (in_array('add', $accessmenu)) {
                echo "<button type='button' onclick = 'costcenter_add()'>Add</button>";
            }
            ?>
        </form>
    </div>
    <div id="costcenterdata" style="width: 80%">
        <?php $costcenter->search(0) ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url("js/costcenter.js") ?>"></script>

