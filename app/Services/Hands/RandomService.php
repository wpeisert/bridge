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

    public function shuffle(array $set): array
    {
        $count = count($set);
        if (!$count) {
            return [];
        }

        $perm = $this->getRandomPermutation($count);

        return $this->applyPermutation($perm, $set);
    }

    /**
     * @param array $perm
     * @param array $set
     * @return array
     * @throws \Exception
     */
    public function applyPermutation(array $perm, array $set): array
    {
        if (count($set) !== count($perm)) {
            throw new \Exception(
                sprintf("Permutation and set sizes differs. count(set)=%d  count(perm)=%d", count($set), count($perm))
            );
        }

        $newSet = [];
        $count = count($perm);
        for ($iter = 0; $iter < $count; ++$iter) {
            $newSet[$iter] = $set[$perm[$iter]];
        }

        return $newSet;
    }
}
