<?php
namespace App\Repositories;

use App\Models\Bolo;

interface RepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}

class BoloRepository implements RepositoryInterface
{
    public function all()
    {
        return Bolo::all();
    }

    public function find($id)
    {
        return Bolo::findOrFail($id);
    }

    public function create(array $data)
    {
        return Bolo::create($data);
    }

    public function update(array $data, $id)
    {
        $bolo = $this->find($id);
        $bolo->update($data);
        return $bolo;
    }

    public function delete($id)
    {
        return Bolo::destroy($id);
    }
}

class RepositoryServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, BoloRepository::class);
    }
}