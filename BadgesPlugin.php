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
 *
 * @ingroup plugins_generic_dates
 *
 * @brief badges plugin class
 */

namespace APP\plugins\generic\badges;

use APP\core\Application;
use APP\template\TemplateManager;
use PKP\core\JSONMessage;
use PKP\linkAction\LinkAction;
use PKP\linkAction\request\AjaxModal;
use PKP\plugins\GenericPlugin;
use PKP\plugins\Hook;

class BadgesPlugin extends GenericPlugin
{
    /**
     * Called as a plugin is registered to the registry
     *
     * @param $category String Name of category plugin was registered to
     * @param null|mixed $mainContextId
     *
     * @return boolean True iff plugin initialized successfully; if false,
     * 	the plugin will not be registered.
     */
    public function register($category, $path, $mainContextId = null)
    {
        $success = parent::register($category, $path, $mainContextId);
        if (Application::isUnderMaintenance()) {
            return $success;
        }
        if ($success && $this->getEnabled($mainContextId)) {
            // Insert Badges div
            Hook::add('Templates::Article::Details', [$this, 'addBadges']);
            Hook::add('Templates::Preprint::Details', [$this, 'addBadges']);
        }
        return $success;
    }

    /**
     * Get the plugin display name.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return __('plugins.generic.badges.displayName');
    }

    /**
     * Get the plugin description.
     *
     * @return string
     */
    public function getDescription()
    {
        return __('plugins.generic.badges.description');
    }

    private function getDoi($smarty)
    {
        $application = Application::getName();
        $mapAppToVarName = ['ojs2' => 'article', 'ops' => 'preprint'];

        $submission = $smarty->getTemplateVars($mapAppToVarName[$application]);
        $publication = $submission->getCurrentPublication();

        return $publication->getDoi();
    }

    /**
     * Add badges to article/preprint landing page
     *
     * @param $hookName string
     * @param $params array
     */
    public function addBadges($hookName, $params)
    {
        $request = $this->getRequest();
        $context = $request->getContext();

        $smarty = & $params[1];
        $output = & $params[2];

        $doi = $this->getDoi($smarty);
        $smarty->assign('doi', $doi);

        $badgesShowDimensions = $this->getSetting($context->getId(), 'badgesShowDimensions');
        $badgesDimensionsHideWhenEmpty = $this->getSetting($context->getId(), 'badgesDimensionsHideWhenEmpty');
        $badgesDimensionsStyle = $this->getSetting($context->getId(), 'badgesDimensionsStyle');
        $badgesShowAltmetric = $this->getSetting($context->getId(), 'badgesShowAltmetric');
        $badgesAltmetricHideWhenEmpty = $this->getSetting($context->getId(), 'badgesAltmetricHideWhenEmpty');
        $badgesAltmetricStyle = $this->getSetting($context->getId(), 'badgesAltmetricStyle');
        $badgesShowPlumx = $this->getSetting($context->getId(), 'badgesShowPlumx');
        $badgesPlumxHideWhenEmpty = $this->getSetting($context->getId(), 'badgesPlumxHideWhenEmpty');

        if ($badgesShowDimensions == 'on') {
            $smarty->assign('showDimensions', 'true');
            $smarty->assign('badgesDimensionsHideWhenEmpty', (($badgesDimensionsHideWhenEmpty == 'on') ? 'true' : 'false'));
        }
        if ($badgesShowAltmetric == 'on') {
            $smarty->assign('showAltmetric', 'true');
            $smarty->assign('badgesAltmetricHideWhenEmpty', (($badgesAltmetricHideWhenEmpty == 'on') ? 'true' : 'false'));
            $smarty->assign('badgesAltmetricStyle', $badgesAltmetricStyle ?? 'donut');
        }
        if ($badgesShowPlumx == 'on') {
            $smarty->assign('showPlumx', 'true');
            $smarty->assign('badgesPlumxHideWhenEmpty', (($badgesPlumxHideWhenEmpty == 'on') ? 'true' : 'false'));
            $smarty->assign('badgesDimensionsStyle', $badgesDimensionsStyle ?? 'small_circle');
        }
        $output .= $smarty->fetch($this->getTemplateResource('badges.tpl'));
        return false;

    }

    /**
     * @copydoc Plugin::getActions()
     */
    public function getActions($request, $verb)
    {
        $router = $request->getRouter();
        return array_merge(
            $this->getEnabled() ? [
                new LinkAction(
                    'settings',
                    new AjaxModal(
                        $router->url($request, null, null, 'manage', null, ['verb' => 'settings', 'plugin' => $this->getName(), 'category' => 'generic']),
                        $this->getDisplayName()
                    ),
                    __('manager.plugins.settings'),
                    null
                ),
            ] : [],
            parent::getActions($request, $verb)
        );
    }


    /**
     * @copydoc Plugin::manage()
     */
    public function manage($args, $request)
    {
        switch ($request->getUserVar('verb')) {
            case 'settings':
                $context = $request->getContext();

                $templateMgr = TemplateManager::getManager($request);
                $templateMgr->registerPlugin('function', 'plugin_url', [$this, 'smartyPluginUrl']);

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
