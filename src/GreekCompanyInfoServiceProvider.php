<?php

namespace GPapakitsos\GreekCompanyInfo;

use Illuminate\Support\ServiceProvider;

class GreekCompanyInfoServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if ($this->app->runningInConsole())
		{
			$this->publishes([
				__DIR__.'/config/greek-company-info.php' => config_path('greek-company-info.php'),
			]);
		}
	}
}
