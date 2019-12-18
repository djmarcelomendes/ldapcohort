<?php
// This file is part of the Local LDAP Cohort plugin
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    local_ldapcohort
 * @copyright  2019 Marcelo Mendes
 * @author     Marcelo Mendes, m2msolucoes.com.br
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_ldapcohort;

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/user/lib.php');

class ldap {

    public function __construct() {

    }

	function verificaGrupo($user, $db, $config){
    $quem = '';
		if ( !empty($config->ldap_config_list_perfil) && !empty($config->ldap_config_list_cohort) ) {

      $basedn = $config->ldap_config_base_dn;

      // Chamo a função LDAP
      $ad = ldap_connect("ldap://{$config->ldap_config_host_ad}", $config->ldap_config_host_port) or die('Could not connect to LDAP server.');
      ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
      ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
      $us = explode('@', $config->ldap_config_us_mail);
      try {
          @ldap_bind($ad, "{$us[0]}@{$us[1]}", $config->ldap_config_us_pass);
      } catch (Exception $exc) {
          echo $exc->getTraceAsString();
          die;
      }

      $groups = array();
			$perfis = explode(',', $config->ldap_config_list_perfil);
      $cohorts = explode(',', $config->ldap_config_list_cohort);

      // Monto um array para pegar cada grupo que vem no LDAP e montar os cohorts possíveis
      foreach ($perfis as $key => $value) {
          //echo 'Key: '.$key.' Value: '.$value.'<br />';
          $groups[ltrim($value)][] = ltrim($cohorts[$key]);
      }
      $usss = $user->username;
      // Caso queira testar um usuário específico, só colocar nessa variável
      // $usss = "";
      $userdn = $this->getDN($ad, $usss, $basedn);
  		if( !$userdn ){
        // Cohort default quando o login não loga via LDAP, ele deve ser atribuido à esse cohort
        if( !empty($config->ldap_config_list_default_no_ldap) )
          $quem = $config->ldap_config_list_default_no_ldap;
      }else{
        // Cohort default quando o login possui login via LDAP, porém não aparece em nenhum perfil informado, ele deve ser atribuido à esse cohort
        if( !empty($config->ldap_config_list_default_ldap) )
          $quem = $config->ldap_config_list_default_ldap;

          foreach($groups as $group=>$k){
      			if ($this->checkGroupEx($ad, $userdn, $this->getDN($ad, $group, $basedn)))
      			{
      				$quem = $group;
      				break;
      			}
      		}
  		}

      if( !empty($quem) ){
        // Removo os coortes atuais
    		$db->delete_records('cohort_members', array('userid'=>$user->id));

    		// Aqui vou varrer os coortes que o perfil atual tem que ter
    		foreach($groups[$quem] as $gp){
    			// Procuro o ID do Coorte
    			$cohort = $db->get_record('cohort',array('name'=>$gp));
    			if( $cohort == null )
    				$insert = $db->insert_record('cohort', array('contextid'=>1, 'name'=>$gp, 'descriptionformat'=>1, 'timecreated'=>time(), 'timemodified'=>time()), $returnid=true, $bulk=false);
    			else
    				$insert = $cohort->id;

    			// Agora insiro o Coorte para o usuario
    			$db->insert_record('cohort_members', array('cohortid'=>$insert, 'userid'=>$user->id, 'timeadded'=>time()), $returnid=false, $bulk=false);
    		}
      }
		}
    // Caso queira verificar qual perfil veio do ldap
    //die($quem);
    return $quem;
	}

	/**
	 * This function searchs in LDAP tree entry specified by samaccountname and
	 * returns its DN or epmty string on failure.
	 *
	 * @param resource $ad
	 *          An LDAP link identifier, returned by ldap_connect().
	 * @param string $samaccountname
	 *          The sAMAccountName, logon name.
	 * @param string $basedn
	 *          The base DN for the directory.
	 * @return string
	 */
	function getDN($ad, $samaccountname, $basedn)
	{
		$result = ldap_search($ad, $basedn, "(samaccountname={$samaccountname})", array('dn'));

		if (! $result)
		{
			return '';
		}

		$entries = ldap_get_entries($ad, $result);

		if ($entries['count'] > 0)
		{
			return $entries[0]['dn'];
		}

		return '';
	}

	/**
	 * This function checks group membership of the user, searching in specified
	 * group and groups which is its members (recursively).
	 *
	 * @param resource $ad
	 *          An LDAP link identifier, returned by ldap_connect().
	 * @param string $userdn
	 *          The user Distinguished Name.
	 * @param string $groupdn
	 *          The group Distinguished Name.
	 * @return boolean Return true if user is a member of group, and false if not
	 *         a member.
	 */
	function checkGroupEx($ad, $userdn, $groupdn)
	{
		$result = ldap_read($ad, $userdn, '(objectclass=*)', array('memberof'));
		if (! $result)
		{
			return false;
		}

		$entries = ldap_get_entries($ad, $result);
		if ($entries['count'] <= 0)
		{
			return false;
		}

		if (empty($entries[0]['memberof']))
		{
			return false;
		}

		for ($i = 0; $i < $entries[0]['memberof']['count']; $i ++)
		{
			if ($entries[0]['memberof'][$i] == $groupdn)
			{
				return true;
			}
			elseif ($this->checkGroupEx($ad, $entries[0]['memberof'][$i], $groupdn))
			{
				return true;
			}
		}
		return false;
	}
}
