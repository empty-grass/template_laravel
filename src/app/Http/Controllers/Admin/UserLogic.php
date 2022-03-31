<?php
namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;
use App\Sessions\AdminUserSearchSession;
use Str;

/**
 * TemplateSample
 */
class UserLogic
{
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
        $this->searchSession = app(AdminUserSearchSession::class);
    }

    public function getList()
    {
        $filter = $this->searchSession->get();
        return $this->repo->search($filter);
    }

    public function filter(array $validated) : bool
    {
        $this->searchSession->put($validated);
        return true;
    }

    public function store(array $validated)
    {
        $this->repo->insert([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => encrypt(Str::random(10)),
        ]);
        // TODO queue にメール送信を登録
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
            'email' => $validated['email'],
        ]);
        return true;
    }
}
