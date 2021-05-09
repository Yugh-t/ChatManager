<?php 

namespace ChatManager\Yugh;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

use ChatManager\Yugh\listener\EventListener;
use ChatManager\Yugh\utils\Messages;

use ChatManager\Yugh\commands\PrivateMessageCommand;
use ChatManager\Yugh\commands\JoinMessageCommand;
use ChatManager\Yugh\commands\AdMessageCommand;

class ChatManager extends PluginBase {
  
    private const DISTANCE = 20;
    
    public $config;

    public $messages;
    
    public function onEnable() :void {
        $this->config = new Config($this->getDataFolder(). "config.json", Config::JSON);
        $this->loadConfig();

        $this->messages = new Messages($this);

        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

    }

    public function onLoad() :void {
        $this->registerCommands();
    }
    
    private function loadConfig() :void {
        if (!$this->config->exists("distance")) $this->config->set("distance", self::DISTANCE);

        $this->config->save();
    }

    private function registerCommands() :void {
        $map = $this->getServer()->getCommandMap();

        $commands = [
            new PrivateMessageCommand($this, "pm", "личное сообщение"),
            new JoinMessageCommand($this, "join", "сообщение при входе"),
            new AdMessageCommand($this, "ad", "объявление")
        ];

        foreach ($commands as $command) {
            $map->register("ChatManager", $command);
        }
    }

    public function getFolder() :string {
        return $this->getFile();
    }
  
}
