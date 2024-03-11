<?php

/**
 * @file plugins/generic/badges/BadgesPlugin.inc.php
 * 
 * Copyright 2019 
 * Portal de Revistas de la Universidad Nacional de La Plata
 *  https://revistas.unlp.edu.ar 
 *  https://sedici.unlp.edu.ar
 *
 * @author gonetil
 *
 * @class badges
 * @ingroup plugins_generic_dates
 *
 * @brief badges plugin class
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class BadgesPlugin extends GenericPlugin {
	/**
	 * Called as a plugin is registered to the registry
	 * @param $category String Name of category plugin was registered to
	 * @return boolean True iff plugin initialized successfully; if false,
	 * 	the plugin will not be registered.
	 */
	function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
		if ($success && $this->getEnabled()) {
			// Insert Badges div
			HookRegistry::register('Templates::Article::Details', array($this, 'addBadges'));
			HookRegistry::register('Templates::Preprint::Details', array($this, 'addBadges'));
		}
		return $success;
	}

	/**
	 * Get the plugin display name.
	 * @return string
	 */
	function getDisplayName() {
		return __('plugins.generic.badges.displayName');
	}

	/**
	 * Get the plugin description.
	 * @return string
	 */
	function getDescription() {
		return __('plugins.generic.badges.description');
	}

	private function getPubId($smarty) {
		$application = Application::getName();
		switch($application){
			case 'ojs2':
				$submission = $smarty->getTemplateVars('article');
				break;
			case 'ops':
				$submission = $smarty->getTemplateVars('preprint');
				break;
		}

		return $submission->getStoredPubId('doi');
	}

	/**
	 * Add badges to article/preprint landing page
	 * @param $hookName string
	 * @param $params array
	 */
	function addBadges($hookName, $params) {
		$request = $this->getRequest();
		$context = $request->getContext();

		$smarty =& $params[1];
		$output =& $params[2];

		$doi = $this->getPubId($smarty);
		$smarty->assign('doi', $doi);

		$badgesShowDimensions = $this->getSetting($context->getId(), 'badgesShowDimensions');
		$badgesDimensionsHideWhenEmpty = $this->getSetting($context->getId(), 'badgesDimensionsHideWhenEmpty');
		$badgesShowAltmetric = $this->getSetting($context->getId(), 'badgesShowAltmetric');
		$badgesAltmetricHideWhenEmpty = $this->getSetting($context->getId(), 'badgesAltmetricHideWhenEmpty');
		$badgesShowPlumx = $this->getSetting($context->getId(), 'badgesShowPlumx');
		$badgesPlumxHideWhenEmpty = $this->getSetting($context->getId(), 'badgesPlumxHideWhenEmpty');

		if ($badgesShowDimensions == "on") {
			$smarty->assign("showDimensions", "true");
			$smarty->assign("badgesDimensionsHideWhenEmpty",  ( ($badgesDimensionsHideWhenEmpty == "on")? "true" : "false") );
		}
		if ($badgesShowAltmetric == "on") {
			$smarty->assign("showAltmetric","true");
			$smarty->assign("badgesAltmetricHideWhenEmpty",  ( ($badgesAltmetricHideWhenEmpty == "on")? "true" : "false") );
		}
		if ($badgesShowPlumx == "on") {
			$smarty->assign("showPlumx", "true");
			$smarty->assign("badgesPlumxHideWhenEmpty",  ( ($badgesPlumxHideWhenEmpty == "on")? "true" : "false") );
		}
		$output .= $smarty->fetch($this->getTemplateResource('badges.tpl'));
		return false;		

	}

	/**
	 * @copydoc Plugin::getActions()
	 */
	function getActions($request, $verb) {
		$router = $request->getRouter();
		import('lib.pkp.classes.linkAction.request.AjaxModal');
		return array_merge(
			$this->getEnabled()?array(
				new LinkAction(
					'settings',
					new AjaxModal(
						$router->url($request, null, null, 'manage', null, array('verb' => 'settings', 'plugin' => $this->getName(), 'category' => 'generic')),
						$this->getDisplayName()
					),
					__('manager.plugins.settings'),
					null
				),
			):array(),
			parent::getActions($request, $verb)
		);
    }
    

    /**
	 * @copydoc Plugin::manage()
	 */
	function manage($args, $request) {
		switch ($request->getUserVar('verb')) {
			case 'settings':
				$context = $request->getContext();

				AppLocale::requireComponents(LOCALE_COMPONENT_APP_COMMON,  LOCALE_COMPONENT_PKP_MANAGER);
				$templateMgr = TemplateManager::getManager($request);
				$templateMgr->register_function('plugin_url', array($this, 'smartyPluginUrl'));

				$this->import('BadgesSettingsForm');
				$form = new BadgesSettingsForm($this, $context->getId());

				if ($request->getUserVar('save')) {
					$form->readInputData();
					if ($form->validate()) {
						$form->execute();
						return new JSONMessage(true);
					}
				} else {
					$form->initData();
				}
				return new JSONMessage(true, $form->fetch($request));
		}
		return parent::manage($args, $request);
	}
}

?>
