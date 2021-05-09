<?php 

namespace ChatManager\Yugh\listener;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;

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
                $ps->sendMessage("[".$player->getName()."] ".$message);
            }
        }
    }

    public function onJoin(PlayerJoinEvent $event) :void {
        $name = $event->getPlayer()->getName();

        if ($this->plugin->config->exists(strtolower($name))) {
            $config = $this->plugin->config->get(strtolower($name));
            $messages = $this->plugin->messages->getMessage("join-message-command");

            $format = $messages["send-format"];
            $format = str_replace("{name}", $name, $format);
            $format = str_replace("{message}", $config["join-message"], $format);

            $this->plugin->getServer()->broadcastMessage($format);
        }
    }
  
}
