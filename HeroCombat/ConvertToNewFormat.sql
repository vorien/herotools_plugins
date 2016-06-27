/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

USE `herocombatconversion`;

/* Alter table in target */
ALTER TABLE `armors` 
	CHANGE `a-r_cost` `ar_cost` VARCHAR(255) NULL AFTER `training_penalty` 
;

/* Alter table in target */
ALTER TABLE `characterprotections` 
	CHANGE `r_pd_modifiers`  `r_pd_modifier` INT(11)   NULL DEFAULT 0 AFTER `n_ed_modifier`, 
	CHANGE `r_ed_modifiers` `r_ed_modifier` INT(11)   NULL DEFAULT 0 AFTER `r_pd_modifier`
;

/* Alter table in target */
ALTER TABLE `characters` 
	ADD COLUMN `characterfile` VARCHAR(100)  COLLATE latin1_swedish_ci NULL AFTER `player` , 
	ADD COLUMN `mainfile` VARCHAR(25)  COLLATE latin1_swedish_ci NULL AFTER `characterfile` , 
	CHANGE `str` `str` INT(11)   NULL AFTER `mainfile` , 
	CHANGE `user_id` `userdata_id` INT(11) 
;

/* Alter table in target */
ALTER TABLE `targets` 
	ADD COLUMN `type` VARCHAR(10)  COLLATE utf8_general_ci NULL AFTER `id` , 
	ADD COLUMN `sort_order` INT(11)   NULL AFTER `type` , 
	CHANGE `roll` `roll` VARCHAR(100)  COLLATE utf8_general_ci NULL AFTER `sort_order` ;

/* Alter table in target */
ALTER TABLE `weapons` 
	CHANGE `a-r_cost` `ar_cost` VARCHAR(255) NULL 
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;