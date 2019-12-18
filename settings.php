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
 * This plugin verify group user ldap and create
 * cohort same name specified settings
 *
 * @package    local
 * @subpackage ldapcohort
 * @copyright  2019 Marcelo Mendes, m2msolucoes.com.br
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    $moderator = get_admin();
    $site = get_site();

    $settings = new admin_settingpage('local_ldapcohort', get_string('pluginname', 'local_ldapcohort'));
    $ADMIN->add('localplugins', $settings);

    $name = 'local_ldapcohort/ldap_verify_enabled';
    $title = get_string('ldap_verify_enabled', 'local_ldapcohort');
    $description = get_string('ldap_verify_enabled_desc', 'local_ldapcohort');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 1);
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_us_mail';
    $default = 'connection1';
    $title = get_string('ldap_config_us_mail', 'local_ldapcohort');
    $description = get_string('ldap_config_us_mail_desc', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_NOTAGS);
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_us_pass';
    $default = 'connection2';
    $title = get_string('ldap_config_us_pass', 'local_ldapcohort');
    $description = get_string('ldap_config_us_pass_desc', 'local_ldapcohort');
    $setting = new admin_setting_configpasswordunmask($name, $title, $description, '', PARAM_RAW);
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_host_ad';
    $default = 'connection3';
    $title = get_string('ldap_config_host_ad', 'local_ldapcohort');
    $description = get_string('ldap_config_host_ad_desc', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_base_dn';
    $default = 'connection4';
    $title = get_string('ldap_config_base_dn', 'local_ldapcohort');
    $description = get_string('ldap_config_base_dn_desc', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_host_port';
    $default = '389';
    $title = get_string('ldap_config_host_port', 'local_ldapcohort');
    $description = get_string('ldap_config_host_port_desc', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_list_head';
    $title = get_string('ldap_config_list_head', 'local_ldapcohort');
    $help = get_string('ldap_config_list_head_help', 'local_ldapcohort');
    $item = new admin_setting_heading($name, $title, $help, '');
    $settings->add($item);

    $name = 'local_ldapcohort/ldap_config_list_perfil';
    $title = get_string('ldap_config_list_perfil', 'local_ldapcohort');
    $help = get_string('ldap_config_list_perfil_help', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $help, '');
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_list_cohort';
    $title = get_string('ldap_config_list_cohort', 'local_ldapcohort');
    $help = get_string('ldap_config_list_cohort_help', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $help, '');
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_list_default_ldap';
    $title = get_string('ldap_config_list_default_ldap', 'local_ldapcohort');
    $help = get_string('ldap_config_list_default_ldap_help', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $help, '');
    $settings->add($setting);

    $name = 'local_ldapcohort/ldap_config_list_default_no_ldap';
    $title = get_string('ldap_config_list_default_no_ldap', 'local_ldapcohort');
    $help = get_string('ldap_config_list_default_no_ldap_help', 'local_ldapcohort');
    $setting = new admin_setting_configtext($name, $title, $help, '');
    $settings->add($setting);

}
