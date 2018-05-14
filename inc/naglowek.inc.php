<?php
if (!defined('PARENT')) die('Ty hackerze za dychę :P');
session_start();

if (isset($dostepPoZalogowaniu) && $dostepPoZalogowaniu === true && (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true)) {

    header('Location: logowanie.php');
    exit();
}

$menuRoles = array(
    1 => array(
        array('url' => 'panel.php', 'label' => 'home'),
        array('url' => '#', 'label' => 'Pojazdy', 'submenu' => array(
            array('url' => 'pojazdy.php', 'label' => 'pojazdy'),
            array('url' => 'dodawaniepojazdu.php', 'label' => 'dodawanie pojazdu')
        )),
        array('url' => 'witamy.php', 'label' => 'oferta'),
        array('url' => 'logout.php', 'label' => 'Wyloguj'),
    ),
    // Rola 2
    2 => array(
        array('url' => 'witamy.php', 'label' => 'home'),
        array('url' => '#', 'label' => 'Pojazdy111', 'submenu' => array(
            array('url' => 'pojazdy.php', 'label' => 'pojazdy'),
            array('url' => 'dodawaniepojazdu.php', 'label' => 'dodawanie pojazdu')
        )),
        array('url' => 'witamy.php', 'label' => 'oferta'),
        array('url' => 'witamy.php', 'label' => 'itd ...'),
    ),    
);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

