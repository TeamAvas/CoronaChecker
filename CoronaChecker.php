<?php

/**
 * @name CoronaChcker
 * @main skh6075\coronachecker\CoronaChecker
 * @author AvasKr
 * @version 1.0.0
 * @api 4.0.0
 */

namespace skh6075\coronachecker;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Internet;
use pocketmine\utils\SingletonTrait;

final class CoronaChecker extends PluginBase{
    use SingletonTrait;

    protected function onEnable(): void{
        if (($result = Internet::getURL("http://api.corona-19.kr/korea/?serviceKey=e487d21cec16833f4f6d218dfb7d11b63"))) {
            $this->getLogger()->notice("==========================================");
            $json = json_decode($result->getBody(), true);
            foreach ($json as $key => $value) {
                if (strpos($key, "city") !== false)
                    continue;

                $res[] = "* {$key} : " . $value;
                $this->getLogger()->notice("* " . $key . "  :  " . $value);
            }

            $this->getLogger()->notice("==========================================");
        }
    }
}