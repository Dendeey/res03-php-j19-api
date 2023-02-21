<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        // get all the users from the database
        
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $getAllUsersInArray = [];
        foreach($users as $user)
        {
            $newUser = new User($user["id"], $user["username"], $user["first_name"], $user["last_name"], $user["email"]);
        
            $getAllUsersInArray[] = $newUser;
        }
        
        return $getAllUsersInArray;
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
        
        $newUser = new User($user["id"], $user["username"], $user["first_name"], $user["last_name"], $user["email"]);
        
        return $newUser;
    }

    public function createUser(User $user) : User
    {
        // create the user from the database
        
        $query = $this->db->prepare('INSERT INTO users VALUES(null, :username, :first_name, :last_name, :email)');
        $parameters = [
            
            'username' => $user->getUsername(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail()
            
            ];
        $query->execute($parameters);
        
        $query = $this->db->prepare('SELECT LAST_INSERT_ID() FROM users');
        $query->execute();
        $userSelected = $query->fetch(PDO::FETCH_ASSOC);

        // return it with its id
        
        return $user;    
        
        
    }

    public function updateUser(User $user) : User
    {
        // update the user in the database
        
        $query = $this->db->prepare('UPDATE users SET username = :username,  first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id ');
        $parameters = [
            
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail()
            
            ];
        $query->execute($parameters);
        
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $parameters = [
            
            'id' => $user->getId()
            
            ];
        $query->execute($parameters);
        $updatedUser = $query->fetch(PDO::FETCH_ASSOC);
        $newUserAfterUpdated = new User($updatedUser["id"], $updatedUser["username"], $updatedUser["first_name"], $updatedUser["last_name"], $updatedUser["email"]);

        // return it
        
        return $newUserAfterUpdated;
    }

    public function deleteUser(User $user) : array
    {
        // delete the user from the database
        
        $query = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $parameters = [
            
            'id' => $user->getId()
            
            ];
        $query->execute($parameters);
        
        // return the full list of users
        
        return $this->$getAllUsers();
    }
}



?>