<p>
	<select name="profile_user_field_type[]" onchange="ls.userfield.changeFormField(this);">
	{foreach from=$aUserFieldsContact item=oFieldAll}
		<option value="{$oFieldAll->getId()}" {if $oFieldAll->getId()==$oField->getId()}selected="selected"{/if}>{$oFieldAll->getTitle()|escape:'html'}</option>
	{/foreach}
	</select>
</p>