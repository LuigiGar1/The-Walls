<?php
namespace Walls;

    /*
     * This place is for placing 'use' code
     * (But I don't know to use which!!= =)
     */
use pocketmine\tile\Sign //Process Sign Text
use pocketmine\plugin\PluginBase; //???
use pocketmine\level\format\SimpleChunk //Process spawn location (X,Y,Z）
use pocketmine\command\Command; //Get command(Maybe?)
use pocketmine\command\CommandExecutor; //Run the command
use pocketmine\command\CommandSender; //??Maybe the same as Command Executor
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\ConsoleCommandExecutor;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
/*
 *             ∧
 *            /  \
 *           /    \    .
 *          /      \
 *         /  |▔|  \
 *        /   |  |   \
 *       /    |  |    \
 *      /     |▁|     \
 *     /       __       \
 *    /       |__|       \
 *   /                    \
 *  ------------------------
 * 1.These are copied so that you need to MODIFY it!!
 * 2.PHPStorm seems to be not included PocketMine-MP API,FIX!（FIXED）
 */
class Main extends PluginBase implements Listener, CommandExecutor{
    //This is where the program begins
    public function onEnable(){
        //Run codes while the plugin are getting ready
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("[Walls]Init Successfully！");
    }
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        //Command Handler
        switch($cmd->getName()){
            //Get entered CMD
            case "wall":
                if($sender instanceof Player){
                    //Get whether the user is console or not
                }
                else{
                    $sender->sendMessage(TextFormat::RED . "[Walls]Please run the command in game");
                }
                //MOTD:Add codes to process.
                break;
        }
    }
}