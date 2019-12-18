<?php
// This file is part of Moodle - http://moodle.org/
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
 * This plugin verify group user ldap and create
 * cohort same name specified settings
 *
 * @package    local
 * @subpackage ldapcohort
 * @copyright  2019 Marcelo Mendes, m2msolucoes.com.br
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_ldapcohort;

defined('MOODLE_INTERNAL') || die();

class observer {

    public static function verify_ldap(\core\event\user_loggedin $event) {
      global $CFG, $SITE, $USER, $DB;

      $eventdata = $event->get_data();
      $user = \core_user::get_user($eventdata['objectid']);

      $config = get_config('local_ldapcohort');
      $ldap_verify_enabled = $config->ldap_verify_enabled;

      if( !isset($USER->member_verified) && $ldap_verify_enabled ){

        if ( !empty($config->ldap_config_list_perfil) && !empty($config->ldap_config_list_cohort) ) {
          $ldap = new \local_ldapcohort\ldap();
          $USER->cohort = $ldap->verificaGrupo($user, $DB, $config);
          $USER->member_verified = true;
        }
      }
    }
}
