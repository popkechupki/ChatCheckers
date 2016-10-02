<?php

namespace CoSSeSystem;

/*
Cosmo Sunrise Server's Anti$Spam Chat Bloc System.
Development start date: 2016/10/01

このプラグインはpopke LISENCEを理解および同意した上で使用する事。
また、無駄なコードはことごとく排除するよう書く事を心がける事。
*/

/*use文*/
//default
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\plugin\PluginBase;
//event
use pocketmine\event\player\PlayerChatEvent;
//command
use pocketmine\command\{Command, CommandSender};

class ChatCheckers extends PluginBase implements Listener{

  private $CheckWords = array("spam", "ヘイブン", "h.t");

  const MESSAGE_TITLE = "[".TF::RED."ChatCheckers".TF::WHITE."]"."\n";

	function onEnable(){
    $this->getLogger()->info(TF::GREEN."ChatCheckers is Enabled!");
    $this->getServer()->getPluginManager()->registerEvents($this,$this);
  }

  function onChat(PlayerChatEvent $event){
    $name = $event->getPlayer()->getName();
    $message = $event->getMessage();
    $search = $this->CheckWords;
    if (in_array(mb_strtolower($message), $search)) {
      $event->setCancelled();
      $this->getServer()->broadcastmessage(self::MESSAGE_TITLE."-With use of banned words."."\n"."-UserID: ".TF::YELLOW.$name.TF::WHITE." , Word: xxx");
    }
  }

  function onCommand(CommandSender $sender, Command $command, $label, array $args){

  }

}
