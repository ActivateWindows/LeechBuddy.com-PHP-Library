# LeechBuddy.com PHP Class

This class makes you able to customize your PHP pages based on [LeechBuddy.com](http://www.leechbuddy.com/) and use its features on your own.

### On which environment you've made this thing?

I use XAMPP(LAMPP) v5.5.3x. So, it means I use the 5.5.3x version of PHP. Go to ```my_phpinfo``` directory to have a look on my ```phpinfo()```.

### Installation
Just download the ```class.inc.php``` file in the ```lib``` directory and include it on your code. Were you expection for more?

### Usage

```php
<?php
include_once('./class.inc.php');

// If you don't use the block below, all code will be gone.
try{
	$user_data = LeechBuddy::get_user_data();
}catch(Exception $e){
	die($e->getMessage());
}

$news                       =  LeechBuddy::news($user_data);
$all_plans_and_points       =  LeechBuddy::all_plans_and_points($user_data);
$user_points                =  LeechBuddy::user_points($user_data);
$user_rank                  =  LeechBuddy::user_rank($user_data);
$working_hosters            =  LeechBuddy::check_working_filehosters($user_data);
$quota_in_gb                =  LeechBuddy::available_quota_in_gb($user_data);
$used_quota_percentage      =  LeechBuddy::used_quota_percentage($user_data);

try{
	$add_link_to_queue        =  LeechBuddy::add_link_to_queue('http://uploaded.net/file/arouri47');
}catch(Exception $e){
	die($e->getMessage());
}

$list_files                 =  LeechBuddy::list_files($user_data);
?>
```
