<?php
namespace Walls;

use pocketmine\plugin\Plugin;
use pocketmine\scheduler\PluginTask;
use Pocketmine\server;
use Walls\Main;
//

class Timer extends PluginTask{
    public function onRun($currentTick){
        Server::getInstance()->broadcastMessage("");
    }
}