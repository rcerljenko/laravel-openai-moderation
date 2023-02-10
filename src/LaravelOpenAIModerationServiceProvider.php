<?php

namespace RCerljenko\LaravelOpenAIModeration;

use Illuminate\Support\ServiceProvider;

class LaravelOpenAIModerationServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
		$this->publishes([
			__DIR__ . '/../config/openai.php' => config_path('openai.php'),
		], 'config');

		$this->publishes([
			__DIR__ . '/../resources/lang' => resource_path('lang/vendor/openai'),
		], 'translations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'openai');
	}

	public function register(): void
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/openai.php', 'openai');
	}
}
