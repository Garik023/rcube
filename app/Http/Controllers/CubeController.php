<?php

namespace App\Http\Controllers;

use App\Services\Constants;
use App\Services\CubeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CubeController extends Controller
{
    private CubeService $cubeService;

    /**
     * @param CubeService $cubeService
     */
    public function __construct(CubeService $cubeService)
    {
        $this->cubeService = $cubeService;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json($this->cubeService->getCurrentCube()->getAttribute('matrix'));
    }

    /**
     * @return JsonResponse
     */
    public function initial()
    {
        return response()->json($this->cubeService->getInitialMatrix());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function rotate(Request $request)
    {
        $side = strtoupper($request->input('side'));
        $row = "row{$request->input('row')}";
        $direction = $request->input('direction');
        $degree = (string) $request->input('degree', 90);

        $validator = validator([
            'side' => $side,
            'row' => $row,
            'direction' => $direction,
            'degree' => $degree,
        ], [
            'side' => ['required', Rule::in(Constants::SIDES)],
            'row' => ['required', Rule::in($this->cubeService->getCubeRows())],
            'direction' => ['required', Rule::in(Constants::DIRECTIONS)],
            'degree' => ['nullable', Rule::in(array_keys(Constants::DEGREES))],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $currentCube = $this->cubeService->getCurrentCube();

        $currentCubeMatrix = $currentCube
            ? $currentCube->getAttribute('matrix')
            : $this->cubeService->getInitialMatrix();

        $sideKey = array_search($side, Constants::SIDES);

        $newSideKey = 0;
        if ($sideKey != 5) {
            $newSideKey = $sideKey + 1;
        }

        $rotatedCubeMatrix = $currentCubeMatrix;

        $rotatedCubeMatrix[$newSideKey] = $currentCubeMatrix[$sideKey];
        $rotatedCubeMatrix[$sideKey] = $currentCubeMatrix[$newSideKey];

        try {
            $this->cubeService->updateRotation($currentCube->id, [
                'matrix' => $rotatedCubeMatrix,
                'direction' => $direction,
                'degree' => $degree,
                'side' => $side,
            ]);

            return response()->json(['message' => true]);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
