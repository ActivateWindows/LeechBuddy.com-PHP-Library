<?php
class LeechBuddy
{
	private static $token = 'FACEBOOK ACCESS TOKEN IS HERE';
	private static $affiliate_url = 'http://leechbuddy.com/?i=fp';

	public static function curl($url,$cookie,$post_and_json,$header,$follow)
	{
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch,CURLOPT_REFERER,'https://www.google.com/');
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
		if($header) curl_setopt($ch,CURLOPT_HEADER,1);
		if($follow) curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
		if($cookie) curl_setopt($ch,CURLOPT_COOKIE,$cookie);

		if($post_and_json[0])
		{
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$post_and_json[0]);
		}
		if($post_and_json[1])
		{
			curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		}
		if($post_and_json[2])
		{
			curl_setopt($ch,CURLOPT_HTTPHEADER,$post_and_json[2]);
		}

		ob_start();
		return curl_exec($ch);
		ob_end_flush();
	}

	/*
		* Gets user data by using token.
		  @returns [array]
	*/
	public static function get_user_data()
	{
		$data  =  self::curl('https://www.leechbuddy.com/api/data',0,array(0,1,array('Authorization: Bearer '.self::$token)),0,0);
		$data  =  json_decode($data,1);

		$cdo   =  self::check_ok($data);
		if($cdo) throw new Exception(implode($cdo,' - '));

		return $data;
	}

	/*
		* Checks if the token is wrong or not.
		  @data [array]
		  @returns [array] or boolean
	*/
	public static function check_ok($data)
	{
		if(isset($data['message']) and isset($data['status_code']))
		{
			$message      =  $data['message'];
			$status_code  =  $data['status_code'];

			return array($status_code,$message);
		}
		return false;
	}

	/*
		* Checks the working filehosters.
		  @user_data [array]
		  @returns string
	*/
	public static function check_working_filehosters($user_data)
	{
		$count_hosts = 0;
		$entry = null;
		foreach($user_data['working_hosters'] as $val)
		{
			$entry .= $val['url'];
			if(++$count_hosts !== count($user_data['working_hosters']))
			{
				$entry .= ' - ';
			}
		}
		return $entry;
	}

	/*
		* Gets the available quota in GBs.
		  @user_data [array]
		  @returns integer/float
	*/
	public static function available_quota_in_gb($user_data)
	{
		$limit =  $user_data['user_limit_points_rank']['limit'];
		$calc  =  $limit / 1000;
		return    $calc;
	}

	/*
		* Gets the used quota percentage.
		  @user_data [array]
		  @returns integer/float
	*/
	public static function used_quota_percentage($user_data)
	{
		$consumed =  $user_data['consumed_quota'];
		$limit    =  $user_data['user_limit_points_rank']['limit'];
		$calc     =  $consumed / $limit * 100;
		return       $calc;
	}

	/*
		* Gets the client's points.
		  @user_data [array]
		  @returns integer
	*/
	public static function user_points($user_data)
	{
		$points = $user_data['user_limit_points_rank']['points'];
		return    $points;
	}

	/*
		* Gets the client's rank.
		  @user_data [array]
		  @returns string
	*/
	public static function user_rank($user_data)
	{
		$points = $user_data['user_limit_points_rank']['rank'];
		return    $points;
	}

	/*
		* Gets all plans and points of them.
		  @user_data [array]
		  @returns [array]
	*/
	public static function all_plans_and_points($user_data)
	{
		$arr = array();
		foreach($user_data['plans_points'] as $key => $value)
		{
			$arr[$key] = $value;
		}
		return $arr;
	}

	/*
		* Gets the news submitted in LeechBuddy.
		  @user_data [array]
		  @returns [array]
	*/
	public static function news($user_data)
	{
		$arr = array();
		foreach($user_data['news'] as $key => $value)
		{
			foreach($value as $val)
			{
				$arr[] = $val;
			}
		}
		return $arr;
	}

	/*
		* Adds the download link to queue.
		  @url string
		  @returns boolean
	*/
	public static function add_link_to_queue($url)
	{
		$data = self::curl('https://www.leechbuddy.com/api/queue',0,array('url='.urlencode($url),1,array('Authorization: Bearer '.self::$token)),0,0);
		$data = json_decode($data,1);
		if($data['error']) throw new Exception($data['msg']);
		return true;
	}

	/*
		* Lists all files which has been added by client.
		  @user_data [array]
		  @returns [array]
	*/
	public static function list_files($user_data)
	{
		$arr = array();
		foreach($user_data['files'] as $key => $value)
		{
			$arr[] = $value;
		}
		return $arr;
	}
}
?>
