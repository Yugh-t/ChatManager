<?php 

namespace ChatManager\Yugh;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use ChatManager\Yugh\listener\EventListener;

class ChatManager extends PluginBase {
  
  private const DISTANCE = 20;
  
  public $config;
  
  public function onEnable() :void {
    $this->config = new Config($this->getDataFolder(). "config.json", Config::JSON);
    $this->loadConfig();

    $this->getServer()->getPluginManager()->registerEvents(EventListener::create($this), $this);
  }
  
  private function loadConfig() :void {
    if (!$this->config->exists("distance")) $this->config->set("distance", self::DISTANCE);

    $this->config->save();
  }
  
}
