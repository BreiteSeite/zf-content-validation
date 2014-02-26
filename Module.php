<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ContentValidation;

use Zend\Mvc\MvcEvent;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/ZF/ContentValidation/',
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        $app      = $e->getApplication();
        $events   = $app->getEventManager();
        $services = $app->getServiceManager();

        $events->attach($services->get('ZF\ContentValidation\ContentValidationListener'));
    }
    
    public function getValidatorConfig()
    {
    	return array(
    		'invokables' => array(
    			'ZF\ContentValidation\Validator\Db\RecordExists' => 'ZF\ContentValidation\Validator\DbRecordExists',
    			'ZF\ContentValidation\Validator\Db\NoRecordExists' => 'ZF\ContentValidation\Validator\DbNoRecordExists',
	    	)
    	);
    }
}
