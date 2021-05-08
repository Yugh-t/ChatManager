<?php 

namespace ChatManager\Yugh\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventListener implements Listener {
  
  private $plugin;
  
  public function __construct($plugin) {
    $this->plugin = $plugin;
  }
  
  public function onChat(PlayerChatEvent $event) :void {
    $player = $event->getPlayer();
    $players = $player->getLevel()->getPlayers();
    
    $distance = $this->plugin->config->get("distance");
    
    foreach ($players as $ps) {
      if ($ps->distance($player) <= $distance) {
        $event->setCancelled(true);

        $message = $event->getMessage();
        $ps->sendMessage("[".$player->getName()."] "$message);
      }
    }
  }
  
}
