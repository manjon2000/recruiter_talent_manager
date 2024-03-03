```php
$user = \App\Models\User::with(['userRoles' => function($query) {
    $query->where('role_id', 1);
}, 'userRoles.role'])->get();


$user = new \App\Models\User([ "name" => 'albert', "last_name" => 'manjon', "email" => 'admin@admin.es', "password" => '12345678']);

$user = new \App\Models\Role([ "name" => 'admin' ]); $user->save();
$user = new \App\Models\Role([ "name" => 'recruiter' ]); $user->save();
$user = new \App\Models\Role([ "name" => 'employee' ]); $user->save();
$user = new \App\Models\UserRole(['role_id' => 1, 'user_id' => 1 ]); $user->save();
```
