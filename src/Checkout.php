<?php

class Checkout {
    private $pricingRules;
    private $items;

    public function __construct($pricingRules) {
        $this->pricingRules = $pricingRules;
        $this->items = [];
    }

    public function scan($sku) {
        if (!isset($this->items[$sku])) {
            $this->items[$sku] = 0;
        }
        $this->items[$sku]++;
    }

    public function total() {
        $total = 0;
        $mealDealCount = 0;

        foreach ($this->items as $sku => $count) {
            $item = $this->pricingRules[$sku];
            if ($item->specialPrice) {
                if ($item->specialPrice['type'] == 'meal_deal') {
                    $mealDealCount += $count;
                } else {
                    $total += $this->applySpecialPrice($item, $count);
                }
            } else {
                $total += $item->getPrice() * $count;
            }
        }

        if ($mealDealCount > 0) {
            $total += $this->applyMealDeal($mealDealCount);
        }

        return $total / 100;
    }

    private function applySpecialPrice($item, $count) {
        switch ($item->specialPrice['type']) {
            case 'multipriced':
                $n = $item->specialPrice['n'];
                $y = $item->specialPrice['price'];
                $total = intdiv($count, $n) * $y + ($count % $n) * $item->getPrice();
                break;
            case 'buy_n_get_1_free':
                $n = $item->specialPrice['n'];
                $total = (intdiv($count, $n + 1) * $n + $count % ($n + 1)) * $item->getPrice();
                break;
            case 'meal_deal':
                $total = $count * $item->getPrice();
                break;
            default:
                $total = $item->getPrice() * $count;
        }

        return $total;
    }
    private function applyMealDeal($count) {
        // Assuming the meal deal is D and E together for £3
        $dCount = $this->items['D'] ?? 0;
        $eCount = $this->items['E'] ?? 0;
        $mealDealCount = min($dCount, $eCount);
        $remainingD = $dCount - $mealDealCount;
        $remainingE = $eCount - $mealDealCount;

        return $mealDealCount * 300 + $remainingD * $this->pricingRules['D']->getPrice() + $remainingE * $this->pricingRules['E']->getPrice();
    }

}
