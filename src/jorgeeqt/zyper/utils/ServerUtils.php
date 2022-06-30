<?php

namespace jorgeeqt\zyper\utils;

use pocketmine\Server;
use pocketmine\player\{Player, GameMode};
use pocketmine\item\{VanillaItems, ItemFactory, ItemIds};

class ServerUtils {
  
  static public function transferToSpawn(Player $player): void {
    $player->getInventory()->clearAll();
    $player->getArmorInventory()->clearAll();
    $player->getEffects()->clear();
    $player->setGamemode(GameMode::ADVENTURE());
    ZyperCore::getInstace()->getWorldHandler()->teleportSpawn($player);
    ZyperCore::getInstance()->getItemManager()->addLobbyItems($player);
  }
  
  static public function playSound(Player $player, string $soundName, float $volume = 1.0, float $pitch = 1.0){
    $pk = new PlaySoundPacket();
    $pk->soundName =  $soundName;
    $pk->x = (int)$player->getLocation()->asVector3()->getX();
    $pk->y = (int)$player->getLocation()->asVector3()->getY();
    $pk->z = (int)$player->getLocation()->asVector3()->getZ();
    $pk->volume = $volume;
    $pk->pitch = $pitch:
    $player->getNetworkSession->sendDataPacket($pk);
  }
}
?>
