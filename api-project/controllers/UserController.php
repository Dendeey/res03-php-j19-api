<?php


class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        // get all the users from the manager
        
        $usersToShow = $this->um->getAllUsers();

        // render
        
        $usersToShowInArray = [];
        foreach($usersToShow as $user)
        {
            $userToAarray= $user->toArray();
            $usersToShowInArray[] = $userToAarray;
        }
        $this->render($usersToShowInArray);
        
    }

    public function getUser(string $get)
    {
        // Pour retourner une valeur entière (intval)
        
        $id = intval($get);
        
        // get the user from the manager
        // either by email or by id
        
        $getUserFromManager = $this->um->getUserById($id);
        
        // render
        
        $userToArray = $getUserFromManager->toArray();
        
        $this->render($userToArray);
        
        
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        
        $createUser = new User($post["id"], $post["username"], $post["first_name"], $post["last_name"], $post["email"]);
        
        $userCreated = $this->um->createUser($createUser);
        
        // render the created user
        
        $userToArray = $userCreated->toArray();
        
        $this->render($userToArray);
    }

    public function updateUser(array $post)
    {
        // update the user in the manager
        
        $userToUpdate = new User(intval($post['id']), $post['username'], $post['first-name'], $post['last-name'], $post['email']);
        
        $this->um->updateUser($userToUpdate);

        $userToArray = $userToUpdate->toArray();

        // render the updated user
        
        $this->render($userToArray);
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager
        
        $this->um->deleteUser(intval($post['id']));

        // render the list of all users
        
        $this->render(['users' => $this->um->getAllUsers()]);
    }
}


?>