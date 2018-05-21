<?php
if (!defined('PARENT')) die('Ty hackerze za dychę :P');
session_start();

if (isset($dostepPoZalogowaniu) && $dostepPoZalogowaniu === true && (!isset($_SESSION['zalogowany']) || $_SESSION['zalogowany'] !== true)) {

    header('Location: logowanie.php');
    exit();
}

$menuRoles = array(
    1 => array(
        array('url' => 'panela.php', 'label' => 'Wizyty'),
        array('url' => '#', 'label' => 'Pojazdy', 'submenu' => array(
            array('url' => 'pojazdy.php', 'label' => 'Pojazdy'),
            array('url' => 'dodawaniepojazdu.php', 'label' => 'Dodawanie pojazdu')
        )),
        array('url' => 'klienci.php', 'label' => 'Klienci'),

        
        array('url' => 'logout.php', 'label' => 'Wyloguj'),
    ),
    // Rola 2
    2 => array(
        array('url' => 'panel.php', 'label' => 'Wizyty'),
        array('url' => '#', 'label' => 'Pojazdy', 'submenu' => array(
            array('url' => 'pojazdy.php', 'label' => 'Pojazdy'),
            array('url' => 'dodawaniepojazdu.php', 'label' => 'Dodawanie pojazdu')
        )),
        array('url' => 'edycjadanychk.php', 'label' => 'Edycja danych klienta'),
        array('url' => 'logout.php', 'label' => 'Wyloguj'),
    ),    
);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

