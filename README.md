# ldapcohort

copyright  2019 Marcelo Mendes, m2msolucoes.com.br
author     Marcelo Mendes do Amaral marcelo@m2msolcuoes.com.br
license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later


CHANGES

CHANGES
version 2019121700:

Initial!

ABOUT

This plugin aims to identify which group the user belongs to in LDAP authentication and apply to it the cohort defined in the plugin settings.
For example, in the user's LDAP login comes the group
"Boss Data", and can be configured to add to it the "Boss" Cohort. This allows multiple configurations to be made, and the same user with a given group can be added to multiple cohorts.
Example:
Profile: Boss Data, Boss Data
Cohort: Boss, Boss & Employees


SETTINGS

LDAP Connection User: Enter the LDAP Connection User. For example: user@in.domain.com

LDAP Connection Password: Enter the LDAP Connection Password

Connecting Host: Enter the connecting host. For example: adds.dominio.com

DN - Distinguished Name: Full Path dn. For example: ou = xyz, dc = in, dc = xyz, dc = ab, dc = cde, dc = fg

Connection port: Insert the connection port. For example: 389

Profile List: Here you put the possible groups that come in LDAP authentication and you want verification to add to Cohort. Always comma separated. For example: Boss Data, Employee Data

Cohort: Cohort to be created, separated by comma and following the sequence of the profile above. For example: Boss, Employee
Note The same profile name can be used. For example: Boss Data, Employee Data

LDAP default group: Default group to be assigned when login is logged in via LDAP, but no group comes, it must be assigned to this group to be handled in the profile list and cohort. For example the user logs in via LDAP, but does not belong to any groups, so put them in that group. This group must be added to the group list and cohort to be treated.

Default group without LDAP: Default group when login does not log in via LDAP, it must be assigned to this group to be handled in the group and cohorts list. This group must be added to the group list and cohort to be treated.

COMPLEX EXAMPLE

The user with group "Boss Data" at login, we want to put him in the "Boss" and "Employee" cohorts. The configuration looks like this:
Profile list: Boss Data, Boss Data
Cohort: Boss, Employee
Therefore, when you find the "Boss Data" group, it will be added to the "Boss" and "Employee" cohort, because (Profile List [0] = "Boss Data" and Cohort [0] = "Boss") and (List Profiles [1] = "Data Manager" and Cohort [1] = "Employee")

INSTALLATION

Just place the ldapcohort directory inside your Moodle's local directory.
Install the plugin and browse to:

Site Administration->Plugins->Local plugins->Moodle LDAP Cohort

