<?php

namespace App\Dto\Core\v1\Posts;

use App\Http\Requests\Core\v1\Posts\IndexRequest;

class IndexDto
{
    public function __construct(
        public ?int $perPage,
        public ?int $page,
        public ?string $search,
        public ?string $from,
        public ?string $to,
        public ?string $sort,
    ) {
    }

    /**
     * Summary of from
     * @param \App\Http\Requests\Core\v1\Posts\IndexRequest $request
     * @return \App\Dto\Core\v1\Posts\IndexDto
     */
    public static function from(IndexRequest $request): self
    {
        return new self(
            perPage: $request->perpage,
            page: $request->page,
            search: $request->search,
            from: $request->from,
            to: $request->to,
            sort: $request->sort,
        );
    }
}