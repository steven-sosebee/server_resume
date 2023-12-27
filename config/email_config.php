<?php
$config = parse_ini_file(__DIR__.'/../../private/config.ini');
// define("EMAIL_HOST",$config['email_host']);
// define("EMAIL_HOST",'mail.stevenwsosebee.com');
// define("EMAIL_FROM",'steven@stevenwsosebee.com');
// define("EMAIL_FROM",$config['email_from']);
// define("EMAIL_PASSWORD",'Ssas0213$');
define("EMAIL_PASSWORD",$config['email_password']);
// define("EMAIL_PORT", $config['email_port']);
define("IMAP_PORT", $config['imap_port']);
define("IMAP_HOST", $config['imap_host']);
$email_account = 'steven@stevenwsosebee.com';

$mbox = imap_open("{".IMAP_HOST."/imap/ssl}INBOX", $email_account, EMAIL_PASSWORD)
     or die("can't connect: " . imap_last_error());

if($mbox)
     {
        $MC = imap_check($mbox);
        // echo "Connected\n";
        $mails = imap_fetch_overview($mbox, "1:{$MC->Nmsgs}",0);
        $return = [];
        foreach($mails as $folder){
            // echo json_encode($folder);
            if($folder->seen){
                $header = mb_decode_mimeheader($folder->subject);
                $return[] = "{$header} - {$folder->seen}";
        };
            }
        echo json_encode($return);
        
        imap_close($mbox);
       } else
       {
        echo json_encode("FAIL!");
       }

?>