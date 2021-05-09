<?php

namespace ChatManager\Yugh\utils;

use pocketmine\utils\Config;

class Messages {

	private $plugin;

	private $messages;

	public function __construct($plugin) {
		$this->plugin = $plugin;
		$this->loadConfig();
	}

	private function loadConfig() :void {
		$this->messages = new Config($this->plugin->getFolder() ."resources/messages.yml", Config::YAML);
	}

	public function getMessage(string $key) {
		return $this->messages->get($key);
	}
}