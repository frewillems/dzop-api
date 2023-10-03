<?php

namespace Support;

use Domain\CareGoal\CareGoalObserver;
use Domain\CareGoal\Model\CareGoal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        Model::shouldBeStrict(!$this->app->isProduction());
        DB::disableQueryLog();

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $namespace = 'Database\\Factories\\';
            $modelName = Str::afterLast($modelName, '\\');
            return $namespace . $modelName . 'Factory';
        });

        CareGoal::observe(CareGoalObserver::class);
    }
}
