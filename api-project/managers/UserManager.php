<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        // get all the users from the database
        
        $getAllUsersInArray = [];
        
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $newUser = new User($users["id"], $users["username"], $users["firstname"], $users["lastname"], $users["email"]);
        
        $getAllUsersInArray[] = $newUser;
    }

    public function getUserById(int $id) : User
    {
        // get the user with $id from the database
        
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $parameters = [
            
            'id' => $id
            
            ];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        
        $newUser = new User($user["id"], $user["username"], $user["firstname"], $user["lastname"], $user["email"]);
    }

    public function createUser(User $user) : User
    {
        // create the user from the database
        
        $query = $this->db->prepare('INSERT INTO users (`id`, `username`, `firstname`, `lastname`, `email` ) VALUES(NULL, :id, :username, :firstname, :lastname, :email)');
        $parameters = [
            
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstName(),
            'lastname' => $user->getLastName(),
            'id' => $user->getEmail()
            
            ];
        $query->execute($parameters);

        // return it with its id
        
        return $user;
    }

    public function updateUser(User $user) : User
    {
        // update the user in the database
        
        $query = $this->db->prepare('UPDATE users SET id = :id, username = :username,  firstname = :firstname, lastname = :lastname, email = :email WHERE id = :id ');
        $parameters = [
            
            'id' => getId(),
            'username' => getUsername(),
            'firstname' => getFirstName(),
            'lastname' => getLastName(),
            'email' => getEmail()
            
            ];
        $query->execute($parameters);

        // return it
        
        return $user;
    }

    public function deleteUser(User $user) : array
    {
        // delete the user from the database
        
        $deleteUsersInArray = [];
        
        $query = $this->db->prepare('DELETE * FROM users WHERE id = :id');
        $parameters = [
            
            'id' => getId()
            
            ];
        $query->execute($parameters);
        
        // return the full list of users
        
        return $deleteUsersInArray[] = $user;
    }
}



?>