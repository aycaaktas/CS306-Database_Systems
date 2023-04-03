
<?php

	include "navbar.html";
	//You need to change this with your RealtimeDB url and add 'collection_name.json' to the end
	//In my case, my collection name is 'messages'
	//the resulting url is given below
    $URL = "https://cs306-b1a4e-default-rtdb.firebaseio.com/messages.json";

    function get_messages() { 
        global $URL;
        $ch = curl_init();
        curl_setopt_array($ch, [ CURLOPT_URL => $URL,
                                CURLOPT_POST => FALSE, // It will be a get request 
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_SSL_VERIFYPEER => false, ]);
        $response = curl_exec($ch); 
        curl_close($ch);
        return json_decode($response, true); 
    }
    $msg_res_json = get_messages();

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>


<ol class="chat">
<?php
	if($msg_res_json != null)
	{
		$keys = array_keys($msg_res_json);
		if($keys != null)
		{
			for ($i = 0; $i < count($keys); $i++){
				$chat_msg = $msg_res_json[$keys[$i]];
				$name = $chat_msg['name'];
				$msg = $chat_msg['msg'];
				$time = $chat_msg['time'];
				if ($name == 'admin') {
					$from = 'other';
				} else {
					$from = 'self';
				}
			   echo  '
			   <li class="'.$from.'">
			   <div class="avatar">
						<img src="https://i.imgur.com/DY6gND0.png" draggable="false"/>
					</div>
						<div class="msg">
							<p><b>'.$name.'</b></p>
							<p>'.$msg.'</p>
							<time>'.$time.'</time>
						</div>
					</li>';
			}
		}
	}
?>
</ol>
<form name="form" action = "send_message.php?sender=client" method="POST">
    <input name="usermsg" class="textarea" type="text" placeholder="Type here!"/>
    <input type="submit" style="display: none" />
</form>