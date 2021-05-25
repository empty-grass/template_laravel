<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\ListRequest;
use App\Http\Requests\Admin\User\FilterRequest;
use App\Http\Requests\Admin\User\EditRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Requests\Admin\User\BlockRequest;
use App\Http\Requests\Admin\User\UnblockRequest;

/**
 * TemplateSample
 */
class UserController extends Controller
{

    public function __construct(UserLogic $logic)
    {
        $this->logic = $logic;
    }

    public function list(ListRequest $request)
    {
        $contents['users'] = $this->logic->getList();
        return view('admin.user.list', $contents);
    }

    public function filter(FilterRequest $request)
    {
        $this->logic->filter($request->validated());
        return redirect()->route('admin.user.list');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(StoreRequest $request)
    {
        $this->logic->store($request->validated());
        return redirect()->route('admin.user.list')->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.user.store')
        ]);
    }

    public function edit(EditRequest $request, int $id)
    {
        $contents['user'] = $this->logic->find($id);
        return view('admin.user.edit', $contents);
    }

    public function update(UpdateRequest $request, int $id)
    {
        $this->logic->update($request->validated(), $id);
        return redirect()->route('admin.user.edit', ['id' => $id])->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.user.update')
        ]);
    }

    public function block(BlockRequest $request, int $id)
    {
        $this->logic->block($id);
        return redirect()->route('admin.user.edit', ['id' => $id])->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.user.block')
        ]);
    }

    public function unblock(UnblockRequest $request, int $id)
    {
        $this->logic->unblock($id);
        return redirect()->route('admin.user.edit', ['id' => $id])->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.user.unblock')
        ]);
    }
}
