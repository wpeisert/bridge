<?php

namespace App\Providers;

use App\Interfaces\BiddingRepositoryInterface;
use App\Interfaces\Deal\DealBuilderInterface;
use App\Interfaces\Deal\DealDecoratorFactoryInterface;
use App\Interfaces\Deal\DealDecoratorInterface;
use App\Interfaces\DealConstraints\DealConstraintsDecoratorInterface;
use App\Interfaces\DealConstraints\DealConstraintsVerifierInterface;
use App\Interfaces\Deal\DealCreatorInterface;
use App\Interfaces\Deal\DealGeneratorInterface;
use App\Interfaces\Deal\DealModifierInterface;
use App\Interfaces\Quiz\QuizBuilderInterface;
use App\Interfaces\RandomSeederInterface;
use App\Repositories\BiddingRepository;
use App\Services\Deal\DealDecorator;
use App\Services\Deal\DealDecoratorFactory;
use App\Services\DealConstraints\DealConstraintsDecorator;
use App\Services\DealConstraints\DealConstraintsVerifier;
use App\Services\Deal\DealCreator;
use App\Services\Deal\DealBuilder;
use App\Services\Deal\DealGenerator;
use App\Services\Deal\DealModifier;
use App\Services\Quiz\QuizBuilder;
use App\Services\RandomSeeder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BiddingRepositoryInterface::class, BiddingRepository::class);

        $this->app->bind(QuizBuilderInterface::class, QuizBuilder::class);
        $this->app->bind(DealBuilderInterface::class, DealBuilder::class);
        $this->app->bind(DealConstraintsVerifierInterface::class, DealConstraintsVerifier::class);
        $this->app->bind(DealCreatorInterface::class, DealCreator::class);
        $this->app->bind(DealModifierInterface::class, DealModifier::class);
        $this->app->bind(DealConstraintsDecoratorInterface::class, DealConstraintsDecorator::class);
        $this->app->bind(DealGeneratorInterface::class, DealGenerator::class);
        $this->app->bind(RandomSeederInterface::class, RandomSeeder::class);
        $this->app->bind(DealDecoratorFactoryInterface::class, DealDecoratorFactory::class);
        $this->app->bind(DealDecoratorInterface::class, DealDecorator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
