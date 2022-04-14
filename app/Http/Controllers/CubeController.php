<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CubeController extends Controller
{
    private string $side;
    private string $row;
    private string $direction;
    private int $degree;

    private const
        DEGREES_WALK = [90 => 1, 180 => 2],
        DIRECTIONS = ['vertical', 'horizontal'],
        HORIZONTAL = 'horizontal',
        VERTICAL = 'vertical',
        SIDES = ['U', 'L', 'F', 'R', 'B', 'D'],
        U = 'U',
        L = 'L',
        F = 'F',
        R = 'R',
        B = 'B',
        D = 'D'
    ;

    public function __construct()
    {
        $this->side = strtoupper(request()->get('side', self::U));
        $this->row = "row" . request()->get('row', 1);
        $this->direction = strtolower(request()->get('direction', self::HORIZONTAL));
        $this->degree = request()->get('degree', 90);
    }

    private function cube()
    {
        return [
            [
                'row1' => [
                    1 => self::U,
                    2 => self::U,
                    3 => self::U
                ],
                'row2' => [
                    1 => self::U,
                    2 => self::U,
                    3 => self::U
                ],
                'row3' => [
                    1 => self::U,
                    2 => self::U,
                    3 => self::U
                ],
            ],
            [
                'row1' => [
                    1 => self::L,
                    2 => self::L,
                    3 => self::L
                ],
                'row2' => [
                    1 => self::L,
                    2 => self::L,
                    3 => self::L
                ],
                'row3' => [
                    1 => self::L,
                    2 => self::L,
                    3 => self::L
                ],
            ],
            [
                'row1' => [
                    1 => self::F,
                    2 => self::F,
                    3 => self::F
                ],
                'row2' => [
                    1 => self::F,
                    2 => self::F,
                    3 => self::F
                ],
                'row3' => [
                    1 => self::F,
                    2 => self::F,
                    3 => self::F
                ],
            ],
            [
                'row1' => [
                    1 => self::R,
                    2 => self::R,
                    3 => self::R
                ],
                'row2' => [
                    1 => self::R,
                    2 => self::R,
                    3 => self::R
                ],
                'row3' => [
                    1 => self::R,
                    2 => self::R,
                    3 => self::R
                ],
            ],
            [
                'row1' => [
                    1 => self::B,
                    2 => self::B,
                    3 => self::B
                ],
                'row2' => [
                    1 => self::B,
                    2 => self::B,
                    3 => self::B
                ],
                'row3' => [
                    1 => self::B,
                    2 => self::B,
                    3 => self::B
                ],
            ],
            [
                'row1' => [
                    1 => self::D,
                    2 => self::D,
                    3 => self::D
                ],
                'row2' => [
                    1 => self::D,
                    2 => self::D,
                    3 => self::D
                ],
                'row3' => [
                    1 => self::D,
                    2 => self::D,
                    3 => self::D
                ],
            ]
        ];
    }

    private function rows()
    {
        return array_merge(...array_values(array_map(fn($side) => array_keys($side), $this->cube())));
    }

    public function rotate()
    {
        $cube = session('cube') ?? $this->cube();

        if (!in_array($this->side, self::SIDES)) {
            return response()->json(['message' => "Incorrect 'side' value"]);

        } elseif (!in_array($this->row, $this->rows())) {
            return response()->json(['message' => "Incorrect 'row' value"]);

        } elseif (!in_array($this->direction, self::DIRECTIONS)) {
            return response()->json(['message' => "Incorrect 'direction' value"]);

        } elseif (!in_array($this->degree, array_keys(self::DEGREES_WALK))) {
            return response()->json(['message' => "Incorrect 'degree' value"]);

        }

        $sideKey = array_search($this->side, self::SIDES);

        $walks = self::DEGREES_WALK[$this->degree];

        if ($this->direction == self::HORIZONTAL) {
            $sideKey = $sideKey + $walks - 1;

        } elseif ($this->direction == self::VERTICAL) {
            $sideKey = $sideKey - $walks + 1;
        }

        $newSideKey = 0;
        if ($sideKey != 5) {
            $newSideKey = $sideKey + 1;
        }

        $cube[$newSideKey] = (session('cube') ?? $this->cube())[$sideKey];
        $cube[$sideKey] = (session('cube') ?? $this->cube())[$newSideKey];

        session(['cube' => $cube]);

        return response()->json(['cube' => $cube]);
    }
}
