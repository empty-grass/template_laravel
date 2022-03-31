<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\ClientStoreRequest;
use App\Http\Requests\Admin\Client\ClientEditRequest;
use App\Http\Requests\Admin\Client\ClientUpdateRequest;
use App\Http\Requests\Admin\Client\ClientDeleteRequest;

class ClientController extends Controller
{

    public function __construct(ClientLogic $logic)
    {
        $this->logic = $logic;
    }

    public function list()
    {
        $contents['clients'] = $this->logic->getList();
        return view('admin.client.list', $contents);
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(ClientStoreRequest $request)
    {
        $this->logic->store($request->validated());
        return redirect()->route('admin.client.list')->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.client.store')
        ]);
    }

    public function edit(ClientEditRequest $request, int $id)
    {
        $contents['client'] = $this->logic->find($id);
        return view('admin.client.edit', $contents);
    }

    public function update(ClientUpdateRequest $request, int $id)
    {
        $test = $this->logic->update($request->validated(), $id);
        return redirect()->route('admin.client.edit', ['id' => $id])->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.client.update')
        ]);
    }

    public function delete(ClientDeleteRequest $request, $id)
    {
        $this->logic->delete($id);
        return redirect()->route('admin.client.list', ['id' => $id])->with('alert', [
            'status'  => 'success',
            'message' => __('success.admin.client.delete')
        ]);
    }
}
