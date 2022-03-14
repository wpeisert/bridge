<?php

namespace App\Providers;

use App\Interfaces\BiddingRepositoryInterface;
use App\Interfaces\Deal\DealBuilderInterface;
use App\Interfaces\Deal\DealConstraintsProviderInterface;
use App\Interfaces\Deal\DealConstraintsVerifierInterface;
use App\Interfaces\Deal\DealCreatorInterface;
use App\Interfaces\Deal\DealModifierInterface;
use App\Interfaces\Deal\QuizBuilderInterface;
use App\Repositories\BiddingRepository;
use App\Services\Deal\DealConstraintsProvider;
use App\Services\Deal\DealConstraintsVerifier;
use App\Services\Deal\DealCreator;
use App\Services\Deal\DealBuilder;
use App\Services\Deal\DealModifier;
use App\Services\Deal\QuizBuilder;
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
        $this->app->bind(DealConstraintsProviderInterface::class, DealConstraintsProvider::class);
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
