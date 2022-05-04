<?php

namespace Codebitz\Yomail;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Codebitz\Yomail\Skeleton\SkeletonClass
 */
class YomailFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yomail';
    }
}
