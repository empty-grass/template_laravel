<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\ClientRepository;
use App\Consts\ClientConst;

class ClientLogic
{
    public function __construct(ClientRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getList()
    {
        return $this->repo->getAdminList();
    }

    public function store(array $validated)
    {
        $this->repo->insert([
            'name' => $validated['name'],
        ]);
        return true;
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    public function update(array $validated, int $id)
    {
        $this->repo->findUpdate($id, [
            'name' => $validated['name'],
        ]);
        return true;
    }

    public function delete(int $id)
    {
        $this->repo->findDelete($id);
        return true;
    }
}
