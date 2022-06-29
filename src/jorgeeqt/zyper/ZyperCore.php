<?php

namespace jorgeeqt\zyper;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\Config;

class ZyperCore extends PluginBase {
  
  private static ZyperCore $instance;
  
  public ?DataBase $db = null;
  public ?SessionManager $sessionManager = null;
  
  public static function getInstance(): ZyperCore
  {
    return self::$instance;
  }
  
  public function onLoad(): void 
  {
    $this->getServer()->getNetwork()->setName($this->getConfig()->get("server_motd"));
  }
  
  public function onEnable(): void {
    $this->sessionManager = new SessionManager($this);
    
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("nodebuff_world"));
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("sumo_world"));
    
    $this->getServer()->getCommandMap()->registerAll(Objects::NAME_SERVER, [
      new  Ping(),
      new ReKit(),
      new Spawn(),
    ]);
    
    //$this->db = libasynql::create($this, ["type" => "sqlite", "sqlite" => ["file" => $this->getDataFolder() . "sqlite.db"]], ["sqlite" => "sqlite.sql"]);
  }
}
