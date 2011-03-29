{strip}
{jstabs}
	{jstab title="Global Settings"}
	{form}
	{legend legend="Global Settings"}
		<input type="hidden" name="page" value="{$page}" />
		<div class="row">
			{formlabel label="Default Transport"}
			{forminput}	
				<select name="switchboard_default_transport">
					<option value=""></option>
					{foreach from=$gSwitchboardSystem->getTransports() key=style item=options}
					<option value="{$style}" {if $gSwitchboardSystem->getDefaultTransport() == $style}selected="selected"{/if}/>{$style|capitalize:true}</option>
					{/foreach}
				</select>
			{/forminput}
		</div>
		<div class="buttonHolder row submit">
			<input class="button" type="submit" name="switchboard_apply" value="{tr}Change preferences{/tr}" />
		</div>
	{/legend}
	{/form}
	{/jstab}
{foreach from=$transportConfigs key=transport item=transportConfigTpl}
	{jstab title=$transport|ucwords}
		{include file=$transportConfigTpl}
	{/jstab}
{/foreach}
{/jstabs}
{/strip}
