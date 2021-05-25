<?php
namespace App\Http\Middleware;

use Closure;
// use Symfony\Component\HttpFoundation\StreamedResponse;

class DBTransaction
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Read/Writeの指定をしていた場合、Transactionを実行するとWriteを参照する
        // そのため、DB更新を行わないGETアクセスはTransactionを実行しない
        if ($request->isMethod('get')) {
            return $response;
        }

        \DB::beginTransaction();
        if (isset($response->exception) && $response->exception) {
            // TODO:下記のような条件でfile streamの場合ははじきたいが、一旦isset()で対応
            // if (!($request instanceof StreamedResponse) && $response->exception) {

            \DB::rollBack();
        } else {
            \DB::commit();
        }
        return $response;
    }
}
