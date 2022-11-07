<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-09-15 01:37:47 --> Query error: Column 'name' in where clause is ambiguous - Invalid query: SELECT `m_feature`.`id`, `m_feature`.`name`, `m_feature`.`code`, `m_feature`.`icon`, `m_feature`.`sequence`, `m_feature`.`url`, `m_feature_group`.`id` as `group_id`, `m_feature_group`.`name` as `group_name`, `m_feature_group`.`sequence` as `group_sequence`, (SELECT COUNT(*) FROM m_feature where m_feature_group_id = m_feature_group.id AND m_feature.status_data = 'active' AND m_feature.visible = true) as group_count
FROM `m_feature_group` `m_feature_group`, `m_role_feature` `m_role_feature`, `m_feature` `m_feature`
WHERE `name` LIKE '%Piring%' ESCAPE '!'
AND `m_feature`.`m_feature_group_id` = `m_feature_group`.`id` AND `m_feature`.`status_data` = 'active' AND `m_feature`.`visible` = true
AND `m_feature`.`id` = `m_role_feature`.`m_feature_id` AND `m_role_id` = '1'
ORDER BY `m_feature`.`m_feature_group_id` ASC, `m_feature`.`sequence` ASC
