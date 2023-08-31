<?php
include_once 'ViewInterface.php';

class AdView implements ViewInterface
{
    public function renderView($dataSource): string
    {
        $ads = isset($_GET['userid']) ? $dataSource->getAdsByUserId($_GET['userid']) : $dataSource->getAllAdvertisements();
        $table = "";
        foreach($ads as $data){
            $table.= "<tr>
                        <td>{$data->id}</td>
                        <td>{$data->user->name}</td>
                        <td>$data->title</td>
                      </tr>";
        }
        return "<h2>Advertisements</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Title</th>
                    </tr>
                    {$table}                    
                </table>";
    }
}