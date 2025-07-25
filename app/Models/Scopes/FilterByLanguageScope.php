<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class FilterByLanguageScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model)
    {
        if (session()->has('language')) {
            $lang = DB::table('languages')->where('id', session('language'))->value('name');

            if ($lang === 'kr') {
                $builder->where('language', '=', $lang);
            } else {
                $builder->where('language', '!=', 'kr')->orWhereNull('language');
            }
        }
    }
}
