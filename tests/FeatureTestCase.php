<?php

namespace GPapakitsos\GreekCompanyInfo\Tests;

use Orchestra\Testbench\TestCase;

class FeatureTestCase extends TestCase
{
	protected function getEnvironmentSetUp($app)
	{
		$config = $app->get('config');

		$config->set('greek-company-info.soap.url', 'https://www1.gsis.gr/wsaade/RgWsPublic2/RgWsPublic2?WSDL');
	}
}
