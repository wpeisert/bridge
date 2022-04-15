<?php

namespace App\Providers;

use App\Repositories\BiddingRepositoryInterface;
use App\Services\Bidding\BiddingBuilder;
use App\Services\Bidding\BiddingBuilderInterface;
use App\Services\Bidding\RuleChecker;
use App\Services\Bidding\RuleCheckerInterface;
use App\Services\BiddingParser\BiddingParser;
use App\Services\BiddingParser\BiddingParserFactory;
use App\Services\BiddingParser\BiddingParserFactoryInterface;
use App\Services\BiddingParser\BiddingParserInterface;
use App\Services\Deal\DealService;
use App\Services\Deal\DealServiceInterface;
use App\Services\DealBuilder\DealBuilder;
use App\Services\DealBuilder\DealBuilderInterface;
use App\Services\DealBuilder\DealConstraintVerifier;
use App\Services\DealBuilder\DealConstraintVerifierInterface;
use App\Services\DealBuilder\DealCreator;
use App\Services\DealBuilder\DealCreatorInterface;
use App\Services\DealBuilder\DealGenerator;
use App\Services\DealBuilder\DealGeneratorInterface;
use App\Services\DealBuilder\DealModifier;
use App\Services\DealBuilder\DealModifierInterface;
use App\Services\DealConstraint\DealConstraintDecorator;
use App\Services\DealConstraint\DealConstraintDecoratorFactory;
use App\Services\DealConstraint\DealConstraintDecoratorFactoryInterface;
use App\Services\DealConstraint\DealConstraintDecoratorInterface;
use App\Services\DealDecorator\DealDecorator;
use App\Services\DealDecorator\DealDecoratorFactory;
use App\Services\DealDecorator\DealDecoratorFactoryInterface;
use App\Services\DealDecorator\DealDecoratorInterface;
use App\Services\Quiz\QuizBuilderInterface;
use App\Services\RandomSeederInterface;
use App\Repositories\BiddingRepository;
use App\Services\Quiz\QuizBuilder;
use App\Services\RandomSeeder;
use App\Services\Training\TrainingBuilder;
use App\Services\Training\TrainingBuilderInterface;
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
        $this->app->bind(DealConstraintVerifierInterface::class, DealConstraintVerifier::class);
        $this->app->bind(DealCreatorInterface::class, DealCreator::class);
        $this->app->bind(DealModifierInterface::class, DealModifier::class);
        $this->app->bind(DealConstraintDecoratorInterface::class, DealConstraintDecorator::class);
        $this->app->bind(DealGeneratorInterface::class, DealGenerator::class);
        $this->app->bind(RandomSeederInterface::class, RandomSeeder::class);
        $this->app->bind(DealDecoratorFactoryInterface::class, DealDecoratorFactory::class);
        $this->app->bind(DealDecoratorInterface::class, DealDecorator::class);
        $this->app->bind(DealConstraintDecoratorFactoryInterface::class, DealConstraintDecoratorFactory::class);
        $this->app->bind(DealServiceInterface::class, DealService::class);
        $this->app->bind(TrainingBuilderInterface::class, TrainingBuilder::class);
        $this->app->bind(BiddingBuilderInterface::class, BiddingBuilder::class);
        $this->app->bind(RuleCheckerInterface::class, RuleChecker::class);
        $this->app->bind(BiddingParserFactoryInterface::class, BiddingParserFactory::class);
        $this->app->bind(BiddingParserInterface::class, BiddingParser::class);
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
