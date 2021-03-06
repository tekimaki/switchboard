{strip}
	<div class="switchboard">
		{foreach from=$gSwitchboardSystem->getSenders() key=package item=types}
			{legend legend=$package}
			{foreach from=$types.types key=type item=data name=type}
			<div class="row">
				{formlabel label=$type|capitalize:true}
				{forminput}	
				<select name="{$prefs_table_value_prefix}[{$package}][{$type}]">
					{foreach from=$gSwitchboardSystem->getTransports() key=style item=options}
					<option value="{$style}" 
					{if (empty($prefs_data.$package.$type.delivery_style)
							&& (( $data.include_owner && $gSwitchboardSystem->getDefaultTransport() == $style )
							|| ( !$data.include_owner && $style == 'none' ))) 
						|| $prefs_data.$package.$type.delivery_style == $style}
							selected="selected"
						{/if}
						/>{$style|capitalize:true}
					{/foreach}
					</select>
				{/forminput}
			</div>
			{/foreach}
			{/legend}
		{/foreach}
	</div>
{/strip}
