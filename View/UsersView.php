<?php
include_once 'ViewInterface.php';

class UsersView implements ViewInterface
{

    public function renderView($dataSource): string
    {
        $users = $dataSource->getAllUsers();
        $table = "";
        foreach ($users as $user){
            $table .="<tr>
                        <td>{$user->id}</td>
                        <td>{$user->name}</td>
                        <td><a href='/ads?userid={$user->id}'>Ads of user</a></td>
                    </tr>";
        }
        return "<h2>Users</h2>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Ads</th>
                        </tr>
                            {$table}
                    </table>
                ";
    }
}