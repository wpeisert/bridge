<?php


namespace App\Services\Hands;


class RandomService
{
    public function getRandomPermutation(int $size): array
    {
        $arr = [];
        for ($iter = 0; $iter < $size; ++$iter) {
            $arr[] = ['value' => $iter, 'order' => rand()];
        }

        usort($arr, function ($a, $b) { return $a['order'] < $b['order']; });

        return array_map( function ($a) { return $a['value']; }, $arr );
    }
}
