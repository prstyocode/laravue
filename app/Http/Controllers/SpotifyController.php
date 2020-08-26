<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class SpotifyController extends Controller
{
	private $accessToken;

	const BASE_URL = 'https://api.spotify.com/v1/';
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth');
	}

	/**
	 * Attempt to connect with Spotify API.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function connect()
	{
		$params = [
			'client_id' => env('SPOTIFY_CLIENT_ID'),
			'response_type' => 'code',
			'redirect_uri' => env('APP_URL') . '/spotify/callback',
			'state' => 'asdf1234',
			'scope' => 'user-library-read user-follow-modify playlist-modify-public playlist-modify-private'
		];
		$query = http_build_query($params);
		return Redirect::to('https://accounts.spotify.com/authorize?' . $query);
	}

	public function callback(Request $request)
	{

		$client = new Client();

		$body = [
			'grant_type' => 'authorization_code',
			'code' => $request->code,
			'redirect_uri' => env('APP_URL') . '/spotify/callback'
		];

		$response = $client->request(
			'POST',
			'https://accounts.spotify.com/api/token',
			[
				'headers' => [
					'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'))
				],
				'form_params' => $body
			]
		);

		$result = json_decode($response->getBody()->getContents());

		Cookie::queue('spotify_access_token', $result->access_token, $result->expires_in);
		Cookie::queue('spotify_refresh_token', $result->refresh_token);

		return redirect()->route('home');
	}

	public function refreshToken()
	{
		$client = new Client();

		$refreshToken = Cookie::get('spotify_refresh_token');

		if (!$refreshToken) redirect()->to('/spotify/connect')->send();

		$body = [
			'grant_type' => 'refresh_token',
			'refresh_token' => $refreshToken
		];

		$response = $client->request(
			'POST',
			'https://accounts.spotify.com/api/token',
			[
				'headers' => [
					'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'))
				],
				'form_params' => $body
			]
		);

		$result = json_decode($response->getBody()->getContents());

		Cookie::queue('spotify_access_token', $result->access_token, $result->expires_in);

		return $result->access_token;
	}

	private function checkAuth()
	{
		$this->accessToken = Cookie::get('spotify_access_token');

		if (!$this->accessToken) {
			$this->accessToken = $this->refreshToken();
		}
	}

	private function buildRequest($method, $endpoint)
	{
		$this->checkAuth();

		$decrypted = Crypt::decrypt($this->accessToken, false);
		$accessToken = explode('|', $decrypted)[1];

		$client = new Client();

		try {
			$response = $client->request(
				$method,
				self::BASE_URL . $endpoint,
				[
					'headers' => [
						'Authorization' => 'Bearer ' . $accessToken,
					],
				]
			);
		} catch (\Throwable $th) {
			return redirect()->to('/spotify/connect')->send();
		}

		return json_decode($response->getBody()->getContents());
	}

	public function getUserSavedTracks()
	{
		$result = $this->buildRequest('GET', 'me/tracks');

		return response()->json($result);
	}

	public function getUsersProfile()
	{
		$result = $this->buildRequest('GET', 'me');

		return response()->json($result);
	}
}
