<?php

/**
 * @file plugins/generic/badges/BadgesSettingsForm.inc.php
 *
 * Copyright 2019
 * Portal de Revistas de la Universidad Nacional de La Plata
 *  https://revistas.unlp.edu.ar
 *  https://sedici.unlp.edu.ar
 *
 * @author gonetil *
 *
 * @class BadgesSettingsForm
 *
 * @ingroup plugins_generic_badges
 *
 * @brief Form for journal managers to modify Almetric Badges plugin options
 */

namespace APP\plugins\generic\badges;

use APP\template\TemplateManager;
use PKP\form\Form;
use PKP\form\validation\FormValidatorCSRF;
use PKP\form\validation\FormValidatorPost;

class BadgesSettingsForm extends Form
{
    public const CONFIG_VARS = [
        'badgesShowDimensions' => 'string',
        'badgesShowAltmetric' => 'string',
        'badgesShowPlumx' => 'string',
        'badgesDimensionsHideWhenEmpty' => 'string',
        'badgesAltmetricHideWhenEmpty' => 'string',
        'badgesPlumxHideWhenEmpty' => 'string',
        'badgesAltmetricStyle' => 'string'
    ];

    /** @var int */
    public $contextId;

    /** @var object */
    public $plugin;

    /**
     * Constructor
     *
     * @param $plugin BadgesPlugin
     * @param $contextId int
     */
    public function __construct($plugin, $contextId)
    {
        $this->contextId = $contextId;
        $this->plugin = $plugin;

        parent::__construct($plugin->getTemplateResource('settingsForm.tpl'));

        $this->addCheck(new FormValidatorPost($this));
        $this->addCheck(new FormValidatorCSRF($this));
    }
    /**
     * Initialize form data.
     */
    public function initData()
    {
        $this->_data = [];
        foreach (self::CONFIG_VARS as $configVar => $type) {
            $this->_data[$configVar] = $this->plugin->getSetting($this->contextId, $configVar);
        }
    }

    /**
     * Assign form data to user-submitted data.
     */
    public function readInputData()
    {
        $this->readUserVars(array_keys(self::CONFIG_VARS));
    }

    /**
     * Fetch the form.
     *
     * @copydoc Form::fetch()
     *
     * @param null|mixed $template
     */
    public function fetch($request, $template = null, $display = false)
    {
        $templateMgr = TemplateManager::getManager($request);
        $templateMgr->assign('pluginName', $this->plugin->getName());
        return parent::fetch($request);
    }

    /**
     * Save settings.
     */
    /**
     * @copydoc Form::execute()
     */


    public function execute(...$functionArgs)
    {
        $plugin = &$this->plugin;
        $contextId = $this->contextId;

        foreach (self::CONFIG_VARS as $configVar => $type) {
            $plugin->updateSetting($contextId, $configVar, $this->getData($configVar), $type);
        }

        parent::execute(...$functionArgs);
    }
}
