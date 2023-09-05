<?php
date_default_timezone_set("Asia/Baghdad");
if (file_exists('madeline.php')){
    require_once 'madeline.php';
}
define('MADELINE_BRANCH', 'deprecated');
function bot($method, $datas = []){
    $token = file_get_contents("token");
    $url = "https://api.telegram.org/bot$token/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}
$settings['app_info']['api_id'] = 13167118;
$settings['app_info']['api_hash'] = '6927e2eb3bfcd393358f0996811441fd';
$MadelineProto = new \danog\MadelineProto\API('b.madeline',$settings);
$MadelineProto->start();
$info = json_decode(file_get_contents('info.json'),true);
$num = $info["number2"];
$x= file_get_contents('xb');
do{
file_put_contents('xb',$x++);
$info = json_decode(file_get_contents('in.json'),true);
$info["loop2"] = $x;
file_put_contents('in.json', json_encode($info));
$users = explode("\n",file_get_contents("u2"));
foreach($users as $user){
    $kd = strlen($user);
    if($user != ""){
    try{$MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
        $x++;
    }catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                try{$MadelineProto->account->updateUsername(['username'=>$user]);
                    bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "𓆩 We are the strongest @ss_sz !'\n⎱UserName: ❲ @$user ❳\n⎱ClickS: ❲ $x ❳\n⎱Save: ❲ Account ❳"]);
                    bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "𓆩 - Checker #2 New Caught ! 🐊'",]);
                    $data = str_replace("\n".$user,"", file_get_contents("u2"));
                    file_put_contents("u2", $data);
                }catch(Exception $e){
                    echo $e->getMessage();
                    if($e->getMessage() == "USERNAME_INVALID"){
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "╭ checker ❲ 2 ❳  \n | username is Band\n╰ Done Delet on list ↣ @$user",]);
                        $data = str_replace("\n".$user,"", file_get_contents("u2"));
                        file_put_contents("u2", $data);
                    }elseif($e->getMessage() == "This peer is not present in the internal peer database"){
                        $MadelineProto->account->updateUsername(['username'=>$user]);
                    }elseif($e->getMessage() == "USERNAME_OCCUPIED"){
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "╭ checker ❲ 2 ❳ 🛎 \n | username not save\n╰ FLood 1500 ↣ @$user",]);
                        $data = str_replace("\n".$user,"", file_get_contents("u2"));
                        file_put_contents("u2", $data);
                    }else{
                        bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' =>  "2 • Error @$user ".$e->getMessage()]);
                        $info = json_decode(file_get_contents('info.json'),true);
                        $info["num2"] = "delet";file_put_contents('info.json', json_encode($info));
                    }     
                }
            }
        } 
    }
  }while(1);