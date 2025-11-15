<?php

namespace App\Interface;

Interface Service
{
    public function store(array $data);
    public function show(string $id);
    public function edit(array $data, string $id);
    public function destroy(string $id);
}