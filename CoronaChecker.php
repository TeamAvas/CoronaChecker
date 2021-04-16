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

    private const ACCESSOR_KEY = '';

    protected function onEnable(): void{
        if (trim(self::ACCESSOR_KEY) === '') {
            $this->getServer()->getPluginManager()->disablePlugin($this);
            return;
        }

        if (($result = Internet::getURL("http://api.corona-19.kr/korea/?serviceKey=" . self::ACCESSOR_KEY))) {
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
