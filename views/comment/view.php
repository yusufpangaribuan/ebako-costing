<table width="100%">
    <tr valign="top">
        <td width="20%"><span class="labelelement">Comment</span></td>
        <td width="80%" >
            <input type="hidden" id="referenceid" value="<?php echo $referenceid ?>" />
            <input type="hidden" id="reference" value="<?php echo $reference ?>" />
            <textarea id="comment"style="width: 100%; height: 70px;"></textarea>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><button onclick="comment_post()" style="font-size: 11px;">Post</button></td>
    </tr>
</table>
<h5>Comment List</h5>
<hr/>
<div id="commentlist">
</div>

