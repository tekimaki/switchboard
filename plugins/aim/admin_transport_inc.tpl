	{form}
	{legend legend="Aim Transport Settings"}
		<input type="hidden" name="page" value="{$page}" />
		{foreach from=$formTransportAim key=item item=output}
		<div class="row">
			{formlabel label=`$output.label` for=$item}
			{forminput}
				<input type="text" name="{$item|escape}" value="{$gBitSystem->getConfig($item,$output.default)|escape}"/>
				{formhelp note=`$output.note` page=`$output.page`}
			{/forminput}
		</div>
		{/foreach}
		<div class="buttonHolder row submit">
			<input class="button" type="submit" name="aim_apply" value="{tr}Change preferences{/tr}" />
		</div>
	{/legend}
	{/form}
