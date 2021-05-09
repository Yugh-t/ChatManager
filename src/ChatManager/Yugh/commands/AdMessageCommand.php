<?php

namespace ChatManager\Yugh\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class AdMessageCommand extends Command {

    private $plugin;

    public function __construct($plugin, string $command, string $description) {
        $this->plugin = $plugin;

        parent::__construct($command, $description);
        $this->setPermission("ad.message.command");
    }

    public function execute(CommandSender $sender, string $label, array $args) : bool {
        $messages = $this->plugin->messages->getMessage("ad-message-command");

        if (count($args) >= 1) {
            $message = implode(" ", $args);

            $format = $messages["send-format"];
            $format = str_replace("{ad}", "Объявление", $format);
            $format = str_replace("{message}", $message, $format);
            $format = str_replace("{name}", $sender->getName(), $format);
            $format = str_replace("{sender}", "Отправитель", $format);

            $this->plugin->getServer()->broadcastMessage($format);
        } else $sender->sendMessage($messages["not-confirm"]);

        return true;
    }
}
