<?php
import('lib.pkp.classes.plugins.GenericPlugin');

class CookieNoticePlugin extends GenericPlugin {
    public function register($category, $path, $mainContextId = NULL) {
        $success = parent::register($category, $path);

        if ($success && $this->getEnabled()) {
            HookRegistry::register('TemplateManager::display', array($this, 'registerResources'));
            HookRegistry::register('Templates::Common::Footer::PageFooter', array($this, 'insertHTML'));
        }

        return $success;
    }

    function registerResources($hookName, $params) {
        $request = Application::get()->getRequest();
        $templateMgr = TemplateManager::getManager($request);

        $templateMgr->addStyleSheet(
            'cookieNoticeStyles',
            $request->getBaseUrl() . '/' . $this->getPluginPath() . '/css/cookieNotice.css',
            ['context' => ['backend', 'frontend']]
        );

        $templateMgr->addJavaScript(
            'cookieNoticeScript',
            $request->getBaseUrl() . '/' . $this->getPluginPath() . '/js/cookieNotice.js',
            ['context' => ['backend', 'frontend']]
        );

        return false;
    }

    function insertHTML($hookName, $params) {
        $request = Application::get()->getRequest();

        if ($request->getCookieVar('cookieNotice') != 1) {
            $request = Application::get()->getRequest();
            $templateMgr = TemplateManager::getManager($request);
            $output =& $params[2];
            $output .= $templateMgr->fetch($this->getTemplateResource('cookieNotice.tpl'));
        }

        return false;
    }

    public function getDisplayName() {
        return __('plugins.generic.cookieNotice.displayName');
    }

    public function getDescription() {
        return __('plugins.generic.cookieNotice.description');
    }

    public function isSitePlugin() {
        return true;
    }

    // Can only be activated at site level.
    function getCanEnable() {
        return !((bool) Application::get()->getRequest()->getContext());
    }

    // Can only be deactivated at site level.
    function getCanDisable() {
        return !((bool) Application::get()->getRequest()->getContext());
    }
}
