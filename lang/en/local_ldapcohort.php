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

$string['pluginname'] = 'Moodle LDAP Cohort';

$string['ldap_verify_enabled'] = 'Enable LDAP verify';
$string['ldap_verify_enabled_desc'] = 'This tickbox enables the checking of LDAP profiles and configures Cohort according to the profile found..';
$string['ldap_config_us_mail'] = 'LDAP Connection User';
$string['ldap_config_us_mail_desc'] = 'Put the LDAP connection user. For example: user@in.domain.com';
$string['ldap_config_us_pass'] = 'LDAP connection password';
$string['ldap_config_us_pass_desc'] = 'Enter LDAP connection password';
$string['ldap_config_host_ad'] = 'Connection Host';
$string['ldap_config_host_ad_desc'] = 'Put the connecting host. For example: adds.dominio.com';
$string['ldap_config_base_dn'] = 'DN - Distinguished Name';
$string['ldap_config_base_dn_desc'] = 'Complete path dn. For example: ou=xyz,dc=in,dc=xyz,dc=ab,dc=cde,dc=fg';
$string['ldap_config_host_port'] = 'Connection port';
$string['ldap_config_host_port_desc'] = 'Insert the connection port. For example: 389';
$string['ldap_config_list_head'] = 'Profile List';
$string['ldap_config_list_head_help'] = 'Here will be set the groups and cohorts for treatment by the plugin';
$string['ldap_config_list_perfil'] = 'Profile';
$string['ldap_config_list_perfil_help'] = 'Profile that comes in ldap authentication, separated by comma';
$string['ldap_config_list_cohort'] = 'Cohort';
$string['ldap_config_list_cohort_help'] = 'Cohort to be created, separated by comma and following the profile string';
$string['ldap_config_list_default_ldap'] = 'LDAP default group';
$string['ldap_config_list_default_ldap_help'] = 'Default group when login has login via LDAP, but does not appear in any profile entered, it must be assigned to this group';
$string['ldap_config_list_default_no_ldap'] = 'Default group without LDAP';
$string['ldap_config_list_default_no_ldap_help'] = 'Default group when login does not log in via LDAP, it must be assigned to this group';
