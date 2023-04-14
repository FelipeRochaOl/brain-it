<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;

class RequestHelper
{
    const LIMIT_PER_PAGE = '20';

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getFilterParams()
    {
        $limit = $this->getLimit();
        $where = $this->getWhere();
        $order = $this->getOrder();
        $like = $this->getLike();

        return [
            $limit,
            $order,
            $where,
            $like
        ];
    }

    private function getLimit(): string
    {
        return $this->request->get('limit') ?? self::LIMIT_PER_PAGE;
    }

    private function getWhere(): array
    {
        return $this->request->get('where') ?? [];
    }

    private function getOrder(): array
    {
        $field = 'id';
        $type = 'asc';
        $order = $this->request->get('order');
        if (is_array($order)) {
            $type = key($order);
            $field = current($order);
        }

        return [
            $field,
            $type
        ];
    }

    private function getLike(): array
    {
        $field = null;
        $search = null;
        $like = $this->request->get('like');
        if (is_array($like)) {
            $field = key($like);
            $value = current($like);
            $search = "%{$value}%";
        }

        return [
            $field,
            $search
        ];
    }
}
