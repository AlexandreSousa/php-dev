<?php
require 'init.php';

$window = new Janela(800,450);

$window->addTollBar();
$window->addPanel();


$window->connect_simple('destroy', array('Gtk', 'main_quit'));
$window->show_all();
Gtk::Main();