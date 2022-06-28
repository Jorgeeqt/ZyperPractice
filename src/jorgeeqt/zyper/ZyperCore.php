<?php

namespace jorgeeqt\zyper;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\Config;

class ZyperCore extends PluginBase {
  
  private static ?ZyperCore $instance;
  private SessionManager $sessionManager;
  
  public function onEnable(): void {
    self::$instance = $this;
    self::$sessionManager = new SessionManager();
    
    $this->getServer()->getPluginManager()->registerEvents(new EventManager($this), $this));
    
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("spawn_world"));
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("nodebuff_world"));
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("gapple_world"));
    $this->getServer()->getWorldManager()->loadWorld($this->getConfig()->get("combo_world"));
    
    $this->getServer()->getNetwork()->setName(TextFormat::colorize($this->getConfig()->get("server_motd"));
    
    $this->getScheduler()->scheduleRepeatingTask(new ScoreboardTask($this), 10);
                                              
    $this->scoreboard = new Scoreboard();
                                
   
    $this->getServer()->getCommandMap()->register("hub" new Hub($this));
    $this->getServer()->getCommandMap()->register("ping" new Ping($this));
    $this->getServer()->getCommandMap()->register("rekit" new ReKit($this));
  }                    
                                              
