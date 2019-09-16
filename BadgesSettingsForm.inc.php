<?php

/**
 * @file plugins/generic/badges/BadgesSettingsForm.inc.php
 *
 * Copyright (c) 2014-2017 Simon Fraser University
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class BadgesSettingsForm
 * @ingroup plugins_generic_badges
 *
 * @brief Form for journal managers to modify Almetric Badges plugin options
 */

import('lib.pkp.classes.form.Form');

class BadgesSettingsForm extends Form {

	/** @var int */
	var $_journalId;

	/** @var object */
	var $_plugin;

	/**
	 * Constructor
	 * @param $plugin BadgesPlugin
	 * @param $journalId int
	 */
	function __construct($plugin, $journalId) {
		$this->_journalId = $journalId;
		$this->_plugin = $plugin;

		parent::__construct($plugin->getTemplateResource('settingsForm.tpl'));

		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}
	/**
	 * Initialize form data.
	 */
	function initData() {
		$this->_data = array(
            'badgesShowDimensions' => $this->_plugin->getSetting($this->_journalId, 'badgesShowDimensions'),
            'badgesShowAltmetric' => $this->_plugin->getSetting($this->_journalId, 'badgesShowAltmetric'),
            'badgesShowPlumx' => $this->_plugin->getSetting($this->_journalId, 'badgesShowPlumx'),
		);
    }

    	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
        $this->readUserVars(array('badgesShowDimensions'));
        $this->readUserVars(array('badgesShowAltmetric'));
        $this->readUserVars(array('badgesShowPlumx'));

    }
    
    /**
	 * Fetch the form.
	 * @copydoc Form::fetch()
	 */
	function fetch($request,$template = NULL, $display = false) {
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('pluginName', $this->_plugin->getName());
		return parent::fetch($request);
    }
    
   	/**
	 * Save settings.
	 */
	function execute() {
		$plugin =& $this->_plugin;
		$contextId = $this->_journalId;

		$plugin->updateSetting($contextId, 'badgesShowDimensions', $this->getData('badgesShowDimensions'), 'integer');
		$plugin->updateSetting($contextId, 'badgesShowAltmetric', $this->getData('badgesShowAltmetric'), 'integer');
		$plugin->updateSetting($contextId, 'badgesShowPlumx', $this->getData('badgesShowPlumx'), 'integer');
	}



}