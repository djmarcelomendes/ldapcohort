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

$string['ldap_verify_enabled'] = 'Ativar verificação LDAP';
$string['ldap_verify_enabled_desc'] = 'Essa caixa de seleção permite a verificação de perfis LDAP e configura o Coorte de acordo com o perfil encontrado.';
$string['ldap_config_us_mail'] = 'Usuário de conexão LDAP';
$string['ldap_config_us_mail_desc'] = 'Coloque o usuário da conexão LDAP. Por exemplo: user@in.domain.com';
$string['ldap_config_us_pass'] = 'Senha de conexão LDAP';
$string['ldap_config_us_pass_desc'] = 'Digite a senha da conexão LDAP';
$string['ldap_config_host_ad'] = 'Host de conexão';
$string['ldap_config_host_ad_desc'] = 'Coloque o host de conexão. Por exemplo: adds.dominio.com';
$string['ldap_config_base_dn'] = 'DN - Nome Distinto';
$string['ldap_config_base_dn_desc'] = 'Caminho completo dn. Por exemplo: ou=xyz,dc=in,dc=xyz,dc=ab,dc=cde,dc=fg';
$string['ldap_config_host_port'] = 'Porta de conexão';
$string['ldap_config_host_port_desc'] = 'Insira a porta de conexão. Por exemplo: 389';
$string['ldap_config_list_head'] = 'Lista de perfis (grupos)';
$string['ldap_config_list_head_help'] = 'Aqui serão definidos os grupos e coortes para tratamento pelo plugin';
$string['ldap_config_list_perfil'] = 'Perfil';
$string['ldap_config_list_perfil_help'] = 'Perfil fornecido na autenticação ldap, separado por vírgula';
$string['ldap_config_list_cohort'] = 'Coorte';
$string['ldap_config_list_cohort_help'] = 'Coorte a ser criada, separada por vírgula e seguindo a sequência do perfil';
$string['ldap_config_list_default_ldap'] = 'Grupo padrão LDAP';
$string['ldap_config_list_default_ldap_help'] = 'Grupo padrão quando o login tem login via LDAP, mas não aparece em nenhum perfil inserido, ele deve ser atribuído a este grupo';
$string['ldap_config_list_default_no_ldap'] = 'Grupo padrão sem LDAP';
$string['ldap_config_list_default_no_ldap_help'] = 'Grupo padrão quando o login não faz login via LDAP, ele deve ser atribuído a este grupo';
