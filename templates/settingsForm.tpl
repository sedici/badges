{**
 * plugins/generic/badges/settingsForm.tpl
 *
 * Copyright (c) 2019 PREBI-SEDICI Universidad Nacional de La Plata
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Badges plugin settings
 *
 *}
<div id="badgesSettings">
<div id="description">{translate key="plugins.generic.badges.manager.settings.description"}</div>

<h3>{translate key="plugins.generic.badges.settings"}</h3>

<script>
	$(function() {ldelim}
		// Attach the form handler.
		$('#badgesSettingsForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="badgesSettingsForm" method="post" action="{url router=$smarty.const.ROUTE_COMPONENT op="manage" category="generic" plugin=$pluginName verb="settings" save=true}">
	{csrf}
	{include file="controllers/notification/inPlaceNotification.tpl" notificationId="badgesSettingsFormNotification"}

	{fbvFormArea id="badgesSettingsFormArea"}

		{fbvFormSection list="true"}
			{fbvElement type="checkbox" id="badgesShowDimensions" label="plugins.generic.badges.manager.settings.showDimensions" checked=$badgesShowDimensions|compare:true}
		{/fbvFormSection}
		{fbvFormSection list="true"}
			{fbvElement type="checkbox" id="badgesShowAltmetrics" label="plugins.generic.badges.manager.settings.showAltmetrics" checked=$badgesShowAltmetrics|compare:true}
		{/fbvFormSection}
		{fbvFormSection list="true"}
			{fbvElement type="checkbox" id="badgesShowPlumx" label="plugins.generic.badges.manager.settings.showPlumx" checked=$badgesShowPlumx|compare:true}
		{/fbvFormSection}

	{/fbvFormArea}

	{fbvFormButtons}
</form>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>
</div>
