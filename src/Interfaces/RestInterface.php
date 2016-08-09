<?php

namespace App\Interfaces;

interface RestInterface
{
    public function index($request, $response);
    public function index2($id, $request, $response);
    public function get($id);
    public function put($id, $args = []);
    public function post($args = []);
    public function delete($id);
    public function query($args = [], $orderBy = []);
}
