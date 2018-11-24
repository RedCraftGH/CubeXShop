<?php

namespace RedCraftPE;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\item\Item;
use pocketmine\Player;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;

class Shop extends PluginBase implements Listener {

  public $blocks = Array(
    "10 3 0 1"
  );
  public $valuables = Array(

  );
  public $tools = Array(

  );
  public $farming = Array(

  );
  public $foods = Array(

  );
  public $drops = Array(

  );
  public $spawners = Array(

  );
  public $miscs = Array(

  );

  public function onEnable(): void {

    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    //Other things below here if needed...prolly not:
  }
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

    switch(strtolower($command->getName())) {

      case "shop":

        $this->openShop($sender);
        return true;
      break;
    }
    return false;
  }
  public function openShop($player) {

    $shopHome = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("CubeX Shop")
      ->setListener([$this, "shopHomeListener"]);

    $shopHomeInv = $shopHome->getInventory();
    //$shopHomeInv->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    //$shopHomeInv->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    //$shopHomeInv->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));

    $shopHomeInv->setItem(10, Item::get(241, 5, 1)->setCustomName(TextFormat::DARK_GREEN . "Blocks"));
    $shopHomeInv->setItem(12, Item::get(345, 0, 1)->setCustomName(TextFormat::AQUA . "Valuable"));
    $shopHomeInv->setItem(14, Item::get(241, 14, 1)->setCustomName(TextFormat::YELLOW . "Tools"));
    $shopHomeInv->setItem(16, Item::get(241, 5, 1)->setCustomName(TextFormat::GREEN . "Farming"));
    $shopHomeInv->setItem(28, Item::get(345, 0, 1)->setCustomName(TextFormat::GOLD . "Food"));
    $shopHomeInv->setItem(30, Item::get(241, 14, 1)->setCustomName(TextFormat::RED . "Mob Drops"));
    $shopHomeInv->setItem(32, Item::get(241, 5, 1)->setCustomName(TextFormat::GRAY . "Spawners"));
    $shopHomeInv->setItem(34, Item::get(345, 0, 1)->setCustomName(TextFormat::WHITE . "Miscellaneous"));
    $shopHome->send($player);
  }
  public function shopHomeListener(Player $player, Item $item) {

    if ($item->getName() === TextFormat::DARK_GREEN . "Blocks") {

      $this->sendBlocks($player);
    } else if ($item->getName() === TextFormat::AQUA . "Valuable") {

      $this->sendValuable($player);
    } else if ($item->getName() === TextFormat::YELLOW . "Tools") {

      $this->sendTools($player);
    } else if ($item->getName() === TextFormat::GREEN . "Farming") {

      $this->sendFarming($player);
    } else if ($item->getName() === TextFormat::GOLD . "Food") {

      $this->sendFood($player);
    } else if ($item->getName() === TextFormat::RED . "Mob Drops") {

      $this->sendDrops($player);
    } else if ($item->getName() === TextFormat::GRAY . "Spawners") {

      $this->sendSpawners($player);
    } else if ($item->getName() === TextFormat::WHITE . "Miscellaneous") {

      $this->sendMisc($player);
    }
  }
  public function sendBlocks(Player $player) {

    $shopBlocks = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Blocks Shop")
      ->setListener([$this, "blocksListener"]);

    $shopBlocksInventory = $shopBlocks->getInventory();
    foreach ($blocks as $block) {

      $blockArray = explode(" ", $block);
      $blockPrice = $blockArray[0];
      $blockID = $blockArray[1];
      $blockDamage = $blockArray[2];
      $blockCount = $blockArray[3];

      $shopBlocksInventory->addItem(Item::get($blockID, $blockDamage, $blockCount)->setLore(Array("$" . $blockPrice)));
    }
    $shopBlocksInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopBlocksInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopBlocksInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopBlocks->send($player);
  }
  public function sendValuable(Player $player) {

    $shopValuable = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Valuable Shop")
      ->setListener([$this, "valuableListener"]);

      $shopValuableInventory = $shopValuable->getInventory();
      foreach ($valuables as $valuable) {

        $valuableArray = explode(" ", $valuable);
        $valuablePrice = $valuableArray[0];
        $valuableID = $valuableArray[1];
        $valuableDamage = $valuableArray[2];
        $valuableCount = $valuableArray[3];

        $shopValuableInventory->addItem(Item::get($valuableID, $valuableDamage, $valuableCount)->setLore(Array("$" . $valuablePrice)));
      }
    $shopValuableInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopValuableInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopValuableInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopValuable->send($player);
  }
  public function sendTools(Player $player) {

    $shopTools = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Tools Shop")
      ->setListener([$this, "toolsListener"]);

      $shopToolsInventory = $shopTools->getInventory();
      foreach ($tools as $tool) {

        $toolArray = explode(" ", $tool);
        $toolPrice = $toolArray[0];
        $toolID = $toolArray[1];
        $toolDamage = $toolArray[2];
        $toolCount = $toolArray[3];

        $shopToolsInventory->addItem(Item::get($toolID, $toolDamage, $toolCount)->setLore(Array("$" . $toolPrice)));
      }
    $shopToolsInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopToolsInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopToolsInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopTools->send($player);
  }
  public function sendFarming(Player $player) {

    $shopFarming = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Farming Shop")
      ->setListener([$this, "farmingListener"]);

      $shopFarmingInventory = $shopFarming->getInventory();
      foreach ($farming as $farm) {

        $farmArray = explode(" ", $farm);
        $farmPrice = $farmArray[0];
        $farmID = farmArray[1];
        $farmDamage = $farmArray[2];
        $farmCount = $farmArray[3];

        $shopFarmingInventory->addItem(Item::get($farmID, $farmDamage, $farmCount)->setLore(Array("$" . $farmPrice)));
      }
    $shopFarmingInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopFarmingInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopFarmingInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopFarming->send($player);
  }
  public function sendFood(Player $player) {

    $shopFood = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Food Shop")
      ->setListener([$this, "foodListener"]);

      $shopFoodInventory = $shopFood->getInventory();
      foreach ($foods as $food) {

        $foodArray = explode(" ", $food);
        $foodPrice = $foodArray[0];
        $foodID = $foodArray[1];
        $foodDamage = $foodArray[2];
        $foodCount = $foodArray[3];

        $shopFoodInventory->addItem(Item::get($foodID, $foodDamage, $foodCount)->setLore(Array("$" . $foodPrice)));
      }
    $shopFoodInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopFoodInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopFoodInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopFood->send($player);
  }
  public function sendDrops(Player $player) {

    $shopDrops = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Drops Shop")
      ->setListener([$this, "dropsListener"]);

      $shopDropsInventory = $shopDrops->getInventory();
      foreach ($drops as $drop) {

        $dropArray = explode(" ", $drop);
        $dropPrice = $dropArray[0];
        $dropID = $dropArray[1];
        $dropDamage = $dropArray[2];
        $dropCount = $dropArray[3];

        $shopDropsInventory->addItem(Item::get($dropID, $dropDamage, $dropCount)->setLore(Array("$" . $dropPrice)));
      }
    $shopDropsInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopDropsInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopDropsInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopDrops->send($player);
  }
  public function sendSpawners(Player $player) {

    $shopSpawners = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Spawners Shop")
      ->setListener([$this, "spawnersListener"]);

      $shopSpawnersInventory = $shopSpawners->getInventory();
      foreach ($spawners as $spawner) {

        $spawnerArray = explode(" ", $spawner);
        $spawnerPrice = $spawnerArray[0];
        $spawnerID = $spawnerArray[1];
        $spawnerDamage = $spawnerArray[2];
        $spawnerCount = $spawnerArray[3];

        $shopSpawnersInventory->addItem(Item::get($spawnerID, $spawnerDamage, $spawnerCount)->setLore(Array("$" . $spawnerPrice)));
      }
    $shopSpawnersInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopSpawnersInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopSpawnersInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopSpawners->send($player);
  }
  public function sendMisc(Player $player) {

    $shopMisc = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST)
      ->readOnly()
      ->setName("Misc Shop")
      ->setListener([$this, "miscListener"]);

      $shopMiscInventory = $shopMisc->getInventory();
      foreach ($miscs as $misc) {

        $miscArray = explode(" ", $misc);
        $miscPrice = $miscArray[0];
        $miscID = $miscArray[1];
        $miscDamage = $miscArray[2];
        $miscCount = $miscArray[3];

        $shopMiscInventory->addItem(Item::get($miscID, $miscDamage, $miscCount)->setLore(Array("$" . $miscPrice)));
      }
    $shopMiscInventory->setItem(48, Item::get(241, 5, 1)->setCustomName(TextFormat::RED . "Back"));
    $shopMiscInventory->setItem(49, Item::get(345, 0, 1)->setCustomName(TextFormat::GRAY . "Home"));
    $shopMiscInventory->setItem(50, Item::get(241, 14, 1)->setCustomName(TextFormat::GREEN . "Next"));
    $shopMisc->send($player);
  }
  public function blocksListener(Player $player, Item $item) {


  }
  public function valuableListener(Player $player, Item $item) {


  }
  public function toolsListener(Player $player, Item $item) {


  }
  public function farmingListener(Player $player, Item $item) {


  }
  public function foodListener(Player $player, Item $item) {


  }
  public function dropsListener(Player $player, Item $item) {


  }
  public function spawnersListener(Player $player, Item $item) {


  }
  public function miscListener(Player $player, Item $item) {


  }
}
