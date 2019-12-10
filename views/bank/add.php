<br/>
<br/>
<br/>
<br/>
<br/>
<center>
    <button onclick="bank_add()" title="Add Or Create Model">+</button>
    <div style="width: 500px;" class="panel">
        <h4>Add Bank</h4>
        <br/>
        <table align="center" border="0" align="center">            
            <tr>
                <td align="right"><span class="labelelement">CODE</span></td>
                <td><span class="labelelement">:</span><input type="text" id="code" name="code" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">NAME</span></td>
                <td><span class="labelelement">:</span><input type="text" id="name" name="name" size="40"/></td>
            </tr>            
            <tr>
                <td align="right"><span class="labelelement">BRANCH</span></td>
                <td><span class="labelelement">:</span><input type="text" id="branch" name="branch" size="30"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">CITY</span></td>
                <td><span class="labelelement">:</span><input type="text" id="city" name="city" size="25"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">COUNTRY</span></td>
                <td><span class="labelelement">:</span><input type="text" id="country" name="country" /></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">KLIRING</span></td>
                <td><span class="labelelement">:</span><input type="text" id="kliring" name="kliring" size="10"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">RTGS</span></td>
                <td><span class="labelelement">:</span><input type="text" id="rtgs" name="rtgs"  size="10"/></td>
            </tr>
            <tr>
                <td align="right"><span class="labelelement">SWIFT</span></td>
                <td><span class="labelelement">:</span><input type="text" id="swift" name="swift"  size="10"/></td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td colspan="2" align="center"><button onclick="bank_save()">Save</button><button onclick="bank_view()">Cancel</button></td></tr>
        </table>
    </div>
</center>