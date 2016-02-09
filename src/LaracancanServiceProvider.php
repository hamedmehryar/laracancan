<?php namespace Hamedmehryar\Laracancan;

use Hamedmehryar\Laracancan\Commands\MigrationCommand;
use Hamedmehryar\Laracancan\Commands\SeederCommand;
use Illuminate\Support\ServiceProvider;

class LaracancanServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			base_path('vendor/hamedmehryar/laracancan/src/config/config.php') => config_path('laracancan.php')
		]);
		$this->publishes([
			__DIR__.'/public' => public_path('hamedmehryar/laracancan'),
		], 'public');

		if (! $this->app->routesAreCached()) {
			require __DIR__.'/routes.php';
		}
		$this->loadViewsFrom(__DIR__.'/views', 'laracancan');

		// Register commands
		$this->commands('command.laracancan.migration');
		$this->commands('command.laracancan.seed');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			base_path('vendor/hamedmehryar/laracancan/src/config/config.php'), 'laracancan'
		);

		$this->registerLaracancan();
		$this->registerCommands();
	}

	/**
	 * Register the application bindings.
	 *
	 * @return void
	 */
	private function registerLaracancan()
	{
		$this->app->bind('laracancan', function ($app) {
			return new Laracancan($app);
		});
	}

	/**
	 * Register the artisan commands.
	 *
	 * @return void
	 */
	private function registerCommands()
	{
		$this->app->bindShared('command.laracancan.migration', function ($app) {
			return new MigrationCommand();
		});
		$this->app->bindShared('command.laracancan.seed', function ($app) {
			return new SeederCommand();
		});
	}

	/**
	 * Get the services provided.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'command.laracancan.migration',
			'command.laracancan.seed'
		];
	}

}
