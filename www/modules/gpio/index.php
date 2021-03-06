<?php

/*****************************************************
* modules/gpio/index.php
* gpio index file
*(c)virt2real.ru 2013
* draft, by Gol
/*****************************************************/

// check module name
require_once('description.php');

// common include
include('../../parts/global.php');

// load module template
$module_content = file_get_contents("template.tpl");
$module_content = str_replace('{module_name}', $module_params['name'], $module_content);
$module_content = str_replace('{module_title}', $module_params['title'], $module_content);

// make global replaces
$module_content = GlobalReplace($module_content);

/***************** module specific part **************/

shell_exec("mount -t debugfs none /sys/kernel/debug");

// load active gpio list

$gpiolist = '<pre>' . shell_exec ("cat /sys/kernel/debug/gpio") . '</pre>';

$module_content = str_replace('{gpiolist}', $gpiolist, $module_content);

echo $module_content;

?>