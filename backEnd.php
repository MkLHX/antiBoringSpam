<?php
/**
 * Created by PhpStorm.
 * User: drumt
 * Date: 25/11/2018
 * Time: 18:21
 */

require 'vendor/autoload.php';

use App\Imap;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * @param array $req
 * @return array
 */
function cleanRequest(array $req)
{
    $result = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST as $key => $p) {
            $result[$key] = trim(htmlentities($p));
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        foreach ($_GET as $key => $p) {
            $result[$key] = trim(htmlentities($p));
        }
    }
    return $result;
}

session_start();

if (isset($_POST['submit'])) {
    $post = cleanRequest($_POST);
    if (isset($post['email']) && !empty($post['email']) && isset($post['password']) && !empty($post['password'])) {
        $_SESSION['email'] = $post['email'];
        $_SESSION['password'] = $post['password'];
        $imap = new Imap('{imap.free.fr:993/imap/ssl/novalidate-cert}', '{imap.free.fr}');
        $imapResponse = $imap->runImap($_SESSION['email'], $_SESSION['password']);
    }
}

if (isset($_SESSION['email']) && !empty($_SESSION['email']) && isset($_SESSION['password']) && !empty($_SESSION['password'])) {
    $imap = new Imap('{imap.free.fr:993/imap/ssl/novalidate-cert}', '{imap.free.fr}');
    $imapResponse = $imap->runImap($_SESSION['email'], $_SESSION['password']);
}

if (isset($_GET['box'])) { //|| isset($_SESSION['box']) && !empty($_SESSION['box'])) {
    $get = cleanRequest($_GET);
    $_SESSION['box'] = $get['box'];
    $imap = new Imap('{imap.free.fr:993/imap/ssl/novalidate-cert}', '{imap.free.fr}');
    $boxContent = [];
    $boxContent = $imap->getBoxContent($_SESSION['box']);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /');
}
