<?php

namespace ChatManager\Yugh\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class PrivateMessageCommand extends Command {

  private $plugin;

  public function __construct($plugin, string $command, string $description) {
    $this->plugin = $plugin;

    parent::__construct($command, $description);
    $this->setPermission("private.message.command");
  }

  public function execute(CommandSender $sender, string $label, array $args) :bool {
    $messages = $this->plugin->messages->getMessage("private-message-command");

  	if (count($args) > 1) {
  	  $player = $this->plugin->getServer()->getPlayer($args[0]);
  	  $name = $args[0];

  	  array_shift($args);

  	  if (!is_null($player)) {
  		  if ($name != strtolower($sender->getName())) {
  		    $message = implode(" ", $args);
          $format = $messages["send-format"];

          $format = str_replace("{sender}", $sender->getName(), $format);
          $format = str_replace("{player}", $name, $format);
          $format = str_replace("{message}", $message, $format);

  		    $player->sendMessage($format);
  		  } else $sender->sendMessage($messages["message-not-to-me"]);
  	  } else $sender->sendMessage($messages["player-not-found"]);
  	} else $sender->sendMessage($messages["not-confirm"]);

  	return true;
  }

}