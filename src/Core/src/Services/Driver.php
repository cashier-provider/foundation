<?php

/**
 * This file is part of the "cashbox/foundation" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2023 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/cashbox-laravel/foundation
 */

declare(strict_types=1);

namespace Cashbox\Core\Services;

use Cashbox\Core\Data\Config\DriverData;
use Cashbox\Core\Http\Response;
use Cashbox\Core\Resources\Resource;
use Illuminate\Database\Eloquent\Model;

abstract class Driver
{
    protected string $statuses;

    protected string $exception;

    protected string $response;

    abstract public function refund(): Response;

    abstract public function start(): Response;

    abstract public function verify(): Response;

    public function __construct(
        protected Model $payment,
        protected readonly DriverData $data,
        protected readonly Http $http
    ) {}

    public function statuses(): Statuses
    {
        return resolve($this->statuses, [$this->payment]);
    }

    protected function request(string $request): Response
    {
        $data = $this->resolve($request, 'make', $this->resource());

        $content = $this->http->send($data, $this->resolveException());

        return $this->resolve($this->response, 'from', $content);
    }

    protected function resource(): Resource
    {
        $resource = $this->data->resource;

        return new $resource($this->payment);
    }

    protected function resolveException(): Exception
    {
        return resolve($this->exception);
    }

    protected function resolve(string $class, string $method, mixed ...$parameters): object
    {
        return call_user_func([$class, $method], ...$parameters);
    }
}
