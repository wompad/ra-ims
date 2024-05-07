<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['account_suffix']		= '@ENTDSWD.LOCAL';
$config['base_dn']				= 'OU=FO Caraga,DC =ENTDSWD,DC =local';
$config['domain_controllers']	= array ("CRG-DC2-SVR.ENTDSWD.local");
$config['ad_username']			= null;
$config['ad_password']			= null;
$config['real_primarygroup']	= true;
$config['use_ssl']				= false;
$config['use_tls'] 				= false;
$config['recursive_groups']		= true;


/* End of file adldap.php */
/* Location: ./system/application/config/adldap.php */