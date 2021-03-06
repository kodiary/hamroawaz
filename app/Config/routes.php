<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'new', 'action' => 'index'));
    Router::connect('/checkDate', array('controller' => 'new', 'action' => 'checkDate'));
 Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
 Router::connect('/category', array('controller' => 'dashboard', 'action' => 'category'));
 Router::connect('/page/getHeadline/*', array('controller' => 'page', 'action' => 'getHeadline'));
 Router::connect('/page/*', array('controller' => 'page', 'action' => 'index'));
 Router::connect('/description/getContent/*', array('controller' => 'description', 'action' => 'getContent'));
 Router::connect('/description/getCategoryId/*', array('controller' => 'description', 'action' => 'getCategoryId'));
 Router::connect('/description/getSimilarnews/*', array('controller' => 'description', 'action' => 'getSimilarnews'));
Router::connect('/description/*', array('controller' => 'description', 'action' => 'detail'));
/***************************************************************************************************************/
Router::connect('/archive/months_in_string/*', array('controller' => 'archive', 'action' => 'months_in_string'));
Router::connect('/archive/checkstandard/*', array('controller' => 'archive', 'action' => 'checkstandard'));
Router::connect('/archive/checkslider/*', array('controller' => 'archive', 'action' => 'checkslider'));
Router::connect('/archive/getCategory', array('controller' => 'archive', 'action' => 'getCategory'));
Router::connect('/archive/getNewsId/*', array('controller' => 'archive', 'action' => 'getNewsId'));
Router::connect('/archive/getNewsContent/*', array('controller' => 'archive', 'action' => 'getNewsContent'));
Router::connect('/archive/checkDate', array('controller' => 'archive', 'action' => 'checkDate'));
Router::connect('/archive/days_in_month', array('controller' => 'archive', 'action' => 'days_in_month'));
Router::connect('/archive/findmostView/*', array('controller' => 'archive', 'action' => 'findmostView'));
Router::connect('/archive/newstandard', array('controller' => 'archive', 'action' => 'newstandard'));
Router::connect('/archive/newsubstandard', array('controller' => 'archive', 'action' => 'newsubstandard'));
Router::connect('/archive/*', array('controller' => 'archive', 'action' => 'index'));
/***************************************************************************************************************/
Router::connect('/archivepage/getHeadline/*', array('controller' => 'archivepage', 'action' => 'getHeadline'));
Router::connect('/archivepage/*', array('controller' => 'archivepage', 'action' => 'index'));
/***************************************************************************************************************/

Router::connect('/archivedescription/getSimilarnews/*', array('controller' => 'archivedescription', 'action' => 'getSimilarnews'));
//Router::connect('/archivedescription/*/days_in_month', array('controller' => 'archivedescription', 'action' => 'days_in_month'));
Router::connect('/archivedescription/*', array('controller' => 'archivedescription', 'action' => 'detail'));

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/Insert', array('controller' => 'user', 'action' => 'Insert'));
        Router::parseExtensions('pdf');
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
       
