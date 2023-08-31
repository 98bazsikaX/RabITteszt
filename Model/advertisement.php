<?php
require_once 'user.php';
class Advertisement
{
    public int $id;
    public User $user; //since it is represented as a class, however the databases uses  foreign key.
    public string $title;
}