<div class="wrapper-content wrapper-content-dark">
	<dl class="form-item">
		<dt><label for="contact_private_setting">{$aLang.plugin.contactprivate.contact_private_setting}:</label></dt>
		<dd>
			<select name="contact_private_setting" id="contact_private_setting" class="input-width-250">
				<option value="all" {if $sUserContactPrivateSetting=='all'}selected{/if}>{$aLang.plugin.contactprivate.private_setting_value['all']}</option>
				<option value="registered" {if $sUserContactPrivateSetting=='registered'}selected{/if}>{$aLang.plugin.contactprivate.private_setting_value['registered']}</option>
				<option value="friends" {if $sUserContactPrivateSetting=='friends'}selected{/if}>{$aLang.plugin.contactprivate.private_setting_value['friends']}</option>
			</select>
		</dd>
	</dl>
</div>