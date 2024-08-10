<?php

namespace Amrghamrawy\MacroSearch;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Amrghamrawy\MacroSearch\Commands\MacroSearchCommand;
use Illuminate\Database\Eloquent\Builder;

class MacroSearchServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('macro-search')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_macro_search_table')
            ->hasCommand(MacroSearchCommand::class);
    }
    public function bootingPackage(){

        Builder::macro('search', function (string $term) {
            if (property_exists($this->getModel(), 'searchable')) {
                $columns = $this->getModel()->searchable;
                $term = strtolower($term);

                $this->where(function($query) use ($columns, $term) {
                    foreach ($columns as $column) {
                        if (str_contains($column, '.')) {
                            [$relation, $relationColumn] = explode('.', $column);
                            $query->orWhereHas($relation, function ($q) use ($relationColumn, $term) {
                                $q->whereRaw("LOWER({$relationColumn}) LIKE ?", ["%{$term}%"]);
                            });
                        } else {
                            $query->orWhereRaw("LOWER({$column}) LIKE ?", ["%{$term}%"]);
                        }
                    }
                });
            }

            return $this;
        });
    }
}
