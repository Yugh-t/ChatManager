<?php 

namespace ChatManager\Yugh\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener {
  
  private $plugin;
  
  public static function create($plugin) {
    return new self($plugin);
  }
  
  public function onChat(PlayerChatEvent $event) :void {
    $player = $event->getPlayer();
    $players = $player->getLevel()->getPlayers();
    
    $distance = $this->plugin->config->get("distance");
    
    foreach ($players as $ps) {
      if ($ps->distance($player) <= $distance) {
        $message = $event->getMessage();
        $ps->sendMessage($message);
      }
    }
  }
  
}
