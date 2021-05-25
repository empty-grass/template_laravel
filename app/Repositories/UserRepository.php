<?php

namespace App\Repositories;

use App\Models\User;
use App\Consts\UserConst;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * TemplateSample ユーザ検索機能
     */
    public function search(?array $filter)
    {
        $query = $this->model->query();

        $query->when($filter['email'] ?? false, function ($query, $param) {
            return $this->filterByEmail($query, $param);
        });

        $query->when($filter['name'] ?? false, function ($query, $param) {
            return $this->filterByName($query, $param);
        });

        return $query->paginate(UserConst::PER_PAGE);
    }

    /**
     * TemplateSample ユーザ検索機能 メールアドレス
     */
    private function filterByEmail($query, string $email)
    {
        return $query->where('email', $email);
    }

    /**
     * TemplateSample ユーザ検索機能 ユーザ名
     */
    private function filterByName($query, string $name)
    {
        return $query->where('name', 'LIKE', $this->escapeLike($name).'%');
    }
}
