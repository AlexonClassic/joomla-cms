<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Linkedin
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die();

/**
 * Linkedin API Jobs class for the Joomla Platform.
 *
 * @package     Joomla.Platform
 * @subpackage  Linkedin
 * @since       12.3
 */
class JLinkedinJobs extends JLinkedinObject
{
	/**
	 * Method to retrieve detailed information about a job.
	 *
	 * @param   JLinkedinOAuth  $oauth   The JLinkedinOAuth object.
	 * @param   integer         $id      The unique identifier for a job.
	 * @param   string          $fields  Request fields beyond the default ones.
	 *
	 * @return  array  The decoded JSON response
	 *
	 * @since   12.3
	 */
	public function getJob($oauth, $id, $fields = null)
	{
		// Set parameters.
		$parameters = array(
			'oauth_token' => $oauth->getToken('key')
		);

		// Set the API base
		$base = '/v1/jobs/' . $id;

		// Set request parameters.
		$data['format'] = 'json';

		// Check if fields is specified.
		if ($fields)
		{
			$base .= ':' . $fields;
		}

		// Build the request path.
		$path = $this->getOption('api.url') . $base;

		// Send the request.
		$response = $oauth->oauthRequest($path, 'GET', $parameters, $data);
		return json_decode($response->body);
	}
}