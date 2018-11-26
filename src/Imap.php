<?php

/**
 * Created by PhpStorm.
 * User: MkLHX
 * Date: 20/11/2018
 * Time: 21:20
 */

namespace App;

class Imap
{
    /**
     * @var string
     */
    private $server;

    /**
     * @var string
     */
    private $ref;


    public function __construct($server, $ref)
    {
        $this->server = $server;
        $this->ref = $ref;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return array $array
     */
    public function runImap($email, $password)
    {
        /**
         * Connect to imap server
         */
        $stream = imap_open($this->server, $email, $password) or die('Cannot connect to ' . str_replace(['{', '}'], '', $this->server) . ': ' . imap_last_error());
        //var_dump(imap_search($stream, 'ALL'));
        $boxes = imap_list($stream, $this->ref, '*');
        $array = [];
        foreach ($boxes as $box) {
            $array[] = ['label' => str_replace($this->ref, '', $box), 'status' => $this->getStatus($stream, $box)];
        }
        imap_close($stream);
        return $array;
    }

    /**
     * @param $stream
     * @param $box
     * @return object
     */
    public function getStatus($stream, $box)
    {
        return imap_status($stream, $box, SA_ALL);
    }

    /**
     * @param $box
     * @return array
     */
    public function getBoxContent($box)
    {
        $stream = imap_open($this->server . $box, $_SESSION['email'], $_SESSION['password']) or die('Cannot connect ' . str_replace(['{', '}'], '', $this->server . $box) . ': ' . imap_last_error());
        $emails = imap_search($stream, 'ALL');
        $output = [];
        if ($emails) {
            // put the newest emails on top
            rsort($emails);
            // for every email...
            foreach ($emails as $key => $email_number) {
                //get email headers
                $overview = imap_fetch_overview($stream, "1:{$email_number}", 0);

                //get email message all format
                var_dump('email number',$email_number);
                $structure = imap_fetchstructure($stream, $email_number);
                var_dump('structure type',$structure->type);
                $bodystruc = imap_bodystruct($stream, $email_number,1);
                var_dump('body struc',$bodystruc);
                $message = imap_fetchbody($stream, $email_number,1.1);
                var_dump('message content',$message);
//                $message = imap_body($stream, $email_number,0);
                //$message = '';
                $output[] = ['overview' => $overview[0], 'message' => $message];
            }
        }
        imap_close($stream);
        return $output;
    }
}