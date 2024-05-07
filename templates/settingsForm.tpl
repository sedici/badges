{**
 * plugins/generic/badges/settingsForm.tpl
 *
 * Copyright 2019
 * Portal de Revistas de la Universidad Nacional de La Plata
 *  https://revistas.unlp.edu.ar
 *  https://sedici.unlp.edu.ar
 *
 * @author gonetil *
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
			{fbvElement type="checkbox" id="badgesDimensionsHideWhenEmpty" label="plugins.generic.badges.manager.settings.dimensionsHideWhenEmpty" checked=$badgesDimensionsHideWhenEmpty|compare:true}
		{/fbvFormSection}

		{fbvFormSection list="true"}
			{fbvElement type="checkbox" id="badgesShowAltmetric" label="plugins.generic.badges.manager.settings.showAltmetric" checked=$badgesShowAltmetric|compare:true}
			{fbvElement type="checkbox" id="badgesAltmetricHideWhenEmpty" label="plugins.generic.badges.manager.settings.altmetricHideWhenEmpty" checked=$badgesAltmetricHideWhenEmpty|compare:true}
		{/fbvFormSection}

		{fbvFormSection list="true"}
			{fbvElement type="checkbox" id="badgesShowPlumx" label="plugins.generic.badges.manager.settings.showPlumx" checked=$badgesShowPlumx|compare:true}
			{fbvElement type="checkbox" id="badgesPlumxHideWhenEmpty" label="plugins.generic.badges.manager.settings.plumxHideWhenEmpty" checked=$badgesPlumxHideWhenEmpty|compare:true}
		{/fbvFormSection}

        <h3>{translate key="plugins.generic.badges.manager.settings.dimensionsBadgeStyle"}</h3>

        {fbvFormSection list=true}
            {fbvElement type="radio" value="small_circle" id="badgesDimensionsStyle-small_circle" name="badgesDimensionsStyle" checked=$badgesDimensionsStyle|compare:"small_circle" label="plugins.generic.badges.manager.settings.dimensionsBadgeSmallCircleStyle"}
            {fbvElement type="radio" value="medium_circle" id="badgesDimensionsStyle-medium_circle" name="badgesDimensionsStyle" checked=in_array($badgesDimensionsStyle, ["medium_circle", ""]) label="plugins.generic.badges.manager.settings.dimensionsBadgeMediumCircleStyle"}
            {fbvElement type="radio" value="large_circle" id="badgesDimensionsStyle-large_circle" name="badgesDimensionsStyle" checked=$badgesDimensionsStyle|compare:"large_circle" label="plugins.generic.badges.manager.settings.dimensionsBadgeLargeCircleStyle"}
            {fbvElement type="radio" value="small_rectangle" id="badgesDimensionsStyle-small_rectangle" name="badgesDimensionsStyle" checked=$badgesDimensionsStyle|compare:"small_rectangle" label="plugins.generic.badges.manager.settings.dimensionsBadgeSmallRectangleStyle"}
            {fbvElement type="radio" value="large_rectangle" id="badgesDimensionsStyle-large_rectangle" name="badgesDimensionsStyle" checked=$badgesDimensionsStyle|compare:"large_rectangle" label="plugins.generic.badges.manager.settings.dimensionsBadgeLargeRectangleStyle"}
        {/fbvFormSection}

        <h3>{translate key="plugins.generic.badges.manager.settings.altmetricBadgeStyle"}</h3>
        <p>{translate key="plugins.generic.badges.manager.settings.altmetricBadgeStyleDetails"}</p>

        {fbvFormSection list=true}
            {fbvElement type="radio" value="default" id="badgesAltmetricStyle-default" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"default" label="plugins.generic.badges.manager.settings.altmetricBadgeDefaultStyle"}
            {fbvElement type="radio" value="donut" id="badgesAltmetricStyle-donut" name="badgesAltmetricStyle" checked=in_array($badgesAltmetricStyle, ["donut", ""]) label="plugins.generic.badges.manager.settings.altmetricBadgeDonutStyle"}
            {fbvElement type="radio" value="medium-donut" id="badgesAltmetricStyle-medium-donut" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"medium-donut" label="plugins.generic.badges.manager.settings.altmetricBadgeMediumDonutStyle"}
            {fbvElement type="radio" value="large-donut" id="badgesAltmetricStyle-large-donut" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"large-donut" label="plugins.generic.badges.manager.settings.altmetricBadgeLargeDonutStyle"}
            {fbvElement type="radio" value="1" id="badgesAltmetricStyle-1" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"1" label="plugins.generic.badges.manager.settings.altmetricBadge1Style"}
            {fbvElement type="radio" value="4" id="badgesAltmetricStyle-4" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"4" label="plugins.generic.badges.manager.settings.altmetricBadge4Style"}
            {fbvElement type="radio" value="bar" id="badgesAltmetricStyle-bar" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"bar" label="plugins.generic.badges.manager.settings.altmetricBadgeBarStyle"}
            {fbvElement type="radio" value="medium-bar" id="badgesAltmetricStyle-medium-bar" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"medium-bar" label="plugins.generic.badges.manager.settings.altmetricBadgeMediumBarStyle"}
            {fbvElement type="radio" value="large-bar" id="badgesAltmetricStyle-large-bar" name="badgesAltmetricStyle" checked=$badgesAltmetricStyle|compare:"large-bar" label="plugins.generic.badges.manager.settings.altmetricBadgeLargeBarStyle"}
        {/fbvFormSection}

	{/fbvFormArea}

	{fbvFormButtons}
</form>

<p><span class="formRequired">{translate key="common.requiredField"}</span></p>
</div>
