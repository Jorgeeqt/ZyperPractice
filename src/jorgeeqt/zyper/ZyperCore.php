<?php

namespace jorgeeqt\zyper;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\Config;

class ZyperCore extends PluginBase {
  
  private static ?ZyperCore $instance;
  
  public function onEnable(): void {
    self::$instance = $this;
    
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("spawn_world"));
