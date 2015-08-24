<?php
/**
 * @Author  Chad Windnagle
 * @Project plg_jgeo
 * Date: 8/24/15
 */

defined('_JEXEC') or die;

/**
 * System plugin to highlight terms.
 *
 * @since  2.5
 */
class PlgSystemJGeo extends JPlugin
{
    public function onBeforeRender()
    {
       $app = JFactory::getApplication();

        // don't execute this on the admin end
        if ($app->isAdmin()) {
           return true;
        }

        $this->addScripts();

        // default the status to false
        $session = JFactory::getSession();

        // if the state hasn't been set then set it to false.
        // Only set it when its never been set before though
        if ($session->get('jgeo_position_status') !== true) {
            $session->set('jgeo_position_status', false);
        }
    }

    public function addScripts()
    {
        $doc = JFactory::getDocument();

        $doc->addScript(Juri::root() . '/plugins/system/jgeo/assets/js/geoposition.js');
        $doc->addScript(Juri::root() . '/plugins/system/jgeo/assets/js/jgeo.js');
        $doc->addScriptDeclaration('JGeo.init();');
        $doc->addScriptDeclaration('JGeo.setBase("' . JUri::root() . '")');
    }

    /*
     * Set the session data via ajax
     *
     * method called from Javascript
     */
    public function onAjaxJgeo()
    {
        $input = JFactory::getApplication()->input;

        $lat = $input->getString('latitude');
        $lng = $input->getString('longitude');

        $position = array('latitude' => $lat, 'longitude' => $lng);

        $session = JFactory::getSession();
        // set the session data
        $session->set('jgeo_position', json_encode($position));
        // set the status to true
        $session->set('jgeo_position_status', true);
    }
}