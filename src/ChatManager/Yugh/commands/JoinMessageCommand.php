<?php

namespace ChatManager\Yugh\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class JoinMessageCommand extends Command {

    private $plugin;

    public function __construct($plugin, string $command, string $description) {
        $this->plugin = $plugin;

        parent::__construct($command, $description);
        $this->setPermission("join.message.command");
    }

    public function execute(CommandSender $sender, string $label, array $args) : bool {
        $messages = $this->plugin->messages->getMessage("join-message-command");

        if (count($args) >= 1) {
            $message = implode(" ", $args);

            $this->setJoinMessage(strtolower($sender->getName()), $message);
            $sender->sendMessage($messages["confirm"]);
        } else $sender->sendMessage($messages["not-confirm"]);

        return true;
    }

    private function setJoinMessage(string $name, string $message) :void {
        $this->plugin->config->set($name, [
            "join-message" => $message
        ]);

        $this->plugin->config->save();
    }

    private function getJoinMessage(string $name) :string {
        $config = $this->plugin->config->get($name);

        return $config["join-message"];
    }
}
