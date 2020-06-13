<?php

/**
 * Greek company info via GSIS services
 *
 * @author George Papakitsos <papakitsos_george@yahoo.gr>
 * @copyright George Papakitsos
 */

namespace GPapakitsos\GreekCompanyInfo;

use SoapClient;
use DOMDocument;

class GreekCompanyInfo {

	/**
	 * Returns company info by provided VAT
	 *
	 * @param string $vat
	 *
	 * @return array
	 */
	public static function getByVAT($vat)
	{
		$client = new SoapClient(config('greek-company-info.soap.url'));
		$responseSOAP = $client->__doRequest(
			'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:ns2="http://rgwspublic2/RgWsPublic2Service" xmlns:ns3="http://rgwspublic2/RgWsPublic2">
				<env:Header>
					<ns1:Security>
						<ns1:UsernameToken>
							<ns1:Username>'.config('greek-company-info.soap.username').'</ns1:Username>
							<ns1:Password>'.config('greek-company-info.soap.password').'</ns1:Password>
						</ns1:UsernameToken>
					</ns1:Security>
				</env:Header>
				<env:Body>
					<ns2:rgWsPublic2AfmMethod>
						<ns2:INPUT_REC>
							<ns3:afm_called_by/>
							<ns3:afm_called_for>'.$vat.'</ns3:afm_called_for>
						</ns2:INPUT_REC>
					</ns2:rgWsPublic2AfmMethod>
				</env:Body>
			</env:Envelope>',
		config('greek-company-info.soap.url'), null, SOAP_1_2);

		$doc = new DOMDocument();
		$doc->loadXML($responseSOAP);

		$error = $doc->getElementsByTagName('error_descr')->item(0)->nodeValue;
		if (!empty($error)) return ['status' => 'error', 'message' => $error];

		$data = $doc->getElementsByTagName('basic_rec')->item(0);
		$responseData = [];
		foreach (config('greek-company-info.data_mapping') as $node => $attribute)
		{
			$responseData[$attribute] = trim(str_replace('  ', ' ', $data->getElementsByTagName($node)->item(0)->nodeValue));
		}
		$responseData['address_full'] = $responseData['address'].' '.$responseData['address_no'].', '.$responseData['city'].', Τ.Κ. '.$responseData['zip_code'];

		$responseData['activities'] = [];
		$activities = $doc->getElementsByTagName('item');
		foreach ($activities as $activity)
		{
			$responseData['activities'][] = [
				'description' => $activity->getElementsByTagName('firm_act_descr')->item(0)->nodeValue,
				'type' => $activity->getElementsByTagName('firm_act_kind_descr')->item(0)->nodeValue,
			];
		}

		return ['status' => 'success', 'data' => $responseData];
	}

}
