<?php

/**
 * @file plugins/generic/badges/BadgesPlugin.inc.php
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
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
	function register($category, $path) {
		$success = parent::register($category, $path);
		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
		if ($success && $this->getEnabled()) {
			// Insert Badges div
			HookRegistry::register('Templates::Article::Details', array($this, 'addBadges'));
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

	/**
	 * Add badges to article landing page
	 * @param $hookName string
	 * @param $params array
	 */
	function addBadges($hookName, $params) {
		$request = $this->getRequest();
		$context = $request->getContext();

		$smarty =& $params[1];
		$output =& $params[2];

        $article = $smarty->get_template_vars('article');
        $doi = $article->getBestArticleId();

		$smarty->assign('doi', $doi);

		$output .= $smarty->fetch($this->getTemplateResource('badges.tpl'));
		return false;		

	}
}

?>
