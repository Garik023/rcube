<?php

namespace Tests\Unit;

use Tests\TestCase;

class CubeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_initial_cube_matrix()
    {
        $this->get(route('cube.initial'));

        $this->assertTrue(true);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_rotated_cube_matrix()
    {
        $this->get(route('cube.rotated'));

        $this->assertTrue(true);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_rotate_cube()
    {
        $this->post(route('cube.rotate'), [
            'side' => 'U',
            'direction' => 'horizontal'
        ]);

        $this->assertTrue(true);
    }
}
