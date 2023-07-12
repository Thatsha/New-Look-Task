<?php


namespace App\Interfaces\User;


use Illuminate\Http\Request;

interface UserInterface
{
    public function index(Request $request);

    public function store(Request $request);


    public function show($id);

    public function update(Request $request, $id);

    public function delete($id);

}
