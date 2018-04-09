<?php
namespace App\mail;
/**
 * summary
 */
class MailHelper
{
	private $to = '';
    private $subject = '';
    private $msg = '';
    private $headers = 'From: contact@turedu.com \r\nReturn-Path: contact@turedu.com';

    
    /**
     * summary
     */
    public function __construct($to, $subject, $msg)
    {
     	$this->to =	$to;
     	$this->subject = $subject;
     	$this->msg = $msg;
    }

    public function send()
    {
    	mail($this->to,$this->subject,$this->msg,$this->headers);
    }
}