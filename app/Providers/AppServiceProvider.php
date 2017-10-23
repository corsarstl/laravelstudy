<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Tag;
use App\Billing\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function($view) {
//            $view->with('archives', Post::archives());
//            $view->with('tags', Tag::has('posts')->pluck('name'));

            $archives = Post::archives();
            $tags = Tag::has('posts')->pluck('name');

            $view->with(compact('archives', 'tags'));
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        \App::singleton('App\Billing\Stripe', function () {
        $this->app->singleton(Stripe::class, function () {
            return new Stripe(config('services.stripe.secret'));
        });
    }
}
