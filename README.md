# LeechBuddy.com has been off-line permanently. This repository no longer works.

# LeechBuddy.com PHP Class

This class makes you able to customize your PHP pages based on [LeechBuddy.com](http://www.leechbuddy.com/) and use its features on your own.

### On which environment you've made this thing?

I use XAMPP(LAMPP) v5.5.3x. So, it means I use the 5.5.3x version of PHP. Go to ```my_phpinfo``` directory to have a look on my ```phpinfo()```.

### Installation
1) Download the ```class.inc.php``` file in the ```lib``` directory and include it on your code.

2) Then, go to [leechbuddy.com/auto/login](https://www.leechbuddy.com/auto/login) and authorize the application on your Facebook account.

3) As soon as you done that, you will be redirected to ```https://www.leechbuddy.com/login/done#_=_```. When you are there, right click on the page and view page source. You will see a line like this ```var token = "A LONG TOKEN IS HERE";```.

4) Copy the token code where between the quote marks. And add it to ```4th``` line on ```class.inc.php``` file.

5) Finally, run the code.

### Usage

```php
<?php
include_once('path/to/class.inc.php');

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
$list_files                 =  LeechBuddy::list_files($user_data);

// Use the block below only when you will make a download. If don't this, this will kill all the code because of an handling error (exception).
try{
	$add_link_to_queue        =  LeechBuddy::add_link_to_queue('http://uploaded.net/file/arouri47');
}catch(Exception $e){
	die($e->getMessage());
}
?>
```

### If you like my repository, please don't forget to click ```STAR``` and ```WATCH``` buttons on the top of the page so that also you will be aware of updates on the code.
