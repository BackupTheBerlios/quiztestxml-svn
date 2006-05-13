
<form action="index.php" method="post">
<fieldset>
<legend><label><#L_USERSETTINGS#></label></legend>
<table style="width:100%; padding:0px; border-collapse:separate; border-width:0px; text-align:left;">
    <tr>
        <td style="text-align:left; padding:0px 10px 0px 0px; width:100%;">
            <div class="usertitle"><#L_NAME#></div>
            <div class="corner"><input type="text" name="name" class="gfield" value="<#S_NAME#>" /></div>
        </td>
        <td style="text-align:left; padding:0px 10px 0px 10px; white-space:nowrap;">
            <div class="usertitle"><#L_CODELANG#></div>
            <div class="corner"><select name="code_lang" class="gfield gselect"><#S_LANG_OPTION#></select></div>
        </td>
        <td style="text-align:left; padding:0px 0px 0px 10px; white-space:nowrap;">
            <div class="usertitle"><#L_TAB_WIDTH#></div>
            <div class="corner"><select name="tab_length" class="gfield gselect"><#S_TAB_OPTION#></select></div>
        </td>
    </tr>
</table>
</fieldset><p />
	
<fieldset>
<legend><label><#L_DESCRIPTION#></label></legend>
<div class="fieldsetcontent"><textarea name="description" class="gfield" style="height:60px; width:98%;" rows="10" cols="50"><#S_DESCRIPTION#></textarea></div>
</fieldset><p />

<fieldset>
<legend><label><#L_CODE#></label></legend>
<div class="fieldsetcontent"><textarea name="code" class="gfield" style="height:300px; width:98%;" rows="10" cols="50"><#S_CODE#></textarea></div>
</fieldset><p />

<fieldset>              
<legend><label><#L_SENDING#></label></legend>
<div class="fieldsetcontent"><input type="submit" name="submit" value="<#L_POSTBUTTON#>" class="gbutton" /></div>
</fieldset>
</form>
