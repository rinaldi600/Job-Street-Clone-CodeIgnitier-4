<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/registration_user', 'RegistrationUser::index', ['filter' => 'LoginFilter']);
$routes->post('/signupUser', 'RegistrationUser::signupUser');
$routes->post('/loginUser', 'LoginUser::loginUser');
$routes->post('/login_user/logout','LoginUser::logout',['filter' => 'UserFilter']);
$routes->get('/login_user', 'LoginUser::index', ['filter' => 'LoginFilter']);
$routes->get('/login_company', 'LoginCompany::index', ['filter' => 'LoginFilterCompany']);
$routes->post('/loginCompany', 'LoginCompany::loginCompany');
$routes->get('/registration_company', 'RegistrationCompany::index');
$routes->post('/signupCompany', 'RegistrationCompany::registrationCompany');
$routes->post('/signupCompany', 'RegistrationCompany::registrationCompany');
$routes->get('/job', 'Job::index');
$routes->post('/apply_job','Job::applyJob');
$routes->post('/detail_job', 'Job::detailJob');

$routes->get('/dashboard_user', 'UserDashboard::index', ['filter' => 'UserFilter']);
$routes->get('/dashboard_user/profile', 'UserDashboard::user', ['filter' => 'UserFilter']);
$routes->get('/dashboard_user/my_application', 'UserDashboard::myApplication', ['filter' => 'UserFilter']);
$routes->get('/dashboard_user/resume_cv', 'UserDashboard::resumeCV', ['filter' => 'UserFilter']);
$routes->post('/dashboard_user/upload_resume_cv', 'UserDashboard::uploadCV', ['filter' => 'UserFilter']);
$routes->post('/dashboard_user/download_cv', 'UserDashboard::downloadCV', ['filter' => 'UserFilter']);
$routes->post('/dashboard_user/delete_cv', 'UserDashboard::deleteCV', ['filter' => 'UserFilter']);
$routes->post('/dashboard_user/get_email', 'UserDashboard::getEmail', ['filter' => 'UserFilter']);
$routes->post('/dashboard_user/get_new_cv', 'UserDashboard::getNewCV', ['filter' => 'UserFilter']);
$routes->post('/dashboard_user/delete_my_application', 'UserDashboard::deleteMyApplication', ['filter' => 'UserFilter']);
$routes->get('/dashboard_user/change_cv/(:segment)', 'UserDashboard::changeCV/$1', ['filter' => 'UserFilter']);

$routes->get('/dashboard_company', 'CompanyDashboard::index', ['filter' => 'CompanyFilter']);
$routes->get('/dashboard_company/change_description_job/(:segment)', 'CompanyDashboard::changeDescription/$1', ['filter' => 'CompanyFilter']);
$routes->get('/dashboard_company/view_cv/(:segment)', 'CompanyDashboard::viewCV/$1', ['filter' => 'CompanyFilter']);
$routes->get('/dashboard_company/view_job/(:segment)/(:segment)', 'CompanyDashboard::previewJob/$1/$2', ['filter' => 'CompanyFilter']);
$routes->get('/dashboard_company/create_lowongan','CompanyDashboard::createLowongan',['filter' => 'CompanyFilter']);
$routes->get('/dashboard_company/view_pelamar_job/(:segment)/(:segment)','CompanyDashboard::pelamarLowongan/$1/$2',['filter' => 'CompanyFilter']);
$routes->post('/logout_company', 'CompanyDashboard::logoutCompany', ['filter' => 'CompanyFilter']);
$routes->post('/getLowongan', 'CompanyDashboard::getLowongan', ['filter' => 'CompanyFilter']);
$routes->post('/changeLowongan', 'CompanyDashboard::changeLowongan', ['filter' => 'CompanyFilter']);
$routes->post('/deleteLowongan', 'CompanyDashboard::deleteLowongan', ['filter' => 'CompanyFilter']);
$routes->post('/dashboard_company/download_cv', 'CompanyDashboard::downloadCV', ['filter' => 'CompanyFilter']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
