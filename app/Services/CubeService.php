<?php

namespace App\Services;

use App\Models\CubeData;
use Illuminate\Database\Eloquent\Builder;

class CubeService extends Constants
{
    /**
     * @return \array[][]
     */
    public function getInitialMatrix()
    {
        return [
            [
                'row1' => [
                    1 => parent::U,
                    2 => parent::U,
                    3 => parent::U
                ],
                'row2' => [
                    1 => parent::U,
                    2 => parent::U,
                    3 => parent::U
                ],
                'row3' => [
                    1 => parent::U,
                    2 => parent::U,
                    3 => parent::U
                ],
            ],
            [
                'row1' => [
                    1 => parent::L,
                    2 => parent::L,
                    3 => parent::L
                ],
                'row2' => [
                    1 => parent::L,
                    2 => parent::L,
                    3 => parent::L
                ],
                'row3' => [
                    1 => parent::L,
                    2 => parent::L,
                    3 => parent::L
                ],
            ],
            [
                'row1' => [
                    1 => parent::F,
                    2 => parent::F,
                    3 => parent::F
                ],
                'row2' => [
                    1 => parent::F,
                    2 => parent::F,
                    3 => parent::F
                ],
                'row3' => [
                    1 => parent::F,
                    2 => parent::F,
                    3 => parent::F
                ],
            ],
            [
                'row1' => [
                    1 => parent::R,
                    2 => parent::R,
                    3 => parent::R
                ],
                'row2' => [
                    1 => parent::R,
                    2 => parent::R,
                    3 => parent::R
                ],
                'row3' => [
                    1 => parent::R,
                    2 => parent::R,
                    3 => parent::R
                ],
            ],
            [
                'row1' => [
                    1 => parent::B,
                    2 => parent::B,
                    3 => parent::B
                ],
                'row2' => [
                    1 => parent::B,
                    2 => parent::B,
                    3 => parent::B
                ],
                'row3' => [
                    1 => parent::B,
                    2 => parent::B,
                    3 => parent::B
                ],
            ],
            [
                'row1' => [
                    1 => parent::D,
                    2 => parent::D,
                    3 => parent::D
                ],
                'row2' => [
                    1 => parent::D,
                    2 => parent::D,
                    3 => parent::D
                ],
                'row3' => [
                    1 => parent::D,
                    2 => parent::D,
                    3 => parent::D
                ],
            ]
        ];
    }

    /**
     * @return Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getCurrentCube()
    {
        return CubeData::query()->first();
    }

    /**
     * @return array
     */
    public function getCubeRows()
    {
        return array_merge(...array_values(array_map(fn($side) => array_keys($side), $this->getInitialMatrix())));
    }

    /**
     * @param $id
     * @param $data
     * @return void
     */
    public function updateRotation($id, $data)
    {
        CubeData::query()->find($id)->update($data);
    }
}
