<?php
namespace Walls;

    /*
     * This place is for placing 'use' code
     * (But I don't know to use which!!= =)
     */
use pocketmine\tile\Sign;                    //Process Sign Text
use pocketmine\plugin\PluginBase; //???
use pocketmine\level\format\SimpleChunk; //Process spawn location (X,Y,Z）
use pocketmine\command\Command; //Get command(Maybe?)
use pocketmine\command\CommandExecutor; //Run the command
use pocketmine\command\CommandSender; //??Maybe the same as Command Executor
use pocketmine\event\block\BlockBreakEvent; //Maybe the player will break the bedrock before killing time starts.Use this to prevent it(Event)
use pocketmine\event\player\PlayerDeathEvent; //Process when the players were killed(Nevertheless,it can prevent players from killing by others before killing time starts)
use pocketmine\event\entity\EntityMoveEvent; //Prevent players from entering to other groups before killing time starts
use pocketmine\event\entity\EntityTeleportEvent; //Prevent op from tping to other groups before killing time starts
use pocketmine\event\player\PlayerCommandPreprocessEvent; //Process the command before it runs in order to prevent players doing sth. nasty
use pocketmine\event\player\PlayerGameModeChangeEvent; //Prevent players changes GameMode when in gaming
use pocketmine\event\player\PlayerQuitEvent; //Process sth. when players quit in gaming
use pocketmine\event\player\PlayerRespawnEvent; //Prevent players from entering gaming places again
use pocketmine\event\player\PlayerInteractEvent; //Touch signs
use pocketmine\utils\TextFormat; //Change the colour
use pocketmine\math\Vector3; //Use to tp
use pocketmine\command\ConsoleCommandSender;
//use pocketmine\command\ConsoleCommandExecutor;
use pocketmine\event\Listener; //Listen to event
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\Player; //IMPORTANT!
use pocketmine\utils\Config; //Config File
//use pocketmine\command\Command;
//use pocketmine\event\Listener;
//use pocketmine\Player;
//use pocketmine\plugin\PluginBase;
//use pocketmine\Server;
//use pocketmine\utils\TextFormat;
//use pocketmine\event\player\PlayerJoinEvent;
//use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
//use pocketmine\math\Vector3;
//use pocketmine\utils\Config;
use pocketmine\inventory\PlayerInventory;
use pocketmine\event\Event;
//use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
//use pocketmine\tile\Sign;
use pocketmine\nbt\tag\Compound;
use pocketmine\nbt\tag\String;
use pocketmine\nbt\tag\Int;
use pocketmine\tile\Tile;
//use pocketmine\level\Level;
use pocketmine\item\Block;
//use PocketMoney\PocketMoneyAPI;
use pocketmine\utils\Utils;
//use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\inventory\CraftingManager;
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
    protected $joinedplayers=array();
    //protected $sign;

    public function onEnable(){
        //Run codes while the plugin are getting ready
        $this->getServer()->getPluginManager()->registerEvents($this, $this);//Maybe it registers events?=_=
        $this->sign= new Config("./plugins/The walls/sign.yml", Config::YAML);
        $this->getLogger()->info("[Walls]Init Successfully！");

        //$joinedplayers=array();
    }
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        //Command Handler
        switch($cmd->getName()){
            //Get entered CMD
            case "wall":
                if($sender instanceof Player){
                    //Get whether the user is console or not
                    $sender->sendMessage(TextFormat::RED . "[Walls]The Walls is running...");
                }
                else{
                    $sender->sendMessage(TextFormat::RED . "[Walls]Please run the command in game");
                }
                //MOTD:Add codes to process.
                break;
            case "wallsArmor":
                if($sender instanceof Player){
                    if($args[0]="chain"){
                        $sender->
                    }
                }
                else{
                    $sender->sendMessage(TextFormat::RED . "[Walls]Please run the command in game");
                }
                break;
            case "wallsBuildArena":
                break;
            case "wallFall":
                break;
            case "wallsSetSpawn":
                break;
            case "wallsDelSpawn":
                break;
            case "wallsCreateArena":
                break;
            case "wallsArenas":
                break;
            case "wallsReloadArenas";
                break;
            case "wallsDelArena":
                break;
            case "wallsJoin":
                break;
            case "wallsReloadConfig":
                break;
            case "wallsSetReturnPos":
                break;
            case "wallsLeave":
                break;
            case "wallsEditArena":
                break;
            case "wallsPlayerList":
                break;
            case "wallsCreateSign":
                break;

        }
    }
    public function playerBlockTouch(PlayerInteractEvent $event){
        //When players touched the sign it called
        $player = $event->getPlayer();
        $playername=$player->getDisplayName();
        $block = $event->getBlock()->getID();
        if (isset($block)) {
            if($block == 323 || $block == 63 || $block == 68){
                $x= $event->getBlock()->getX();
                $y= $event->getBlock()->getY();
                $z= $event->getBlock()->getZ();
                //Get Sign ID
                $world = $event->getBlock()->getLevel();
                $allstring = $x.":".$y.":".$z.":".$world;
                if($this->sign->exists($allstring)){
                    $player->sendMessage("You have joined the game.Please place the block in order to choose group.");
                    $this->joinedplayers[$playername]=array(0,0,0,0);
                    //$player->teleport()//TP COMMAND!!!!!!

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
     * 1.Need MODIFY!$joinedplayers[<player>]=array(<Group ID>,<Sign ID>,<Killed?[true=1,false=0]>,<Quit?[true=1,false=0]>)
      * 2.plugin main area!Coding carefully!
     */
                    //type codes(Join the game)
                }

            }
            else if($block ===27 || $block===54 || $block ===2 || $block === 70){
                /*if(isset($joinedplayers[$player])){

                }*/
                foreach($this->joinedplayers as $key=>$value){
                    if(strcmp($key,$player)==0){
                        $this->joinedplayers[$playername]=array($block,0,0,0);
                        if($block ===27){
                        $player->sendMessage(TextFormat::YELLOW,"[Walls]You have joined YELLOW Group");
                    }
                        else if($block ===54){
                            $player->sendMessage(TextFormat::RED,"[Walls]You have joined RED Group");
                        }
                        else if($block === 2){
                            $player->sendMessage(TextFormat::GREEN,"[Walls]You have joined GREEN Group");
                        }
                        else{
                            $player->sendMessage(TextFormat::BLUE,"[Walls]You have joined BLUE Group");
                        }
                    }
                }
            }
        }
}
}