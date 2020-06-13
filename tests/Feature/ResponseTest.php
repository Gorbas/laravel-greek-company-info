<?php

namespace GPapakitsos\GreekCompanyInfo\Tests\Feature;

use GPapakitsos\GreekCompanyInfo\Tests\FeatureTestCase;
use GPapakitsos\GreekCompanyInfo\GreekCompanyInfo;

class ResponseTest extends FeatureTestCase
{
	public function testResponse()
	{
		$response = GreekCompanyInfo::getByVAT('123456789');
		$this->assertSame('error', $response['status']);
	}
}
