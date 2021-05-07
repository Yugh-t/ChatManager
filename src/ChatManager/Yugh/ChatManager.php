<?php 

namespace ChatManager\Yugh;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use ChatManager\Yugh\listener\EventListener;

class ChatManager extends PluginBase {
  
  public $config;
  
  public function onEnable() :void {
    $this->config = new Config($this->getDataFolder(). "config.json", Config::JSON);
    $this->getServer()->getPluginManager()->registerEvents(EventListener::create, $this);
  }
}
