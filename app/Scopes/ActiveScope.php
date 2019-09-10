<?php
/**
 * Created by PhpStorm.
 * User: Dyego
 * Date: 9/09/2019
 * Time: 9:04 PM
 */

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('active', true);
    }
}