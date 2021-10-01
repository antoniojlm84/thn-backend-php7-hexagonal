<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Response\JsonApi\Transformer;

use Thn\BackendTest\Domain\Query\MultipleResourceResponse;
use Thn\BackendTest\Domain\Query\QueryResponse;
use Thn\BackendTest\Domain\Query\SingleResourceResponse;
use Thn\BackendTest\Domain\Transformer\Transformer;

class JsonApiTransformer implements Transformer
{
    /** @var string  */
    protected $typeName;

    /** @var array  */
    protected $result;

    protected $availableIncludes = [];

    protected $defaultIncludes = [];

    public function __construct()
    {
        $this->result = [];
    }

    public function transform(QueryResponse $data): array {

        if (true === empty($data)) {
            return $this->result;
        }

        $this->result[$this->typeName]['data'] = [];

        if ($data instanceof SingleResourceResponse) {
            $transformedData = $this->responseSingleResult($data->resource(), $data->includes());
        } else {
            $transformedData = $this->responseMultiResult($data);
        }

        $this->result[$this->typeName]['data'] = $transformedData;

        return $this->result;
    }

    public function responseMultiResult(QueryResponse $data): array
    {
        $result = [];
        if (true === empty($data->resource())) {
            return $result;
        }

        /** @var MultipleResourceResponse $item */
        foreach ($data->resource() as $item) {
            $result[] =  $this->responseSingleResult($item, $data->includes());
        }

        return $result;
    }

    public function includes(array $includes, $data): void
    {
        if (false === empty($includes)) {
            foreach ($includes as $include) {
                if (true === in_array($include, $this->availableIncludes)) {
                    $function = $include;
                    if (false !== strpos($include,'-')) {
                        $function = explode('-', $include);
                        $function = $function[0] . ucfirst($function[1]);
                    }

                    if (true === method_exists($data,$function)) {
                        if (false == empty($data->{$function}())) {
                            $this->result[$this->typeName]['includes'] = [];
                            foreach ($data->{$function}() as $item) {
                                $functionInclude = 'include' . ucfirst($function);
                                $this->result[$this->typeName]['includes'][] = $this->{$functionInclude}($item);
                            }
                        }
                    }
                }
            }
        }
    }
}