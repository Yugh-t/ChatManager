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
    if (count($args) > 1) {
      $player = $this->plugin->getServer()->getPlayer($args[0]);
      $name = $args[0];

      array_shift($args);

      if (!is_null($player)) {
        if ($name != $sender->getName()) {
          $message = implode(" ", $args);
          $player->sendMessage("[".$sender->getName()." --> ".$name."] ".$message);
        } else $sender->sendMessage("Ты не можешь отправить сообщение себе!");
      } else $sender->sendMessage("Игрок не найден!");
    } else $sender->sendMessage("/pm [Игрок] [сообщение]");

    return true;
  }

}
