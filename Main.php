<?php
namespace Walls;

    /*
     * This place is for placing 'use' code
     * (But I don't know to use which!!= =)
     */
use pocketmine\Server;
use pocketmine\tile\Sign;                    //Process Sign Text
use pocketmine\plugin\PluginBase; //???
use pocketmine\level\format\SimpleChunk; //Process spawn location (X,Y,Z）
use pocketmine\command\Command; //Get command(Maybe?)
use pocketmine\command\CommandExecutor; //Run the command
use pocketmine\command\CommandSender; //??Maybe the same as Command Executor
use pocketmine\event\block\BlockBreakEvent; //Maybe the player will break the bedrock before killing time starts.Use this to prevent it(Event)
use pocketmine\event\player\PlayerDeathEvent; //Process when the players were killed(Nevertheless,it can prevent players from killing by others before killing time starts)
use pocketmine\event\entity\EntityMoveEvent; //Prevent players from entering to other groups before killing time starts
use pocketmine\event\entity\EntityTeleportEvent; //Prevent op from tping to other groups before killing time starts(MAY NOT WORK!)
use pocketmine\event\player\PlayerCommandPreprocessEvent; //Process the command before it runs in order to prevent players doing sth. nasty
use pocketmine\event\player\PlayerGameModeChangeEvent; //Prevent players changes GameMode when in gaming
use pocketmine\event\player\PlayerQuitEvent; //Process sth. when players quit in gaming
use pocketmine\event\player\PlayerRespawnEvent; //Prevent players from entering gaming places again
use pocketmine\event\player\PlayerInteractEvent; //Touch signs
use pocketmine\utils\TextFormat; //Change the colour
use pocketmine\inventory\PlayerInventory; //Change the players' armors
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
//use pocketmine\inventory\PlayerInventory;
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
    protected $sign;
    protected $gamemanager=array();
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
 * 1.$gamemanager[$gameid]=array(<countgreen>,<countyellow>,<countred>,<countblue>,<started?[true=1,false=2]>,<GetReady?[true=1,false=2]>);
 */
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
                    $sender->sendMessage("[Walls]The Wall is running...");
                }
                else{
                    $sender->sendMessage(TextFormat::RED . "[Walls]Please run the command in game");
                }
                //MOTD:Add codes to process.
                break;
            case "wallsArmor":
                if($sender instanceof Player){
                    if(isset($args[0])){
                        $sender->sendMessage(TextFormat::RED . "Usage:/wallsArmor <type>");
                    }
                    else{
                        if($args[0]="chain"){
                            //$player=$sender->getPlayer();
                            $apple[]=new Item(302,303,304,305);
                            $sender->getInventory()->setArmorContents($apple);
                        }
                        else if($args[0]="leather"){
                            $apple[]=new Item(298,299,300,301);
                            $sender->getInventory()->setArmorContents($apple);
                        }
                        else if($args[0]="gold"){
                            $apple[]=new Item(314,315,316,317);
                            $sender->getInventory()->setArmorContents($apple);
                        }
                        else if($args[0]="iron"){
                            $apple[]=new Item(306,307,308,309);
                            $sender->getInventory()->setArmorContents($apple);
                        }
                        else if($args[0]="diamond"){
                            $apple[]=new Item(310,311,312,313);
                            $sender->getInventory()->setArmorContents($apple);
                        }
                    }
                    //Needs Analysis
                }
                else{
                    $sender->sendMessage(TextFormat::RED . "[Walls]Please run the command in game");
                }
                break;
            case "wallsBuildArena":
                if($sender instanceof Player){
                    
                    //Needs Analysis
                    else{
                        $sender->sendMessage(TextFormat::RED . "[Walls]Please run the command in game");
                    }
                }
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
    public function playerBlockTouch(PlayerInteractEvent $event){//Touch the sign
        //When players touched the sign it called
        $player = $event->getPlayer();
        $playerName=$player->getName();
        $block = $event->getBlock()->getID();
        if (isset($block)) {
            if($block == 323 || $block == 63 || $block == 68){
                $x= $event->getBlock()->getX();
                $y= $event->getBlock()->getY();
                $z= $event->getBlock()->getZ();
                //Get Sign ID
                $world = $event->getBlock()->getLevel()->getName();
                $allstring = $x.":".$y.":".$z.":".$world;
                if($this->sign->exists($allstring)){
                    if($player->gamemode!=0){
                        $player->sendMessage("You can't join the game due to gamemode.");
                    }
                    else{
                        $gameid=$this->sign->get($allstring)['gameid'];
                        $location=new Vector3($this->sign->get($allstring)['startX'],$this->sign->get($allstring)['startY'],$this->sign->get($allstring)['startZ']);
                        $player->sendMessage("You have joined the game.Please place the block in order to choose group.");
                        $player->getInventory()->clearAll();
                        $player->getInventory()->addItem(19,45,2,57);
                        $this->joinedplayers[$playerName]=array('GroupID'=>0,'SignID'=>0,'GameID'=>$gameid,'Killed'=>0,'Quited'=>0,'Ready'=>1);
                        $player->teleport($location);//TP COMMAND!!!!!!

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
     * 1.Need MODIFY!$joinedplayers[<player>]=array(<Group ID>,<Sign ID>,<Killed?[true=1,false=0]>,<Quit?[true=1,false=0]>,<Ready?[FullyTrue=2,true=1,false=0]>)
      * 2.plugin main area!Coding carefully!
     */
                    //type codes(Join the game)
                }
                }

            }
            }
        }
    public function onBlockPlace(BlockPlaceEvent $event){
        $player=$event->getPlayer();
    $playerName=$player->getName();
        $block=$event->getBlock()->getID();
        $x= $event->getBlock()->getX();
        $y= $event->getBlock()->getY();
        $z= $event->getBlock()->getZ();
        $world = $event->getBlock()->getLevel()->getName();
        $allString = $x.":".$y.":".$z.":".$world;
        $gameID=$this->sign->get($allString)['gameid'];
        if (isset($blockid)) {
            if($block ===19 || $block===45 || $block ===2 || $block === 57){
                foreach($this->joinedplayers as $key=>$value){
                    if(strcmp($key,$player)==0){
                        //$blockid=$event->getBlock();
                        $this->joinedplayers[$playerName]=array('GroupID'=>$block,'SignID'=>0,'GameID'=>$gameID,'Killed'=>0,'Quited'=>0,'Ready'=>2);
                        if($block ===19){
                            //if($this->gamemanager[])
                                $player->sendMessage(TextFormat::YELLOW,"[Walls]You have joined YELLOW Group");
                            $event->setCancelled();
                            //$blockid->onBreak();
                        }
                        else if($block ===45){
                            $player->sendMessage(TextFormat::RED,"[Walls]You have joined RED Group");
                            $event->setCancelled();
                        }
                        else if($block === 2){
                            $player->sendMessage(TextFormat::GREEN,"[Walls]You have joined GREEN Group");
                            $event->setCancelled();
                        }
                        else{
                            $player->sendMessage(TextFormat::BLUE,"[Walls]You have joined BLUE Group");
                            $event->setCancelled();
                        }
                    }
                }
        }

        }
    }
    public function playerDestroyBlocks(BlockBreakEvent $event){
        $player=$event->getPlayer();
        $playername=$player->getName();
        $block=$event->getBlock()->getID();
        if(isset($block)){
            foreach($this->joinedplayers as $key=>$id){
                if($playername==$key){
                    if($this->joinedplayers[$playername]['Ready']==1 or 2){
                        $event->setCancelled();
                    }
                }
            }
            if($block == 323 || $block == 63 || $block == 68){
                $x=$event->getBlock()->getX();
                $y=$event->getBlock()->getY();
                $z=$event->getBlock()->getZ();
                $world=$event->getBlock()->getLevel()->getName();
                $allstring = $x.":".$y.":".$z.":".$world;
                if($this->sign->exists($allstring)){
                    if($player->isOp()){

                        //if($this->gamemanager[])
                        Server::getInstance()->broadcastMessage("[Walls]OP ".$playername."has destroyed the sign which in the world ".$world." in (".$x.",".$y.",".$z.").");
                    }
                }
            }
        }
    }
    public function wallFall(int $gameid){
        if($this->gamemanager[$gameid]==0){
            Server::getInstance()->broadcastMessage("[Walls]Error!The game id".$gameid."didn't seem like to be running!");
        }
    }
}