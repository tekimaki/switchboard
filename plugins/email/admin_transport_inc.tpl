	{form}
	{legend legend="Switchboard Mail Server Settings"}
		<input type="hidden" name="page" value="{$page}" />
		{foreach from=$formSwitchboardFeatures key=item item=output}
		<div class="row">
			{formlabel label=`$output.label` for=$item}
			{forminput}
				<input class="textInput" type="text" name="{$item|escape}" value="{$gBitSystem->getConfig($item,$output.default)|escape}"/>
				{formhelp note=`$output.note` page=`$output.page`}
			{/forminput}
		</div>
		{/foreach}

		{foreach from=$formSwitchboardChecks key=item item=output}
			<div class="row">
				{formlabel label=`$output.label` for=$item}
				{forminput}
					{html_checkboxes name="$item" values="y" checked=$gBitSystem->getConfig($item) labels=false id=$item}
					{formhelp note=`$output.note` page=`$output.page`}
				{/forminput}
			</div>
		{/foreach}
		<div class="buttonHolder row submit">
			<input class="button" type="submit" name="email_apply" value="{tr}Change preferences{/tr}" />
		</div>
	{/legend}
	{/form}
	{form}
	{legend legend="Switchboard Mail Server Transport Test"}
		<input type="hidden" name="page" value="{$page}" />
		<div class="row">
			{formlabel label="Recipient Email Address(es)" for="email_test_address"}
			{forminput}
				<input class="textInput" type="text" name="email_test_address" value=""/>
				{formhelp note="Email address(es) to send a test email to. Separate mutiple email addresses with a comma ','."}
                :qa
			{/forminput}
		</div>
		<div class="buttonHolder row submit">
			<input class="button" type="submit" name="email_test_send" value="{tr}Send Email{/tr}" />
		</div>
	{/legend}
	{/form}
