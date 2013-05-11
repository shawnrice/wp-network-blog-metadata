<?php

/*
Plugin Name: Network Blog Metadata
Plugin URI: 
Description: A plugin to collect usage data about individual blogs on a network installation.
Version: .1-alpha
Author: Shawn Rice
Author URI: 
License: GPL2 ? Which is best?
*/


/* Table Schema

Change "invest" to database name and add prefix

CREATE  TABLE `invest`.`nbm-data` (
  `blog_id` INT NOT NULL ,
  `user_role` VARCHAR(45) NULL ,
  `blog_intended_use` VARCHAR(45) NULL ,
  `course_title` VARCHAR(128) NULL ,
  `course_number` VARCHAR(45) NULL ,
  `course_enrollment` INT NULL ,
  `course_multiple_section` BINARY NULL ,
  `course_writing_intensive` BINARY NULL ,
  `course_interactive` VARCHAR(45) NULL ,
  `visibility` VARCHAR(45) NULL ,
  `research_area` VARCHAR(128) NULL ,
  `portfolio_professional` BINARY NULL ,
  `portfolio_content_type` VARCHAR(128) NULL ,
  `student_level` VARCHAR(20) NULL ,
  `student_major` VARCHAR(128) NULL ,
  `person_department` VARCHAR(128) NULL ,
  `class_project_course` VARCHAR(128) NULL ,
  `class_project_description` MEDIUMTEXT NULL ,
  PRIMARY KEY (`blog_id`) ,
  UNIQUE INDEX `blog_id_UNIQUE` (`blog_id` ASC) );

*/

?>